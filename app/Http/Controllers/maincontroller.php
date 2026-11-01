<?php

namespace App\Http\Controllers;

use App\Models\folder_uploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class maincontroller extends Controller
{
    public function folder_page(){
        return view("/create_folder");
    }

    public function folder_page_submit(Request $request){
        $request->validate([
            'folder'=>'required|array|min:1',
            'folder.*'=>'required|file|max:1020',
            'paths'=>'required|array|min:1',
            'paths.*'=>'required|string'
        ]);
        $file=$request->file('folder');
        $path=$request->input('paths');
        if(count($file) !== count($path)){
            throw ValidationException::withMessages([
                "folder"=>"File And Path Does Not Match"
            ]);
        }

        $firstname=str_replace('\\','/',$path[0]);
        $segments=explode('/',$firstname);
        $foldername=$segments[0];
        $storagefolder='uploads/'. Auth::id(). '/' . Str::uuid();

        foreach($file as $index => $file){
            $paths=str_replace('\\','/',$path[$index]);
            $parts=explode('/',$paths);
            $relativepath=implode('/', array_slice($parts,1));
            $directory=dirname($relativepath);
            $targetdirectory=$storagefolder;

            if($directory !== '.'){
                $targetdirectory.='/'.$directory;
            }
            Storage::disk('local')->putFileAs(
                $targetdirectory,
                $file,
                basename($relativepath),
            );
            }
            folder_uploads::create([
                'user_id'=>Auth::id(),
                'folder_name'=>$foldername,
                'folder_path'=>$storagefolder
            ]);
        return back()->with('success','Folder Upload Succesfully');
    }

    public function my_folder(){
        $userid=Auth::id();
        $folders=folder_uploads::where('user_id',$userid)->get();
        return view("/my_folder",compact('folders'));
    }

    public function download($id){
        $folder=folder_uploads::where('id',$id)->where('user_id',Auth::id())->firstOrFail();
        $folderpath=Storage::disk('local')->path($folder->folder_path);
        $zippath=storage_path('/app'.Str::uuid().'.zip');
        $zipobj=new \ZipArchive();
        if($zipobj->open($zippath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true){
            abort("500","Zip Not making");
        }
        $files=new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(
                $folderpath,
                \FilesystemIterator::SKIP_DOTS,
            )
        );
foreach ($files as $file) {
    if ($file->isFile()) {
        $relativePath = substr(
            $file->getPathname(),
            strlen($folderpath) + 1
        );

        $zipobj->addFile($file->getPathname(), $relativePath);
    }
}

$zipobj->close();

// ZIP download
return response()->download(
    $zippath,
    $folder->folder_name . '.zip'
)->deleteFileAfterSend(true);
    }


}
