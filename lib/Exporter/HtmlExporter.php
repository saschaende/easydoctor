<?php

namespace SaschaEnde\Easydoctor;

class HtmlExporter extends Exporter
{

    public function execute()
    {
        // pdf?
        if ($this->settings['enable']['html'] == 1) {
            $this->printOutput('html export: enabled, start export');
        } else {
            $this->printOutput('html export: disabled');
            return; // abort
        }


        // get contents
        $convertedLines = $this->converter->getConvertedLines();
        // get table of contents data
        $toc = $this->parser->getToc();
        print_r($toc);
        // check the target directory
        $this->checkExportDirectory('html');
        // copy template folders
        $this->copyTemplateFolder('dist','html');
        $this->copyTemplateFolder('js','html');
        $this->copyTemplateFolder('vendor','html');
    }

}
