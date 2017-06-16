# Easydoctor

Fast and easy documentation generator for markdown files

[Website](http://easydoctor.sascha-ende.de) | [Example 1 - Syntax tests](test-1497606995-16-06-2017.pdf)  | [Example 2 - The easydoc readme](https://github.com/saschaende/easydoctor/raw/master/output/pdf/easydoctor-1497606999-16-06-2017.pdf)

### Features

* You can use markdown
* Super Fast
* [GitHub flavored](https://help.github.com/articles/github-flavored-markdown)
* [Markdown Extra support](https://github.com/erusev/parsedown-extra)
* Generate pdf document from markdown
* Table of contents will be automatically generated from h1 and h2

### Planned

* Also support latex and restructured text (Pandoc required)
* Generate website from markdown
* Generate restructured text files from markdown (Pandoc required)
* Code syntax highlighting for php code

### Installation

Download [latest release](https://github.com/saschaende/easydoctor/releases/latest) and unzip it to a directory **or** clone from git:

    git clone git@github.com:saschaende/easydoctor.gi
    
Or create a new project with composer:

    composer create-project saschaende/easydoctor

### Example

Just execute this in your shell terminal:

``` 
php easydoctor test
```

This will make a pdf from the test project in your doc directory. You will find the pdf in `output/pdf`

### Projects strucure

* project
    * CSS for documentation: css/style.css
    * Images for your documentation project: images/*
    * doc1.md
    * doc2.md
    * ...
    
### Important

* Every documentation page only has one h1, this will be used for table of contents
* h2 will be used as subpages in the table of contents
* Define the ordering by naming the files for example with numbers