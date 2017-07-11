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
        $this->copyTemplateFolder('dist', 'html');
        $this->copyTemplateFolder('js', 'html');
        $this->copyTemplateFolder('vendor', 'html');

        // get contents
        $convertedLines = $this->converter->getConvertedLines();

        // get menue
        $menue = $this->getMenue();

        $pageNum = 1;
        foreach ($convertedLines as $page) {
            // new page, if it is h1
            $header = $this->parser->checkForHeader($page[0]);
            if($header[1] == 'h1'){
                // new page
            }

            // get a string from the lines
            $md = implode(PHP_EOL, $page);
            // convert to html
            $html = $this->getHtmlFromMarkdown($md);
            // render
            $this->renderPage($html,$menue,'page'.$pageNum.'.html');
            // increment page
            $pageNum++;
        }


    }

    public function getMenue()
    {
        $toc = $this->parser->getToc();
        $tocPath = 'templates/html/toc.php';
        // execute include and return the results
        ob_start();
        require($tocPath);
        return ob_get_clean();
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
