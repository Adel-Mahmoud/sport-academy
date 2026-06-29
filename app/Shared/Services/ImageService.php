<?php

namespace App\Shared\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function store(
        Model $model,
        UploadedFile $file,
        string $directory,
        string $column = 'image',
        string $disk = 'public'
    ): void {
        $path = $file->store($directory, $disk);

        try {
            $model->update([
                $column => $path,
            ]);
        } catch (\Throwable $e) {
            Storage::disk($disk)->delete($path);

            throw $e;
        }
    }

    public function update(
        Model $model,
        UploadedFile $file,
        string $directory,
        string $column = 'image',
        string $disk = 'public'
    ): void {
        $oldPath = $model->{$column};

        $newPath = $file->store($directory, $disk);

        try {
            $model->update([
                $column => $newPath,
            ]);

            if ($oldPath && Storage::disk($disk)->exists($oldPath)) {
                Storage::disk($disk)->delete($oldPath);
            }
        } catch (\Throwable $e) {
            Storage::disk($disk)->delete($newPath);

            throw $e;
        }
    }

    public function delete(
        Model $model,
        string $column = 'image',
        string $disk = 'public'
    ): void {
        $path = $model->{$column};

        if ($path && Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }

        $model->update([
            $column => null,
        ]);
    }
}