<?php

/**
 * Trida pro nahrani souboru na serveru.
 *
 * @author XiXao
 */
class FFileUploader extends UploadException {

    private $path;
    private $lastFileName;

    public function __construct() {
        
    }

    public function uploadFile($filename, $size, $dir, $typeRestrictionA = null, $useRandomName = true, $name = NULL, $doNotOverride = true) {
        /**
         * Kontrola spravneho formatu a velikosti souboru.
         */
//        if ((($_FILES[$filename]["type"] == "image/gif") || ($_FILES[$filename]["type"] == "image/jpeg") || ($_FILES[$filename]["type"] == "image/pjpeg") || ($_FILES[$filename]["type"] == "image/png") || ($_FILES[$filename]["type"] == "image/bmp")) && ($_FILES[$filename]["size"] < ($size * 1024))) {
//        echo $_FILES[$filename]["type"];
//        print_r($_FILES[$filename]);
        if (is_array($typeRestrictionA) && !in_array($_FILES[$filename]['type'], $typeRestrictionA)) {
//            throw new UploadException("Invalid file type: " . $_FILES[$filename]["name"]);
            return false;
        }

        if ($_FILES[$filename]["error"] > 0) {
            echo "error upload image: " . $_FILES[$filename]["error"];
//            throw new UploadException("Error upload file: " . $_FILES[$filename]["error"]);
            return false;
        }


        $this->createDir($dir, 0755);

        if ($useRandomName) {

            $pathInfo = pathinfo($_FILES[$filename]['name']);

            $name = $this->createRandomName(10);
            while (file_exists($dir . $name . '.' . $pathInfo['extension'])) {
                $name = $this->createRandomName(10);
            }

            $this->lastFileName = $name . '.' . $pathInfo['extension'];
            $this->path = $dir . $this->path;
        } else if ($doNotOverride) {

            $pathInfo = pathinfo($name);

            if (file_exists($dir . $pathInfo['basename'])) {

                $i = 1;
                while (file_exists($dir . $pathInfo['filename'] . '_(' . $i . ').' . $pathInfo['extension'])) {
                    ++$i;
                }

                $this->lastFileName = $pathInfo['filename'] . '_(' . $i . ').' . $pathInfo['extension'];
                
            } else {
                $this->lastFileName = $pathInfo['basename'];
            }
            
            $this->path = $dir . $this->lastFileName;
            
        } else {
            
            $this->lastFileName = $name;
            $this->path = $dir . $name;
        }

        move_uploaded_file($_FILES[$filename]['tmp_name'], $this->path);
        return true;
    }

    /**
     * Funkce pro nahrani souboru na server.
     * 
     * @param string $file
     * @param string $type
     * @param integer $size
     * @param string $dir
     * @param Messages $messages
     * @return boolean jestli bylo nahrani uspesne.
     */
    public function uploadImage($file, $size, $dir, $useRandomName, $name = NULL) {
        /**
         * Kontrola spravneho formatu a velikosti souboru.
         */
        if ((($_FILES[$file]["type"] == "image/gif") || ($_FILES[$file]["type"] == "image/jpeg") || ($_FILES[$file]["type"] == "image/pjpeg") || ($_FILES[$file]["type"] == "image/png") || ($_FILES[$file]["type"] == "image/bmp")) && ($_FILES[$file]["size"] < ($size * 1024))) {
            if ($_FILES[$file]["error"] > 0) {
                echo "error upload image: " . $_FILES[$file]["error"];
                $GLOBALS['messages']->addMessage("Error upload file: " . $_FILES[$file]["error"]);
                throw new UploadException("Error upload file: " . $_FILES[$file]["error"]);
                return false;
            } else {
                $this->createDir($dir, 0755);
                if ($useRandomName) {
                    $name = $this->createRandomName(10);
                    while (file_exists($dir . $name)) {
                        $name = $this->createRandomName(10);
                    }
                }
                $pathInfo = pathinfo($_FILES[$file]["name"]);
                $this->path = $dir . $name . "." . $pathInfo['extension'];
                $this->lastFileName = $name . "." . $pathInfo['extension'];
                //echo "last file name " . $this->lastFileName;
                //echo "tmp name: " . $_FILES[$file]["tmp_name"] . "<br>new path: " . $this->path;
                move_uploaded_file($_FILES[$file]["tmp_name"], $this->path);
                return true;
            }
        } else {
            echo "error upload image: invalid type.";
            $GLOBALS['messages']->addMessage("Invalid file type: " . $_FILES[$file]["name"]);
            throw new UploadException("Invalid file type: " . $_FILES[$file]["name"]);
            return false;
        }
    }

    /**
     * Funkce pro vytvoreni adresare.
     * @param string $dir Cesta k adresari
     * @param integer $rights Prava
     */
    public static function createDir($dir, $rights) {
        if (!file_exists($dir)) {
            $result = mkdir($dir, 0775, true);
            if (!$result) {
                die("An error occured during creating directory " . $dir . ".");
            } else {
                //echo "dicertory $dir created";
            }
        }
    }

    /**
     * Funkce k vytvoreni nahodneho jmena souboru.
     * @param integer $length
     * @return string
     */
    public static function createRandomName($length) {
        return substr(md5(rand(0, 999999)), 17, $length);
    }

    /**
     * Funkce, ktera vrati nazev posledniho nahraneho souboru.
     * @return String
     */
    public function getLastPath() {
        return $this->path;
    }

    public function getLastFileName() {
        return $this->lastFileName;
    }

}

class UploadException extends Exception {

    public function errorMessage() {
        $errorMsg = 'Error on line ' . $this->getLine() . ' in ' . $this->getFile() . ': <b>' . $this->getMessage() . '</b> Error at file upload';
        return $errorMsg;
    }

}

?>