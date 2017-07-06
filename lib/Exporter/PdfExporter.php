<?php

namespace SaschaEnde\Easydoctor;

use PhpQuery\phpQuery;
use function PhpQuery\pq;

class PdfExporter extends Exporter
{

    var $debug = [];

    public function execute()
    {
        // first time, to generate page nums for the toc
        $mpdf = new \mPDF();
        $this->generatePdf($mpdf);

        // second time for output
        $mpdf = new \mPDF();
        $this->generatePdf($mpdf);

        // save pdf
        $pdfPath = 'output/' . Arguments::get('p') . '/' . Arguments::get('p') . '.pdf';
        $this->checkExportDirectory();
        $mpdf->Output($pdfPath, 'F');
    }

    private function generatePdf(\mPDF &$mpdf){
        $mpdf->setFooter('{PAGENO}');

        // load stylesheet
        $cssPath = 'doc/' . Arguments::get('p') . '/css/style.css';
        if (!file_exists($cssPath)) {
            $cssPath = 'templates/pdf/style.css';
        }
        $stylesheet = file_get_contents($cssPath);

        // set start of the document
        $mpdf->WriteHTML('<html><header><style>' . $stylesheet . '</style></header><body><div class="page-body">');

        // TOC
        $toc = $this->getToc();
        $mpdf->WriteHTML('<article class="markdown-body">'.$toc.'</article>');

        // get contents
        $convertedLines = $this->converter->getConvertedLines();

        // Add Lines to pdf
        $tocNum = 0;
        foreach($convertedLines as $page){

            // new page, if it is h1
            $header = $this->parser->checkForHeader($page[0]);
            if($header[1] == 'h1'){
                $mpdf->AddPage();
            }

            // get the actual page
            $pageNo = $mpdf->PageNo();

            // update pagenum on toc
            if($header[1] == 'h1' || $header[1] == 'h2'){
                $this->parser->updateToc($tocNum,'page',$pageNo);
                $tocNum++;
            }

            // get a string from the lines
            $md = implode(PHP_EOL,$page);
            // convert to html
            $html = $this->getHtmlFromMarkdown($md);
            // images
            $this->setAbsoluteImagePaths($html);

            // add the html to the pdf
            $mpdf->WriteHTML('<article class="markdown-body">'.$html.'</article>');
        }

        // set contents
        $mpdf->WriteHTML('</div></body></html>');
    }

    private function getToc()
    {
        $toc = $this->parser->getToc();
        $data = [];
        $data[] = "# Inhalt";
        foreach($toc as $line){
            if($line['type'] == 'h1'){
                $data[] = '* **['.$line['title'].'](#heading'.$line['num'].')** [Seite '.$line['page'].']';
            }else{
                $data[] = '     * ['.$line['title'].'](#heading'.$line['num'].') [Seite '.$line['page'].']';
            }

        }
        return $this->getHtmlFromMarkdown(implode("\n",$data));
    }
}
