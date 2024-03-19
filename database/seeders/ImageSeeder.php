<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $images = Storage::disk('seeder')->files();

        foreach ($images as $image) {
            $imagePath = Storage::disk('public')->putFile('images/' . now()->format('Y-m-d'), Storage::disk('seeder')->path($image));
            if (config('app.imageStoreFormat') == 'daily') {
                $imagePath = Storage::disk('public')->putFile('images/' . now()->format('Y-m-d'), Storage::disk('seeder')->path($image));
            } else {
                $imagePath = Storage::disk('public')->putFile('images', Storage::disk('seeder')->path($image));
            }

            $imageMetaData = exif_read_data(Storage::disk('public')->path($imagePath));
            Image::create([
                'path' => $imagePath,
                'width' => $imageMetaData['COMPUTED']['Width'],
                'height' => $imageMetaData['COMPUTED']['Height'],
                'size' => $imageMetaData['FileSize'],
                'mime' => Storage::disk('public')->mimeType($imagePath)
            ]);
        }
    }
}
