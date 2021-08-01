<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;

class FolderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'file|required',
        ]);

        Folder::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'parent_id' => $request->parent_id ?? 0,
        ]);

        return redirect()->back()->with('success', 'Created Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $folder = Folder::find($id);

        // delete all it's content
        foreach ($folder->children()->get() as $child) {
            $child->delete();
        }

        foreach ($folder->files()->get() as $file) {
            $file->delete();
        }

        $folder->delete();

        return redirect()->back()->with('success', 'Deleted Successfully!');
    }
}
