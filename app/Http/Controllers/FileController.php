<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Exceptions\PostTooLargeException;

class FileController extends Controller
{
    public function index()
    {
        return view('file_upload');
    }
    public function downloadForm()
    {
        return view('file_download');
    }
    public function upload(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|file|max:20480',
                'password' => 'nullable|regex:/^[A-Za-z0-9]+$/',
            ]);
            $disallowedExtensions = ['exe', 'sh', 'bat', 'php', 'js', 'html', 'vbs', 'msi', 'pl', 'py', 'cgi', 'asp', 'aspx', 'dll', 'bat', 'com', 'rb', 'wsf', 'jar', 'msm', 'iso', 'apk', 'sys', 'tmp', 'dat'];


            $file = $request->file('file');

            if (!$file) {
                error_log('No file uploaded.');
                return redirect()->back()->with('error', 'No file was uploaded.');
            }

            //Sanitizing file name
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();

            if (in_array($extension, $disallowedExtensions)) {
                return redirect()->back()->with('error', 'This file type is not allowed for upload. Please compress your file into a zip archive and try again.');
            }

            $sanitizedFileName = substr(preg_replace('/[^a-zA-Z0-9._-]/', '_', $originalName), 0, 255);
            $sanitizedExtension = preg_replace('/[^a-zA-Z0-9]/', '', $extension);

            $fileContents = file_get_contents($file);
            $password = $request->input('password');

            if ($password) {
                $encryptedContents = openssl_encrypt($fileContents, 'aes-256-cbc', $password, 0, str_repeat('0', 16));
            } else {
                $encryptedContents = encrypt($fileContents);
            }

            $timestamp = now()->format('YmdHis');
            $folderPath = storage_path("app/temp_upload_$timestamp");
            mkdir($folderPath);

            $tempFilePath = "$folderPath/encrypted.dat";
            file_put_contents($tempFilePath, $encryptedContents);

            $metadata = [
                'filename' => $sanitizedFileName,
                'extension' => $sanitizedExtension,
            ];
            file_put_contents("$folderPath/meta.json", json_encode($metadata));

            $output = shell_exec("ipfs add -q $tempFilePath");
            $ipfsHash = trim($output);

            if ($ipfsHash) {
                rename($folderPath, storage_path("app/ipfs_$ipfsHash"));
            } else {
                return redirect()->back()->with('error', 'Failed to upload the file to IPFS.');
            }

            return redirect()->back()->with('success', 'File uploaded to IPFS successfully! Hash: ' . $ipfsHash);

        } catch (PostTooLargeException $e) {
            return redirect()->back()->with('error', 'The uploaded file is too large.');
        } catch (\Exception $e) {
            error_log('Exception: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while uploading the file.');
        }
    }

    public function download(Request $request)
    {
        $hash = $request->query('hash');
        $password = $request->query('password');

        if (empty($hash) || !preg_match('/^[a-zA-Z0-9]+$/', $hash)) {
            return redirect()->back()->with('error', 'Invalid hash provided.');
        }

        $output = shell_exec("ipfs cat $hash");

        if (!$output) {
            return redirect()->back()->with('error', 'File not found on IPFS.');
        }

        $storedPassword = session()->get('file_password_' . $hash);
        if ($password) {
            $decryptedContent = openssl_decrypt($output, 'aes-256-cbc', $password, 0, str_repeat('0', 16));
        } elseif ($storedPassword) {
            $decryptedContent = openssl_decrypt($output, 'aes-256-cbc', $storedPassword, 0, str_repeat('0', 16));
        } else {
            try {
                $decryptedContent = decrypt($output);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                return redirect()->back()->with('error', 'An error occurred while decrypting the file. Check the password.');
            }
        }

        if ($decryptedContent === false) {
            return redirect()->back()->with('error', 'An error occurred while decrypting the file. Check the password.');
        }

        $metadataPath = storage_path("app/ipfs_$hash/meta.json");
        if (!file_exists($metadataPath)) {
            $filename = 'file_' . now()->format('YmdHis');
            $extension = 'txt';
        } else {
            $meta = json_decode(file_get_contents($metadataPath), true);
            $filename = $meta['filename'] ?? 'file_' . now()->format('YmdHis');
            $extension = $meta['extension'] ?? 'txt';
        }

        return response($decryptedContent)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '.' . $extension . '"');
    }
}
