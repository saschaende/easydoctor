<?php

namespace SaschaEnde\Easydoctor;

use function file_put_contents;

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
        // check the target directory
        $this->checkExportDirectory('html');
        // copy folders
        $this->copyDocFolder('images', 'html');
        $this->copyTemplateFolder('vendor', 'html');

        // get contents
        $mdContents = $this->getAllAsMarkdown();
        $html = $this->getHtmlFromMarkdown($mdContents);

        // make images responsive
        $this->setResponsiveImages($html);

        // add ids to the headers
        $this->addHeaderIds($html);

        // get menue
        $menue = $this->getMenue();

        // render
        $this->renderPage($html,$menue,'index.html');


    }

    public function getMenue()
    {
        $md = $this->getMarkdownToc();
        return $this->getHtmlFromMarkdown($md);
    }

    /**
     * @param $doc documentation html
     * @param $toc table of contents html
     * @param $fileName filename of target file
     */
    public function renderPage($doc, $toc, $fileName)
    {
        // render
        $tocPath = 'templates/html/template.php';
        // execute include and return the results
        ob_start();
        require($tocPath);
        $html = ob_get_clean();
        // save the page
        $pagePath = 'output/' . Arguments::get('p') . '/html/' . $fileName;
        if(!file_put_contents($pagePath,$html)){
            $this->printOutput('Unable to write to '.$pagePath);
        }
    }

}
