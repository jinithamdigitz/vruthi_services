<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{

public function store(Request $request)
{
    $request->validate([
        'upload' => 'required|file|mimes:jpg,jpeg,png,webp,gif|max:2048'
    ]);

    if ($request->hasFile('upload')) {

        $file = $request->file('upload');

        // ✅ Create folder if not exists
        $destination = public_path('posts/ckeditor');
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        // ✅ Create unique filename (force webp)
        $filename = Str::uuid() . '.webp';
        $filepath = $destination . '/' . $filename;

        // ✅ Get image info
        $imageInfo = getimagesize($file);
        $mime = $imageInfo['mime'];

        // ✅ Create image resource based on type
        switch ($mime) {
            case 'image/jpeg':
                $src = imagecreatefromjpeg($file);
                break;
            case 'image/png':
                $src = imagecreatefrompng($file);
                break;
            case 'image/gif':
                $src = imagecreatefromgif($file);
                break;
            case 'image/webp':
                $src = imagecreatefromwebp($file);
                break;
            default:
                return response()->json([
                    'error' => ['message' => 'Unsupported image type']
                ], 400);
        }

        // ✅ Original dimensions
        $width = imagesx($src);
        $height = imagesy($src);

        // ✅ New width = max 250px
        $newWidth = 250;

        // If image is smaller, keep original size
        if ($width <= 250) {
            $newWidth = $width;
        }

        // Maintain aspect ratio
        $newHeight = ($height / $width) * $newWidth;

        // ✅ Create new resized image
        $dst = imagecreatetruecolor($newWidth, $newHeight);

        // Handle transparency for PNG/GIF
        imagealphablending($dst, false);
        imagesavealpha($dst, true);

        // Resize
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // ✅ Save as WebP (quality: 80)
        imagewebp($dst, $filepath, 80);

        // Free memory
        imagedestroy($src);
        imagedestroy($dst);

        // ✅ Generate URL
        $url = asset('posts/ckeditor/' . $filename);

        return response()->json([
            'url' => $url
        ]);
    }

    return response()->json([
        'error' => ['message' => 'Upload failed']
    ], 400);
}
}