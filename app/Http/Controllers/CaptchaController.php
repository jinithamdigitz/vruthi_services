<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    public function generate()
    {
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $captcha = substr(str_shuffle($characters), 0, 6);

        // IMPORTANT: Use 'captcha_phrase' as session key (matches EnquiryController)
        session(['captcha_phrase' => $captcha]);

        // Create image
        $width = 160;
        $height = 50;

        $image = imagecreate($width, $height);

        // Colors
        $bg = imagecolorallocate($image, 15, 23, 42);
        $textColor = imagecolorallocate($image, 255, 255, 255);
        $noiseColor = imagecolorallocate($image, 100, 100, 255);

        // Add noise lines
        for ($i = 0; $i < 8; $i++) {
            imageline($image, rand(0,$width), rand(0,$height), rand(0,$width), rand(0,$height), $noiseColor);
        }

        // Add random dots
        for ($i = 0; $i < 100; $i++) {
            imagesetpixel($image, rand(0,$width), rand(0,$height), $noiseColor);
        }

        // Add text
        $fontSize = 5;
        $x = 20;
        $y = 15;

        for ($i = 0; $i < strlen($captcha); $i++) {
            imagestring($image, $fontSize, $x, $y + rand(-5,5), $captcha[$i], $textColor);
            $x += 20;
        }

        // Output image
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();

        imagedestroy($image);

        return response($imageData)
            ->header('Content-Type', 'image/png')
            ->header('Cache-Control', 'no-cache, must-revalidate');
    }
}