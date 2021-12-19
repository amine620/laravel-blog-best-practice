<?php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait GetFilePathTrait{



public function getPathTrait($req,$folderName,$inputName)
{
       return Storage::putFileAs(
            $folderName,
            $req->file($inputName),
            random_int(1, 100) . '.' . $req->file($inputName)->guessExtension()
        );
}


}