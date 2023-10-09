<?php


/**
 * 
 * make avatar funciton
 */

 

 if (!function_exists('makeAvatar')) {
    function makeAvatar($fontPath, $dest, $char)
    {
        $path = $dest;

        $width = 200;
        $height = 200;
      //  $image = imagecreatetruecolor($width, $height);

       $image = imagecreate($width, $height);
        

        $background_color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
        $text_color = imagecolorallocate($image, 255, 255, 255);
        
        // Adjust the font size, x, and y coordinates to center the character
        $font_size = 100;
        $text_x = 50;
        $text_y = 150;
        
        imagettftext($image, $font_size, 0, $text_x, $text_y, $text_color, $fontPath, $char);
        imagepng($image, $path);
        imagedestroy($image);

        return $path;
    }
}


