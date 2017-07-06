# Installation

## Composer

Wechsele in das TYPO3 Verzeichnis und installiere die Extension SOLR mit folgendem Befehl:
<div lang="bash">
composer require typo3-ter/solr
</div>

## Einrichtung

* Wechsele in den Bereich "Extensions"
    * Gebe bei Suche "solr" ein
    * Aktiviere die Extension  

# Konfiguration

## Statisches Typoscript inkludieren

* Wechsele in den Bereich "Template" und wähle den obersten Knoten der Webseite aus
    * Wähle "Info/Modify" im Dropdown aus
    * Wähle "Edit the whole template record"
    * Wähle im Menü "Includes"
    * Klicke rechts auf die Option "Search - Base Configuration (solr)" und füge sie hinzu
    * Klicke auf "Save" um die Einstellungen zu speichern
    
![Bild 1](images/static_typoscript.png) 

## Konstanten für die SOLR Connection einrichten

Aktualisiere die Konstanten auf Deiner Root-Page mit folgendem Typoscript:

<div lang="typoscript">
plugin {
    tx_solr {
        solr {
            host = localhost
            port = 8983
        }
    }
}
</div>

Denke daran, den Wert für host anzupassen, wenn SOLR auf einem externen Server läuft.

## Search Marker

EXR:solr indexiert alles zwischen 

<div lang="html5">
<!-- TYPO3SEARCH_begin --> und <!-- TYPO3SEARCH_end -->
</div>

Sollten diese Marker nicht vorhanden sein, müssen diese hinzugefügt werden. Vor allem um die Qualität zu erhöhen und nur die relevanten Inhalte zu indexieren.
Der einfachste Weg ist, dies mit Typoscript zu tun:

<div lang="typoscript">
page.10 {
    stdWrap.dataWrap = <!--TYPO3SEARCH_begin-->|<!--TYPO3SEARCH_end-->
}
</div>

## Indexierung aktivieren

Das Indexing wird mit folgendem Tyoscript aktiviert:

<div lang="typoscript">
config {
    index_enable = 1
}
</div>

## Root-Page definieren

Wichtig ist auch, dass die Root-Page als solche aktiviert ist.

![Bild 2](images/root_page.png) 

* Aktviere die Checkbox bei **Use as Root Page**

## SOLR Connections intialisieren

Als nächstes müssen die SOLR Connections aktiviert werden. Zum Initialisieren wähle aus dem Menü "Initialize Solr connections":

![Bild 3](images/solr_connection.png)

## Verbindungen überprüfen

* Gehe zu "Reports"
* Schaue Dir an ob bei "solr" Fehlermeldungen aufgetreten sind und ob die Verbindung geklappt hat

# Indexierung

## Inhalte für Indexierung wählen

Wenn alles eingerichtet ist, wechsele auf der linken Seite zum Menüpunkt "Search". Klicke im Modul auf "Index Queue", wähle die Inhalte aus und klicke auf "Queue selected content for indexing".

![Bild 4](images/queue.png)

## Scheduler Tasks einrichten

Damit die Indexierung tatsächlich durchgeführt wird, muss ein Scheduler Task eingerichtet werden, der auch manuell ausgeführt werden kann.

* Wähle "Scheduler"
* Füge einen neuen Task hinzu
* Wähle aus der Oberkategorie solr den task "Index Queue Worker" aus
* Klicke auf Speichern, damit wird der Task angelegt
* Klicke in der Übersicht der Scheduler beim entsprechenden Task auf das play Symbol und "Run task"

![Bild 5](images/scheduler.png)

# Anzeige der Suche und Ergebnisse

## Seite anlegen

Lege unterhalb des Page Roots eine Seite "Suche" an.

![Bild 6](images/searchpage.png)

## Content Element einfügen

Füge das Plugin "Search" auf der Seite ein.

![Bild 7](images/add_plugin.png)

## Suchen

Öffne die Seite "Suche" auf der Webseite und gebe "*" ein. Du solltest nun die ersten Inhalte sehen.

![Bild 8](images/searchresults.png)