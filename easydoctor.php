#!/usr/bin/env php
<?php

error_reporting(E_ERROR);

/**
 * @todo Watch task (Daniel Köthers Idee)
 */

// composer autoloader
require_once __DIR__ . '/vendor/autoload.php';
define('EASYDOCTORPATH',__DIR__);

// Require composer autoloader and load libraries
use SaschaEnde\Easydoctor\Arguments;
use SaschaEnde\Easydoctor\Converter;
use SaschaEnde\Easydoctor\Easydoctor;
use SaschaEnde\Easydoctor\Exporter;
use SaschaEnde\Easydoctor\Importer;
use SaschaEnde\Easydoctor\PandocExporter;
use SaschaEnde\Easydoctor\Parser;
use SaschaEnde\Easydoctor\PdfExporter;
use SaschaEnde\Easydoctor\HtmlExporter;

Arguments::getArguments();

// checks
if(!is_string(Arguments::get('p'))){
    echo 'error: please define a project. Syntax, for example: php easydoctor.php -p=test';
    exit;
}

// import files
$importer = new Importer();
// parse the lines to get headings and toc
$parser = new Parser($importer->getLines());
// get back parsed markdown from the lines
$converter = new Converter($parser->getParsedLines());

// Export
$pdfExporter = new PdfExporter($importer,$parser,$converter);
$pdfExporter->execute();

$pandocExporter = new PandocExporter($importer,$parser,$converter);
$pandocExporter->execute();

$htmlExporter = new HtmlExporter($importer,$parser,$converter);
$htmlExporter->execute();