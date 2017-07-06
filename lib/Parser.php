<?php

namespace SaschaEnde\Easydoctor;

/**
 * Parse and edit the code
 * @package SaschaEnde\Easydoctor
 */
class Parser {

    private $toc = [];
    private $linesParsed = [];

    /**
     * Get the lines and prepare them for parsing
     * @param array $lines
     */
    public function __construct($lines = [])
    {
        // Check for headers
        $i = 0;
        foreach($lines as $lineNum=>$line){
            $this->removeNewlines($line);
            $header = $this->checkForHeader($line);
            if($header){
                // increment the heading
                $i++;
                // Add to toc
                $this->addToc($i,$header[0],$header[1]);
                // set an anchor
                $this->linesParsed[$i][] = $line.'<a name="heading'.$i.'"></a>';
            }else{
                $this->linesParsed[$i][] = $line;
            }
        }
    }

    /**
     * Get the table of contents as an array
     * @return array
     */
    public function getToc(){
        return $this->toc;
    }

    public function removeNewlines(&$md){
        $md = str_replace(PHP_EOL,'',$md);
    }

    /**
     * Get the parsed lines
     * @return array
     */
    public function getParsedLines(){
        return $this->linesParsed;
    }

    /**
     * Add to the table of contents array
     * @param $num
     * @param $title
     * @param $type
     */
    public function addToc($num,$title,$type){
        $this->toc[] = [
            'num'   =>  $num,
            'title' =>  $title,
            'type'  =>  $type,
            'page'  =>  0
        ];
    }

    public function updateToc($pos,$key,$value){
        $this->toc[$pos][$key] = $value;
    }

    /**
     * Check if there is a headline in the line
     * @param $content
     * @return array|bool
     */
    public function checkForHeader($content){
        preg_match_all('/(#+)(.*)/', $content, $matches);
        foreach ($matches[2] as $key => $match) {

            $value = trim($match);

            if (strlen($matches[1][$key]) == 1) {
                return [$value,'h1'];
            }
            if (strlen($matches[1][$key]) == 2) {
                return [$value, 'h2'];
            }
        }

        return false;
    }

}