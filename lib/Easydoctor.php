<?php

namespace SaschaEnde\Easydoctor;

class Easydoctor
{

    private $contents = [];

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

    /**
     * Search for headings and add them to the content table
     * @param $content
     * @param $pagenum
     */
    public function addToContentList($content, $pagenum)
    {
        preg_match_all('/(#+)(.*)/', $content, $matches);
        $results = [];
        foreach ($matches[2] as $key => $match) {

            $value = trim($match);
            $hash = md5($value);

            if (strlen($matches[1][$key]) == 1) {
                $type = 'h1';
            }
            if (strlen($matches[1][$key]) == 2) {
                $type = 'h2';
            }

            $results[] = [
                'type' => $type,
                'title' => $value,
                'hash'  =>  $hash

            ];
        }
        $this->contents[$pagenum] = $results;
    }

    public function renderContentList()
    {
        $mdContents = "# Inhaltsverzeichnis\n\n";
        foreach ($this->contents as $page => $headings) {

            foreach ($headings as $heading) {
                if ($heading['type'] == 'h2') {
                    $prefix = '     ';
                } else {
                    $prefix = '';
                }

                $mdContents .= $prefix . "* [" . $heading['title'] . "](#page" . $page . ")\n";
            }

        }
        return $mdContents;
    }

    /**
     * Debug output
     * @param $text
     */
    public function printOutput($text)
    {
        if (Arguments::get('v') == 'on') {
            return;
        }
        echo '* ' . $text . "\n";
    }

    /**
     * Extend markdown for rendering inline php code
     * @param $md
     */
    public function renderProgrammingCode($md)
    {
        // syntax highlighting disabled
        if (Arguments::get('sh') == 'off') {
            return $md;
        }
        // syntax highlighting enabled
        return preg_replace_callback('/<div lang="(.*?)">(.*?)<\/div>/sm', function ($matches) {
            $geshi = new \GeSHi(trim($matches[2]), $matches[1]);
            $geshi->set_header_type(GESHI_HEADER_NONE);
            return '<pre><code>' . $geshi->parse_code() . '</code></pre>';
        }, $md);
    }
}