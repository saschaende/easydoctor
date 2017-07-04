<?php

namespace SaschaEnde\Easydoctor;

use PhpQuery\phpQuery;
use function PhpQuery\pq;

class Exporter
{
    public $importer;
    public $parser;
    public $converter;


    public function __construct(Importer $importer, Parser $parser, Converter $converter)
    {
        $this->importer = $importer;
        $this->parser = $parser;
        $this->converter = $converter;
    }

    public function execute(){

    }

    public function getHtmlFromMarkdown($md){
        $pd = new \ParsedownExtra();
        return $pd->text($md);
    }

    public function setAbsoluteImagePaths(&$html){
        // images
        $doc = phpQuery::newDocument($html);
        $path = EASYDOCTORPATH.'/doc/'.Arguments::get('p').'/';
        foreach($doc->find('img') as $img){
            pq($img)->attr('src',$path. pq($img)->attr('src'));
        }
        $html = $doc->getDocument();
    }

    public function checkExportDirectory(){
        if(!is_writable('output')){
            die('fatal error: sorry, the output directory has no write permissions');
        }

        // create directory, if it does not exist
        if(!file_exists('output/'.Arguments::get('p'))){
            mkdir('output/'.Arguments::get('p'));
        }
    }

}