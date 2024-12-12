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
                'password' => 'nullable|regex:/^[A-Za-z0-9]+$/', // Only allow alphanumeric characters for password
            ]);

            $file = $request->file('file');
            $fileContents = file_get_contents($file);

            $password = $request->input('password');
            if ($password) {
                $encryptedContents = openssl_encrypt($fileContents, 'aes-256-cbc', $password, 0, str_repeat('0', 16));
            } else {
                $encryptedContents = encrypt($fileContents);
            }

            $extension = $file->getClientOriginalExtension();
            $newFileName = 'file_' . now()->format('YmdHis') . '.' . $extension;

            // Save the file
            Storage::put($newFileName, $encryptedContents);

            return redirect()->back()->with('success', 'File uploaded successfully!');
        } catch (PostTooLargeException $e) {
            return redirect()->back()->with('error', 'The uploaded file is too large.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while uploading the file. The file may be too large or the password may contain invalid characters.');
        }
    }

    public function download(Request $request, $hash)
    {

        $output = shell_exec("ipfs cat $hash");


        $password = $request->input('password');
        $storedPassword = session()->get('file_password_' . $hash);

        if ($password) {
            $decryptedContent = openssl_decrypt($output, 'aes-256-cbc', $password, 0, str_repeat('0', 16));
        } elseif ($storedPassword) {
            $decryptedContent = openssl_decrypt($output, 'aes-256-cbc', $storedPassword, 0, str_repeat('0', 16));
        } else {
            $decryptedContent = decrypt($output);
        }

        if ($decryptedContent === false) {
            $decryptedContent = $output;
        }

        $extension = session()->get('file_extension_' . $hash, 'txt');

        return response($decryptedContent)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', 'attachment; filename="file_' . now()->format('YmdHis') . '.' . $extension . '"');
    }
}
