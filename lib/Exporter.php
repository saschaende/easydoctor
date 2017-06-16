<?php

namespace SaschaEnde\Easydoctor;

class Exporter
{

    private $args = [];
    private $settings = [];
    private $contents_table;
    private $pages = [];
    private $pandocFormats = [
        ['rst','rst'],
        ['latex','tex'],
        ['rtf','rtf'],
        ['opendocument','odt'],
    ];

    public function __construct($args)
    {
        $this->settings = parse_ini_file('easydoctor.ini',true);
        $this->args = $args;
    }

    /**
     * Set table of contents
     * @param $md
     */
    public function setContents($md)
    {
        $this->contents_table = $md;
    }

    /**
     * Add a page
     * @param $md
     */
    public function addPage($md)
    {
        $this->pages[] = $md;
    }

    /**
     * Finally render all
     */
    public function render(){
        if($this->settings['enabled']['pdf'] == 1){
            $this->exportPDF();
        }
        foreach($this->pandocFormats as $format){
            if($this->settings['enabled'][$format[1]]){
                $this->exportPandoc($format[0],$format[1]);
            }
        }
    }

    /**
     * PDF Export
     */
    private function exportPDF()
    {
        // initialize some extensions
        $pd = new \ParsedownExtra();
        $mpdf = new mPDF();

        // generate document basics
        $stylesheet = file_get_contents('doc/' . $this->args['project'] . '/css/style.css');
        $mpdf->WriteHTML('<style>' . $stylesheet . '</style>');
        $mpdf->setFooter('{PAGENO}');

        // put contents
        $html = $pd->text($this->contents_table);
        $mpdf->WriteHTML('<html><body>' . $html . '</body></html>');

        // add pages
        $pagenum = 1;
        foreach ($this->pages as $page) {
            $html = $pd->text($page);
            $mpdf->AddPage();
            $mpdf->WriteHTML('<html><body><a name="page' . $pagenum . '">' . $html . '</body></html>');
            $pagenum++;
        }

        // save pdf
        $pdfPath = 'output/pdf/' . $this->args['project'] . '-' . time() . '-' . date('d-m-Y') . '.pdf';
        $mpdf->Output($pdfPath, 'F');
    }

    /**
     * Compact all pages in one string
     * @param string $divider
     * @return string
     */
    private function compact($divider = ''){
        $p = $this->contents_table;
        foreach ($this->pages as $page) {
            $p[] = $page;
        }
        return implode($divider,$p);
    }

    /**
     * Export other formats with pandoc
     * @param $page
     * @param $command
     * @param $extension
     */
    private function exportPandoc($page,$command,$extension)
    {
        $output = shell_exec($this->settings['paths']['pandoc'].' seite1.md --top-level-division=chapter -f markdown_phpextra -t rst -s -o seite1.rst');
    }

}