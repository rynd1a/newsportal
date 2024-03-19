<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function storeImage(UploadedFile $image): int
    {
        if (config('app.imageStoreFormat') == 'daily') {
            $imagePath = Storage::disk('public')->putFile('images/' . now()->format('Y-m-d'), $image);
        } else {
            $imagePath = Storage::disk('public')->putFile('images', $image);
        }

        $imageData = exif_read_data(Storage::disk('public')->path($imagePath));

        $imageRecord = Image::create([
            'path' => $imagePath,
            'width' => $imageData['COMPUTED']['Width'],
            'height' => $imageData['COMPUTED']['Height'],
            'size' => $imageData['FileSize'],
            'mime' => Storage::disk('public')->mimeType($imagePath)
        ]);

        return $imageRecord->id;
    }
}

