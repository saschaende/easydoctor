# Easydoctor

Fast and easy documentation generator for markdown files

[Website](http://easydoctor.sascha-ende.de) | [Example 1 - Syntax tests](https://github.com/saschaende/easydoctor/raw/master/output/pdf/test.pdf)  | [Example 2 - The easydoc readme](https://github.com/saschaende/easydoctor/raw/master/output/pdf/easydoctor.pdf)

## Features

* Use markdown to write your documentation
* Every chapter one file
* Super Fast
* [GitHub flavored](https://help.github.com/articles/github-flavored-markdown)
* [Markdown Extra support](https://github.com/erusev/parsedown-extra)
* Table of contents will be automatically generated from h1 and h2
* PHP Syntax highlighting
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

    git clone git@github.com:saschaende/easydoctor.gi
    
Or create a new project with composer:

    composer create-project saschaende/easydoctor

## Example

Just execute this in your shell terminal:

``` 
php easydoctor -p test
```

This will make a pdf from the test project in your doc directory. You will find the pdf in `output/pdf`

## Arguments

`php easydoctor -p project` project directory in "doc"

`php easydoctor -v 1` verbose, no output

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

## PHP Syntax highlight in your markdown files

Example:

    <div lang="php">YOUR PHP CODE</div>
    
[1]: http://pandoc.org/  "Pandoc"