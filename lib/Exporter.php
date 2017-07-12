<?php

namespace SaschaEnde\Easydoctor;

use function file_exists;
use PhpQuery\phpQuery;
use function PhpQuery\pq;

class Exporter
{
    public $importer;
    public $parser;
    public $converter;
    public $settings;
    public $easydoctorsettings;


    public function __construct(Importer $importer, Parser $parser, Converter $converter)
    {
        $this->importer = $importer;
        $this->parser = $parser;
        $this->converter = $converter;

        // load settings from project
        $iniFilepath = 'doc/'.Arguments::get('p').'/project.ini';
        if(!file_exists($iniFilepath)){
            die('Unable to locate project configuration file: '.$iniFilepath);
        }
        $this->settings = parse_ini_file($iniFilepath, true);
        $this->easydoctorsettings = parse_ini_file('easydoctor.ini', true);
    }

    public function execute()
    {

    }

    /**
     * Convert markdown to html
     * @param $md
     * @return mixed|string
     */
    public function getHtmlFromMarkdown($md)
    {
        $pd = new \ParsedownExtra();
        return $pd->text($md);
    }

    /**
     * Crawl the code and set imagepaths absolute
     * @param $html
     */
    public function setAbsoluteImagePaths(&$html)
    {
        // images
        $doc = phpQuery::newDocument($html);
        $path = EASYDOCTORPATH . '/doc/' . Arguments::get('p') . '/';
        foreach ($doc->find('img') as $img) {
            pq($img)->attr('src', $path . pq($img)->attr('src'));
        }
        $html = $doc->getDocument();
    }

    /**
     * Crawl the code and set imagepaths absolute
     * @param $html
     */
    public function setResponsiveImages(&$html)
    {
        // images
        $doc = phpQuery::newDocument($html);
        foreach ($doc->find('img') as $img) {
            pq($img)->addClass('img-responsive');
        }
        $html = $doc->getDocument();
    }

    /**
     * Crawl the code and set imagepaths absolute
     * @param $html
     */
    public function addHeaderIds(&$html)
    {
        // images
        $doc = phpQuery::newDocument($html);
        $i = 1;
        foreach ($doc->find('h1') as $h) {
            pq($h)->attr('id', 'page' . $i);
            $i++;
        }
        $i = 1;
        foreach ($doc->find('h2') as $h) {
            pq($h)->attr('id', 'part' . $i);
            $i++;
        }
        $html = $doc->getDocument();
    }

    /**
     * Get the whole content as markdown
     * @return string
     */
    public function getAllAsMarkdown()
    {
        // get contents
        $convertedLines = $this->converter->getConvertedLines();
        // make a string
        $str = [];
        foreach ($convertedLines as $page) {
            foreach ($page as $line) {
                $str[] = $line;
            }
        }
        return implode(PHP_EOL, $str);
    }

    /**
     * Build TOC in markdown
     * @return mixed|string
     */
    public function getMarkdownToc()
    {
        $toc = $this->parser->getToc();

        $data = [];
        $h1count = 1;
        $h2count = 1;
        foreach ($toc as $line) {
            if ($line['type'] == 'h1') {
                $data[] = '* [' . $line['title'] . '](#page'.$h1count.')';
                $h1count++;
            } else {
                $data[] = '     * [' . $line['title'].'](#part'.$h2count.')';
                $h2count++;
            }

        }
        return implode(PHP_EOL, $data);
    }

    public function checkExportDirectory($type = false)
    {
        if (!is_writable('output')) {
            die('fatal error: sorry, the output directory has no write permissions');
        }

        // create directory, if it does not exist
        if (!file_exists('output/' . Arguments::get('p'))) {
            mkdir('output/' . Arguments::get('p'));
        }

        if ($type) {
            mkdir('output/' . Arguments::get('p') . '/' . $type);
        }
    }

    /**
     * @param $folder The folder like images or css
     * @param $type The type like pdf, rst...
     */
    public function copyDocFolder($folder, $type)
    {
        // define paths
        $originDir = 'doc/' . Arguments::get('p') . '/' . $folder;
        $targetDir = 'output/' . Arguments::get('p') . '/' . $type . '/' . $folder;
        // delete old dir, if exists
        $this->rrmdir($targetDir);
        // copy
        $this->recurse_copy($originDir, $targetDir);
    }

    /**
     * @param $folder The folder like images or css
     * @param $type The type like pdf, rst...
     */
    public function copyTemplateFolder($folder, $type)
    {
        // define paths
        $originDir = 'templates/' . $type . '/' . $folder;
        $targetDir = 'output/' . Arguments::get('p') . '/' . $type . '/' . $folder;
        // delete old dir, if exists
        $this->rrmdir($targetDir);
        // copy
        $this->recurse_copy($originDir, $targetDir);
    }

    public function recurse_copy($src, $dst)
    {
        if(!file_exists($src)){
            return false;
        }
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    public function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir . "/" . $object))
                        $this->rrmdir($dir . "/" . $object);
                    else
                        unlink($dir . "/" . $object);
                }
            }
            rmdir($dir);
        }
    }

    /**
     * Debug output
     * @param $text
     */
    public function printOutput($text)
    {
        if (!Arguments::get('verbose')) {
            echo '* ' . $text . "\n";
        }
    }

}