<?php

namespace SaschaEnde\Easydoctor;

class PandocExporter extends Exporter {

    public function __construct($md)
    {
        $this->setMarkdown($md);
    }

}
