# Easydoctor

Fast and easy documentation generator for markdown files: Generate PDF, Latex, RST, HTML Website and many more formats.

* [Easydoctor Website](http://www.easydoctor.org)
* [PDF Example 1 - Syntax tests](https://github.com/saschaende/easydoctor/raw/master/output/test/test.pdf)
* [PDF Example 2 - The easydoc readme](https://github.com/saschaende/easydoctor/raw/master/output/easydoctor/easydoctor.pdf)
* [PDF Example 3 - TYPO3 solr](https://github.com/saschaende/easydoctor/raw/master/output/solr/solr.pdf)
* [HTML Website Example 3 - TYPO3 solr](http://www.easydoctor.org/examples/solr/)

## Features

* Use markdown to write your documentation
* Every chapter one file
* Super Fast
* [GitHub flavored](https://help.github.com/articles/github-flavored-markdown)
* [Markdown Extra support](https://github.com/erusev/parsedown-extra)
* Table of contents will be automatically generated from h1 and h2
* Syntax highlighting for 287 programming languages
* Export to:
    * PDF
    * HTML Website (one page)
    * Latex ([Pandoc](http://pandoc.org/) required)
    * Restructured text ([Pandoc](http://pandoc.org/) required)
    * RTF ([Pandoc](http://pandoc.org/) required)
    * ODT ([Pandoc](http://pandoc.org/) required)

## Download/Installation

Download [latest release](https://github.com/saschaende/easydoctor/releases/latest) and unzip it to a directory **or** clone from git:

<div lang="bash">git clone git@github.com:saschaende/easydoctor.git</div>
    
Or create a new project with composer:

<div lang="bash">composer create-project saschaende/easydoctor</div>
    
Install [Pandoc](http://pandoc.org/) to use the extend features like rst, tex, mediawiki, rtf or rdt export.

## Example

Just execute this in your shell terminal (modify the php interpreter path):

<div lang="bash">G:\xampp\php\php.exe easydoctor.php -p=test</div>

This will make a pdf from the test project in your doc directory. You will find the output in ``output/your_project``

## Arguments

Command                                 | Description
-------------                           | -------------
php easydoctor.php ``-p``=*project*     | project directory in "doc"
php easydoctor.php ``--verbose``        | enable verbose, no output
php easydoctor.php ``--noshl``          | disable syntax highlight

## doc directory: Projects strucure

* doc
    * project
        * Images for your documentation project: images/*
        * project.ini ``project configuration file``
        * doc1.md
        * doc2.md
        * ...
    
## Important to know

* h1 and h2 will be used for the TOC (table of contents)
* Define the ordering by naming the files for example with numbers
* You can configure the pandoc path in ``easydoctor.ini``

# Syntax highlighting

## How to use

Example:

    <div lang="language">YOUR CODE</div>

## Supported languages:
    
* 4cs 
* 6502acme 
* 6502kickass 
* 6502tasm 
* 68000devpac 
* abap 
* actionscript 
* actionscript3 
* ada 
* aimms 
* algol68 
* apache 
* applescript 
* apt_sources 
* arm 
* asm 
* asp 
* asymptote 
* autoconf 
* autohotkey 
* autoit 
* avisynth 
* awk 
* bascomavr 
* bash 
* basic4gl 
* batch 
* bf 
* biblatex 
* bibtex 
* blitzbasic 
* bnf 
* boo 
* c 
* c_loadrunner 
* c_mac 
* c_winapi 
* caddcl 
* cadlisp 
* ceylon 
* cfdg 
* cfm 
* chaiscript 
* chapel 
* cil 
* clojure 
* cmake 
* cobol 
* coffeescript 
* cpp-qt 
* cpp-winapi 
* cpp 
* csharp 
* css 
* cuesheet 
* d 
* dart 
* dcl 
* dcpu16 
* dcs 
* delphi 
* diff 
* div 
* dos 
* dot 
* e 
* ecmascript 
* eiffel 
* email 
* epc 
* erlang 
* euphoria 
* ezt 
* f1 
* falcon 
* fo 
* fortran 
* freebasic 
* freeswitch 
* fsharp 
* gambas 
* gdb 
* genero 
* genie 
* gettext 
* glsl 
* gml 
* gnuplot 
* go 
* groovy 
* gwbasic 
* haskell 
* haxe 
* hicest 
* hq9plus 
* html4strict 
* html5 
* icon 
* idl 
* ini 
* inno 
* intercal 
* io 
* ispfpanel 
* j 
* java 
* java5 
* javascript 
* jcl 
* jquery 
* julia 
* kixtart 
* klonec 
* klonecpp 
* kotlin 
* latex 
* lb 
* ldif 
* lisp 
* llvm 
* locobasic 
* logtalk 
* lolcode 
* lotusformulas 
* lotusscript 
* lscript 
* lsl2 
* lua 
* m68k 
* magiksf 
* make 
* mapbasic 
* mathematica 
* matlab 
* mercury 
* metapost 
* mirc 
* mk-61 
* mmix 
* modula2 
* modula3 
* mpasm 
* mxml 
* mysql 
* nagios 
* netrexx 
* newlisp 
* nginx 
* nimrod 
* nsis 
* oberon2 
* objc 
* objeck 
* ocaml-brief 
* ocaml 
* octave 
* oobas 
* oorexx 
* oracle11 
* oracle8 
* oxygene 
* oz 
* parasail 
* parigp 
* pascal 
* pcre 
* per 
* perl 
* perl6 
* pf 
* phix 
* php-brief 
* php 
* pic16 
* pike 
* pixelbender 
* pli 
* plsql 
* postgresql 
* postscript 
* povray 
* powerbuilder 
* powershell 
* proftpd 
* progress 
* prolog 
* properties 
* providex 
* purebasic 
* pycon 
* pys60 
* python 
* q 
* qbasic 
* qml 
* racket 
* rails 
* rbs 
* rebol 
* reg 
* rexx 
* robots 
* rpmspec 
* rsplus 
* ruby 
* rust 
* sas 
* sass 
* scala 
* scheme 
* scilab 
* scl 
* sdlbasic 
* smalltalk 
* smarty 
* spark 
* sparql 
* sql 
* standardml 
* stonescript 
* swift 
* systemverilog 
* tcl 
* tclegg 
* teraterm 
* texgraph 
* text 
* thinbasic 
* tsql 
* twig 
* typoscript 
* unicon 
* upc 
* urbi 
* uscript 
* vala 
* vb 
* vbnet 
* vbscript 
* vedit 
* verilog 
* vhdl 
* vim 
* visualfoxpro 
* visualprolog 
* whitespace 
* whois 
* winbatch 
* xbasic 
* xml 
* xojo 
* xorg_conf 
* xpp 
* xyscript 
* yaml 
* z80 
* zxbasic 