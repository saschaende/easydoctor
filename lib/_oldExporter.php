<?php

namespace SaschaEnde\Easydoctor;

class _oldExporter extends Easydoctor
{
    private $settings = [];
    private $contents_table;
    private $pages = [];
    private $pandocFormats = [
        ['rst','rst'],
        ['latex','tex'],
        ['rtf','rtf'],
        ['opendocument','odt'],
        ['html5','html']
    ];

    public function __construct()
    {
        $this->settings = parse_ini_file('easydoctor.ini',true);
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
        // pdf?
        if($this->settings['enable']['pdf'] == 1){
            $this->printOutput('pdf export: enabled, start export');
            $this->exportPDF();
        }else{
            $this->printOutput('pdf export: disabled');
        }

        // Pandoc?

        if(!empty($this->settings['paths']['pandoc'])){

            $pagesCompact = $this->compact();

            foreach($this->pandocFormats as $format){
                if($this->settings['enable'][$format[1]]){
                    $this->printOutput($format[1].' export: enabled, start export');
                    $this->exportPandoc($pagesCompact, $format[0],$format[1]);
                }else{
                    $this->printOutput($format[1].' export: disabled');
                }
            }
        }else{
            $this->printOutput('pandoc not configured');
        }
    }

    /**
     * PDF Export
     */
    private function exportPDF()
    {
        // create directory, if it does not exist
        $this->checkExportDirectory('pdf');

        // initialize some extensions
        $pd = new \ParsedownExtra();
        $mpdf = new \mPDF();

        // generate document basics
        $stylesheet = file_get_contents('doc/' . Arguments::get('p') . '/css/style.css');
        $mpdf->WriteHTML('<style>' . $stylesheet . '</style>');
        $mpdf->setFooter('{PAGENO}');

        // put contents
        $html = $pd->text($this->contents_table);
        $mpdf->WriteHTML('<html><body><article class="markdown-body">' . $html . '</article></body></html>');

        // add pages
        $pagenum = 1;
        foreach ($this->pages as $page) {
            $html = $pd->text($page);
            $mpdf->AddPage();
            $mpdf->WriteHTML('<html><body><article class="markdown-body"><a name="page' . $pagenum . '"></a>' . $html . '</article></body></html>');
            // Get current page number after this code
            $mpdf->PageNo();
            $pagenum++;
        }

        // save pdf
        $pdfPath = 'output/pdf/' . Arguments::get('p') . '-' . time() . '-' . date('d-m-Y') . '.pdf';
        $mpdf->Output($pdfPath, 'F');
        $this->printOutput('pdf exported to: '.$pdfPath);
    }

    /**
     * Compact all pages in one string
     * @param string $divider
     * @return string
     */
    private function compact($divider = "\n\n"){
        $p = [];
        $p[] = $this->contents_table;
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
        // save page to temp
        $tmp_path = 'output/tmp.md';
        $targetPath = 'output/'.$extension.'/' . Arguments::get('p') . '-' . time() . '-' . date('d-m-Y') . '.'.$extension;

        $this->checkExportDirectory($extension);

        file_put_contents($tmp_path,$page);

        $output = shell_exec($this->settings['paths']['pandoc'].' '.$tmp_path.' --top-level-division=chapter -f markdown_phpextra -t '.$command.' -s -o '.$targetPath);

        unlink($tmp_path);
    }

    private function checkExportDirectory($dirname){
        if(!is_writable('output')){
            $this->printOutput('fatal error: sorry, the output directory has no write permissions');
            exit;
        }

        // create directory, if it does not exist
        if(!file_exists('output/'.$dirname)){
            mkdir('output/'.$dirname);
        }
    }

}