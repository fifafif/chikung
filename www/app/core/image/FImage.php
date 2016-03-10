<?php

/**
 * Description of FImage
 *
 * @author XiXao
 */
class FImage {

    /**
     * Funkce, ktera vytvori podle zadanych parametru nahled obrazku a ulozi ho do zvoleneho adresare.
     *
     * @param string $source
     * @param string $thumb
     * @param integer $height
     */
//    static public function resizeImage($source, $thumb, $ext, $height, $ratio) {
    static public function resizeImage($source, $output, $width, $height, $keepRatio = true, $ext = 'jpg') {

        ini_set("memory_limit", "32M");
        $origSize = getimagesize($source);

        if ($origSize[1] == 0 || $height == 0) {
            return;
        }

        if ($keepRatio) {

            $ratioOrig = $origSize[0] / $origSize[1];
            $ratioOutput = $width / $height;
            
//            // If orig landscape
//            if ($ratioOrig > 1) {
//                // If output landscape
//                if ($ratioOutput > 1) {
//                    $height = $width / $ratioOrig;
//                } else {
//                    $width = $height / $ratioOrig;
//                }
//            } else {
//                if ($ratioOutput < 1) {
//                    
//                }
//            }

            if ($ratioOrig > $ratioOutput) {
                $height = $width / $ratioOrig;
            } else {
                $width = $height * $ratioOrig;
            }
        }


        switch ($ext) {
            case "gif":
                $im_in = imagecreatefromgif($source);
                $im_out = imagecreate($width, $height);
                break;
            case "png":
                $im_in = imagecreatefrompng($source);
                $im_out = imagecreate($width, $height);
                break;
            case "jpg":
                $im_in = imagecreatefromjpeg($source);
                $im_out = imagecreatetruecolor($width, $height);
                break;
            case "jpeg":
                $im_in = imagecreatefromjpeg($source);
                $im_out = imagecreatetruecolor($width, $height);
                break;
            case "bmp":
                $im_in = self::ImageCreateFromBmp($source);
                imagejpeg($im_in, $source);
                $im_in = imagecreatefromjpeg($source);
                $im_out = imagecreatetruecolor($width, $height);
                break;
            default:
                $im_in = NULL;
        }

        imagecopyresampled($im_out, $im_in, 0, 0, 0, 0, $width, $height, $origSize[0], $origSize[1]);
        switch ($ext) {
            case "gif":
                imagegif($im_out, $output);
                break;
            case "png":
                imagepng($im_out, $output);
                break;
            case "jpg":
                imagejpeg($im_out, $output, 85);
                break;
            case "jpeg":
                imagejpeg($im_out, $output, 85);
                break;
            default:
                $im_in = NULL;
        }
    }

}

?>
