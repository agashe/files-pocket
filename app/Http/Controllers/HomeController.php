<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\File;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id = 0)
    {
        $folders = [];
        $files = [];

        if ($id == 0) {
             $folders = Folder::where('user_id', auth()->user()->id)->get();
             $files = File::where('user_id', auth()->user()->id)->get();
        } else {
            $folders = Folder::where('user_id', auth()->user()->id)
                ->where('parent_id', $id)->get();

            $files = File::where('user_id', auth()->user()->id)
                ->where('folder_id', $id)->get();
        }

        return view('home', compact('folders', 'files', 'id'));
    }
    
    /**
     * Search files and folders.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'required'
        ]);

        $keyword = $request->keyword;

        // no current folder
        $id = 0;

        $folders = Folder::where('user_id', auth()->user()->id)
            ->where('name', 'like', '%'.$keyword.'%')->get();

        $files = File::where('user_id', auth()->user()->id)
            ->where('name', 'like', '%'.$keyword.'%')->get();

        return view('home', compact('folders', 'files', 'id', 'keyword'));
    }
}
