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
                array_push($FILES, $file);
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

    public function addToContentList($content)
    {
        preg_match_all('/(#+)(.*)/', $content, $matches);
        $results = [];
        foreach ($matches[2] as $key => $match) {
            if (strlen($matches[1][$key]) == 1) {
                $results['headline'] = trim($match);
            }
            if (strlen($matches[1][$key]) == 2) {
                $results['sub'][] = trim($match);
            }
        }
        $this->contents[] = $results;
    }

    public function renderContentList()
    {
        $mdContents = "# Inhaltsverzeichnis\n\n";
        $pageCount = 1;
        foreach ($this->contents as $pageHeadings) {
            $mdContents .= $pageCount . ". [" . $pageHeadings['headline'] . "](#page" . $pageCount . ")\n";

            foreach ($pageHeadings['sub'] as $sub) {
                $mdContents .= "    - " . $sub . "\n";
            }

            $pageCount++;
        }
        return $mdContents;
    }

    public function getArguments()
    {
        $Args = [];
        for ($i = 0; $i < count($_SERVER['argv']); $i++) {
            if (substr($_SERVER['argv'][$i], 0, 1) == '-' && !empty($_SERVER['argv'][$i + 1])) {
                $argument = substr($_SERVER['argv'][$i], 1);
                $value = $_SERVER['argv'][$i + 1];
                $Args[$argument] = $value;
            }
        }
        return $Args;
    }

    /**
     * Debug output
     * @param $text
     */
    public function printOutput($text)
    {
        $Arg = $this->getArguments();
        if ($Arg['v'] == '1') {
            return;
        }
        echo '* ' . $text . "\n";
    }

    /**
     * Extend markdown for rendering inline php code
     * @param $md
     */
    public function renderPhpCode($md)
    {
        return preg_replace_callback('/<div lang="php">(.*?)<\/div>/sm', function ($matches) {
            return '<pre>'.highlight_string(trim($matches[1]),true).'</pre>';
        }, $md);
    }
}