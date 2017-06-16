# Easydoctor

Fast and easy documentation generator for markdown files

[Website](http://easydoctor.sascha-ende.de) | [Demo](http://easydoctor.sascha-ende.de/demo)

### Features

* You can use markdown
* Super Fast
* [GitHub flavored](https://help.github.com/articles/github-flavored-markdown)
* [Markdown Extra support](https://github.com/erusev/parsedown-extra)
* Generate pdf document from markdown
* Table of contents will be automatically generated from h1 and h2

### Planned

* Generate website from markdown
* Code syntax highlighting for php code

### Installation

Download [latest release](https://github.com/saschaende/easydoctor/releases/latest) and unzip it to a directory **or** clone from git:

    git clone git@github.com:saschaende/easydoctor.gi

### Example

Just execute this in your shell terminal:

``` 
php easydoctor test
```

### Projects strucure

* project
    * CSS for documentation: css/style.css
    * Images for your documentation project: images/*
    * doc1.md
    * doc2.md
    * ...
    
### Important

* Every documentation page only has one # h1, this will be used for table of contents
* h2 will be used as subpages in the table of contents
* Define the ordering by naming the files for example with numbers