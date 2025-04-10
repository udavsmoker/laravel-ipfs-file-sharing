<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $files = File::where('user_id', Auth::user()->id)->get();

        $fileStats = [
            'total' => $files->count(),
            'active' => $files->where('active', true)->count(), // count only active files
            'lastUpload' => $files->sortByDesc('created_at')->first()->created_at ?? 'N/A',
        ];

        return view('dashboard', compact('files', 'fileStats'));
    }
}
