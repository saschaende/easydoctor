<?php

namespace SaschaEnde\Easydoctor;

use PhpQuery\phpQuery;
use function PhpQuery\pq;

class PdfExporter extends Exporter
{

    public function execute()
    {

        $mpdf = new \mPDF();
        $mpdf->setFooter('{PAGENO}');

        // load stylesheet
        $cssPath = 'doc/' . Arguments::get('p') . '/css/style.css';
        if (!file_exists($cssPath)) {
            $cssPath = 'templates/pdf/style.css';
        }
        $stylesheet = file_get_contents($cssPath);
        $mpdf->WriteHTML('<style>' . $stylesheet . '</style>');

        // TOC
        $toc = $this->getToc();

        // get contents
        $md = $this->converter->getMarkdown();
        $html = $this->getHtmlFromMarkdown($md);

        // pagebreaks
        $html = str_replace('<h1>','<pagebreak><h1>',$html);

        // images
        $this->setAbsoluteImagePaths($html);

        // set contents
        $mpdf->WriteHTML('<html><body><article class="markdown-body">' . $toc.$html . '</article></body></html>');
        echo $html;

        // save pdf
        $pdfPath = 'output/' . Arguments::get('p') . '/' . Arguments::get('p') . '.pdf';
        $this->checkExportDirectory();
        $mpdf->Output($pdfPath, 'F');
    }

    private function getToc()
    {
        $toc = $this->parser->getToc();
        $data = [];
        $data[] = "# Inhalt";
        foreach($toc as $line){
            if($line['type'] == 'h1'){
                $data[] = '* **['.$line['title'].'](#heading'.$line['num'].')**';
            }else{
                $data[] = '     * ['.$line['title'].'](#heading'.$line['num'].')';
            }

        }
        return $this->getHtmlFromMarkdown(implode("\n",$data));
    }

}
