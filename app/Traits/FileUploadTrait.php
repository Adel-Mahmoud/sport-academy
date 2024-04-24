<?php
namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait FileUploadTrait
{
    public function uploadFile($file, $folder)
    {
        if (!$file || !$folder) {
            return false;
        }
        $allowedExtensions = ['jpeg', 'jpg', 'png', 'svg'];
        $extension = $file->getClientOriginalExtension();
        $fileName = $file->getClientOriginalName();
        if (!in_array($extension, $allowedExtensions)) {
            return false;
        }
        $randomNumber = rand(1000000000, 9999999999);
        $trimmedFileName = Str::limit($randomNumber . '_' . $fileName, 25, '');
        $newFileName = $trimmedFileName . '.' . $extension;
        $file->move("images/" . $folder, $newFileName);
        return $newFileName;
    }

    public function deleteFile($path)
    {
        if (File::exists('images/' . $path)) {
            File::delete('images/' . $path);
        }
    }
}