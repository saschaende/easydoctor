# Easydoctor

Kostenloser und einfacher Generator für die Erstellung von Dokumentationen, basierend auf MARKDOWN. Easydoctor generiert
automatisch PDFs, Webseiten oder Latex/RST/Mediawiki/RTF/ODT Dokumente.

* [Easydoctor offizielle Webseite](http://www.easydoctor.org)
* [Easydoctor auf GITHUB](https://github.com/saschaende/easydoctor)
* [Easydoctor auf PACKAGIST](https://packagist.org/packages/saschaende/easydoctor)

## PDF Beispiele

* [PDF Beispiel 1 - Syntax tests](https://github.com/saschaende/easydoctor/raw/master/output/test/test.pdf)
* [PDF Beispiel 2 - The easydoc readme](https://github.com/saschaende/easydoctor/raw/master/output/easydoctor/easydoctor.pdf)
* [PDF Beispiel 3 - TYPO3 solr](https://github.com/saschaende/easydoctor/raw/master/output/solr/solr.pdf)

## HTML Beispiele

* This website :)
* [HTML Website Example 3 - TYPO3 solr](http://www.easydoctor.org/examples/solr/)

## Funktionen

* Benutze MARKDOWN um Deine Dokumentation zu schreiben
* Fasst Dokumentationen die aus mehreren Dateien bestehen zusammen 
* Sehr schnell und einfach
* [GitHub flavored](https://help.github.com/articles/github-flavored-markdown)
* [Markdown Extra support](https://github.com/erusev/parsedown-extra)
* Inhaltsverzeichnis wird automatisch aus den Überschriften H1 oder H2 erstellt
* Syntax Hervorhebung für 287 Programmiersprachen
* Export in:
    * PDF
    * HTML Website (one page)
    * Latex ([Pandoc](http://pandoc.org/) required)
    * Restructured text ([Pandoc](http://pandoc.org/) required)
    * RTF ([Pandoc](http://pandoc.org/) required)
    * ODT ([Pandoc](http://pandoc.org/) required)

## Download/Installation

[Lade das neueste Release runter](https://github.com/saschaende/easydoctor/releases/latest) und entpacke es in
 ein Verzeichnis **oder** klone es von GIT:

<div lang="bash">git clone git@github.com:saschaende/easydoctor.git</div>
    
Oder erstelle mit COMPOSER ein neues Projekt:

<div lang="bash">composer create-project saschaende/easydoctor</div>
    
Installiere [Pandoc](http://pandoc.org/) um erweiterte Funktionalitäten wie den Export nach rst, tex, 
mediawiki, rtf oder rdt zu nutzen.

## Beispiel

Führe einfach diesen Befehl in Deinem Terminal aus (passe den PHP Interpreter Pfad gegebenfalls an):

<div lang="bash">G:\xampp\php\php.exe easydoctor.php -p=test</div>

Dieser Befehl erstellt automatisch ein PDF und die entsprechenden Dokumentationen für das Projekt **test**.
Du findest das Ergebnis dann im Ordner ``output/dein_projekt``

## Arguments

Command                                 | Description
-------------                           | -------------
php easydoctor.php ``-p``=*project*     | Projekt Verzeichnis, befindet sich in "doc"
php easydoctor.php ``--verbose``        | Keine Ausgaben erzeugen
php easydoctor.php ``--noshl``          | Syntax Hervorhebung deaktivieren

## Verzeichnisstruktur eines Projektes

Die Dokumentationsprojekte befinden sich im Ordner "doc", dort solltest Du auch Deines anlegen.

* doc
    * Projekt
        * images ```Bilder für Dein Projekt```
        * project.ini ``Projekt Konfigurationsdatei``
        * doc1.md ``Dokumentationsdateien in Markdown``
        * doc2.md ``Dokumentationsdateien in Markdown``
        * ... ``Dokumentationsdateien in Markdown``
    
## Important to know

* Überschriften H1 und H2 werden für die automaische Generierung des Inhaltsverzeichnisses genutzt.
* Sortiere die Dokumentationsdateien, indem Du sie z.B. numerisch benennst.
* Der Pfad zu PANDO kann in der Datei ``easydoctor.ini`` festgelegt werden.

# Syntax Hervorhebung

## Wie funktionierts?

Beispiel:

    <div lang="language">YOUR CODE</div>

## Unterstützte Sprachen:
    
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

# Impressum

* Sascha Ende / Kathrin Ende weebster GbR
* Skagenhof 9, 30457 Hannover, Germany
* Phone: +49-(0)511-12226806
* Email: info@sascha-ende.de
* USt-IdNr.: DE294748666