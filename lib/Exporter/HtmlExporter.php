<?php

namespace SaschaEnde\Easydoctor;

class HtmlExporter extends Exporter {

    public function __construct($md)
    {
        $this->setMarkdown($md);
    }

}
