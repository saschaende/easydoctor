# Easydoctor

Fast and easy documentation generator for markdown files: Generate PDF, Latex, RST, HTML Website and many more formats.

[Website](http://easydoctor.sascha-ende.de)
| [Example 1 - Syntax tests](https://github.com/saschaende/easydoctor/raw/master/output/pdf/test.pdf)
| [Example 2 - The easydoc readme](https://github.com/saschaende/easydoctor/raw/master/output/pdf/easydoctor.pdf)
| [Example 3 - TYPO3 solr](https://github.com/saschaende/easydoctor/raw/master/output/solr/solr.pdf)

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
    * Plain HTML ([Pandoc][1] required)
    * Latex ([Pandoc][1] required)
    * Restructured text ([Pandoc][1] required)
    * RTF ([Pandoc][1] required)
    * ODT ([Pandoc][1] required)

## Planned

* Generate website from markdown
* Syntax highlight support for more languages

## Installation

Download [latest release](https://github.com/saschaende/easydoctor/releases/latest) and unzip it to a directory **or** clone from git:

    git clone git@github.com:saschaende/easydoctor.git
    
Or create a new project with composer:

    composer create-project saschaende/easydoctor

## Example

Just execute this in your shell terminal (modify the php interpreter path):

    G:\xampp\php\php.exe easydoctor.php -p=test

This will make a pdf from the test project in your doc directory. You will find the pdf in `output/pdf`

## Arguments

Command                                 | Description
-------------                           | -------------
php easydoctor.php **-p**=*project*     | project directory in "doc"
php easydoctor.php **-v**               | enable verbose, no output
php easydoctor.php **-h**               | disable syntax highlight

## doc directory: Projects strucure

* doc
    * project
        * CSS for documentation: css/style.css
        * Images for your documentation project: images/*
        * doc1.md
        * doc2.md
        * ...
    
## Important to know

* Every documentation page only has one h1, this will be used for table of contents
* h2 will be used as subpages in the table of contents
* Define the ordering by naming the files for example with numbers
* You can configure easydoc with ``easydoctor.ini``

# Syntax highlighting

## How to use

Example:

    <div lang="php">YOUR PHP CODE</div>
    
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
    
    
[1]: http://pandoc.org/  "Pandoc"