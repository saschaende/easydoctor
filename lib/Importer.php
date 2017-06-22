<?php

namespace SaschaEnde\Easydoctor;

class Importer {

    private $projectDir;
    private $lines = [];
    private $filenames = [];

    public function __construct(){
        $this->projectDir = 'doc/'.Arguments::get('p');
        $this->filenames = $this->scandir($this->projectDir);

        foreach($this->filenames as $filename){
            $this->lines[] = file($this->projectDir.'/'.$filename);
        }
    }

    /**
     * Inhalte eines Verzeichnisses zurückgeben
     * @param String $dir Pfad zum Verzeichnis, welches gescannt werden soll
     * @param Boolean $returndirectories Setze auf true, um Verzeichnisse anstatt Dateien zur�ckzugeben
     * @return Array
     */
    public function scandir($dir, $returndirectories = false)
    {
        // Layouts laden
        $FILES = array();
        $DIRS = array();

        if (($handle = opendir($dir)) === false) {
            return false;
        }

        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != ".." && is_dir($dir . "/" . $file) == true) {
                array_push($DIRS, $file);
            } elseif ($file != "." && $file != ".htaccess" && $file != ".." && is_dir($dir . "/" . $file) == false) {
                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if ($extension == 'md') {
                    array_push($FILES, $file);
                }
            }
        }
        closedir($handle);
        // Zurückgeben
        if ($returndirectories == false) {
            return $FILES;
        } elseif ($returndirectories == true) {
            return $DIRS;
        }
    }

}