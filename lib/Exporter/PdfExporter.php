<?php

namespace SaschaEnde\Easydoctor;
use PhpQuery\phpQuery;
use function PhpQuery\pq;

class PdfExporter extends Exporter {

    public function execute(){

        $mpdf = new \mPDF();
        $mpdf->setFooter('{PAGENO}');

        // load stylesheet
        $cssPath = 'doc/' . Arguments::get('p') . '/css/style.css';
        if(!file_exists($cssPath)){
            $cssPath = 'templates/pdf/style.css';
        }
        $stylesheet = file_get_contents($cssPath);
        $mpdf->WriteHTML('<style>' . $stylesheet . '</style>');

        // get contents
        $md = $this->converter->getMarkdown();
        $html = $this->getHtmlFromMarkdown($md);

        // pagebreaks
        $doc = phpQuery::newDocument($html);
        $doc->find('h1')->prepend('<pagebreak>');
        $html = $doc->getDocument();

        // images
        $this->setAbsoluteImagePaths($html);

        // set contents
        $mpdf->WriteHTML('<html><body><article class="markdown-body">' . $html . '</article></body></html>');

        // save pdf
        $pdfPath = 'output/' . Arguments::get('p') . '/' . Arguments::get('p') . '.pdf';
        $this->checkExportDirectory();
        $mpdf->Output($pdfPath, 'F');
    }

}
