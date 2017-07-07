<?php

namespace SaschaEnde\Easydoctor;

class PandocExporter extends Exporter {

    private $pandocFormats = [
        ['rst','rst'],
        ['latex','tex'],
        ['rtf','rtf'],
        ['opendocument','odt'],
        ['mediawiki','mediawiki']
    ];

    public function execute()
    {
        // Pandoc?
        if(!empty($this->settings['paths']['pandoc'])){
            foreach($this->pandocFormats as $format){
                if($this->settings['enable'][$format[1]]){
                    $this->printOutput($format[1].' export: enabled, start export');
                    // do something

                    $this->checkExportDirectory($format[1]);
                    $this->copyDocFolder('images',$format[1]);

                }else{
                    $this->printOutput($format[1].' export: disabled');
                }
            }
        }else{
            $this->printOutput('pandoc not configured');
        }
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

        file_put_contents($tmp_path,$this->importer->getLines());

        $output = shell_exec($this->settings['paths']['pandoc'].' '.$tmp_path.' --top-level-division=chapter -f markdown_phpextra -t '.$command.' -s -o '.$targetPath);

        unlink($tmp_path);
    }



}
