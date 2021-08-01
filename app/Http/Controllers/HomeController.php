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
        $currentFolder = null;
        $folders = [];
        $files = [];

        if ($id == 0) {
             $folders = Folder::where('user_id', auth()->user()->id)
                ->where('parent_id', 0)->get();
             $files = File::where('user_id', auth()->user()->id)
                ->where('folder_id', 0)->get();

            $path = '/';
        } else {
            $folders = Folder::where('user_id', auth()->user()->id)
                ->where('parent_id', $id)->get();

            $files = File::where('user_id', auth()->user()->id)
                ->where('folder_id', $id)->get();

            // get the current folder
            $currentFolder = Folder::find($id);

            if ($currentFolder->parent_id != 0) {
                $path = '/' . $currentFolder->parent->name . '/' . $currentFolder->name;
            } else {
                $path = '/' . $currentFolder->name;
            }
        }

        return view('home', compact('folders', 'files', 'id', 'currentFolder', 'path'));
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

        $currentFolder = null;
        $path = '/';
        $keyword = $request->keyword;

        // no current folder
        $id = 0;

        $folders = Folder::where('user_id', auth()->user()->id)
            ->where('name', 'like', '%'.$keyword.'%')->get();

        $files = File::where('user_id', auth()->user()->id)
            ->where('name', 'like', '%'.$keyword.'%')->get();

        return view('home', compact('folders', 'files', 'id', 'keyword', 'currentFolder', 'path'));
    }
}
