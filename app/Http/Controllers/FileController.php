<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
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

        $fileName = $request->file('file')->getClientOriginalName();
        $folderName = '/storage/folder' . auth()->user()->id;
        $filePath = $request->file('file')->storeAs($folderName , $fileName, 'public');
        $fileSize = file_size($request->file('file')->getSize());

        File::create([
            'name' => $fileName,
            'size' => $fileSize,
            'user_id' => auth()->user()->id,
            'folder_id' => $request->folder_id ?? 0,
            'path' => $filePath
        ]);

        return redirect()->back()->with('success', 'Uploaded Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::find($id);
        $file->delete();

        return redirect()->back()->with('success', 'Deleted Successfully!');
    }
}
