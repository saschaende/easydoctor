<?php

namespace SaschaEnde\Easydoctor;

use function htmlspecialchars;
use function in_array;
use function preg_match;

/**
 * The converter prepares markdown for exporters
 * @package SaschaEnde\Easydoctor
 */
class Converter
{

    private $convertedLines;

    public function __construct($parsedLines = [])
    {
        foreach ($parsedLines as $pageNum => $page) {
            // create a string and parse things
            $md = implode(PHP_EOL, $parsedLines[$pageNum]);
            $this->renderProgrammingCode($md);

            // get back an aray with lines
            $parsedLines[$pageNum] = explode(PHP_EOL, $md);
        }
        $this->convertedLines = $parsedLines;
    }

    public function getConvertedLines()
    {
        return $this->convertedLines;
    }

    /**
     * Extend markdown for rendering inline php code
     * @param $md
     */
    protected function renderProgrammingCode(&$md)
    {
        // syntax highlighting disabled
        if (Arguments::get('noshl')) {
            // syntax highlighting disabled
            $md = preg_replace_callback('/<div lang="(.*?)">(.*?)<\/div>/s', function ($matches) {

                $lines = explode(PHP_EOL, $matches[2]);
                array_walk($lines, function (&$value) {
                    $value = "\t" . $value;
                });

                return implode(PHP_EOL, $lines);

            }, $md);
        } else {
            // syntax highlighting enabled
            $md = preg_replace_callback('/<div lang="(.*?)">(.*?)<\/div>/sm', function ($matches) {
                $geshi = new \GeSHi(trim($matches[2]), $matches[1]);
                $lang = $geshi->get_supported_languages();
                if (!in_array($matches[1], $lang)) {
                    return $matches[0];
                }
                $geshi->set_header_type(GESHI_HEADER_NONE);
                $geshi->set_line_ending("\n");
                return '<pre><code>' . $geshi->parse_code() . '</code></pre>';
            }, $md);
        }
    }

}