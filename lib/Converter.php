<?php

namespace SaschaEnde\Easydoctor;

/**
 * The converter prepares markdown for exporters
 * @package SaschaEnde\Easydoctor
 */
class Converter {

    private $convertedLines;

    public function __construct($parsedLines = [])
    {
        foreach($parsedLines as $pageNum=>$page){
            // create a string and parse things
            $md = implode(PHP_EOL,$parsedLines[$pageNum]);
            $this->renderProgrammingCode($md);

            // get back an aray with lines
            $parsedLines[$pageNum] = explode(PHP_EOL,$md);
        }
        $this->convertedLines = $parsedLines;
    }

    public function getConvertedLines(){
        return $this->convertedLines;
    }

    /**
     * Convert Markdown to html
     * @param $md
     * @return mixed|string
     */
    protected function convertToHtml($md){
        $pd = new \ParsedownExtra();
        return $pd->text($md);
    }

    /**
     * Extend markdown for rendering inline php code
     * @param $md
     */
    protected function renderProgrammingCode(&$md)
    {
        // syntax highlighting disabled
        if (Arguments::get('sh') == 'off') {
            return;
        }
        // syntax highlighting enabled
        $md = preg_replace_callback('/<div lang="(.*?)">(.*?)<\/div>/sm', function ($matches) {
            $geshi = new \GeSHi(trim($matches[2]), $matches[1]);
            $geshi->set_header_type(GESHI_HEADER_NONE);
            return '<pre><code>' . $geshi->parse_code() . '</code></pre>';
        }, $md);
    }

}