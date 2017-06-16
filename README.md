# Easydoctor

Fast and easy documentation generator for markdown files

[Website](http://easydoctor.sascha-ende.de) | [Demo](http://easydoctor.sascha-ende.de/demo)

### Features

* You can use markdown
* Super Fast
* [GitHub flavored](https://help.github.com/articles/github-flavored-markdown)
* [Markdown Extra support](https://github.com/erusev/parsedown-extra)
* Generated pdf document from markdown

### Planned

* Generate website from markdown
* Code syntax highlighting for php code

### Installation

Download [latest release](https://github.com/saschaende/easydoctor/releases/latest) and unzip it to a directory **or** install [the composer package](https://packagist.org/packages/saschaende/easydoctor).

    composer require saschaende/easydoctor

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