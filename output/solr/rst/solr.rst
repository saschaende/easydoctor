-  `Installation <#page1>`__

   -  `Composer <#part1>`__
   -  `Einrichtung <#part2>`__

-  `Konfiguration <#page2>`__

   -  `Statisches Typoscript inkludieren <#part3>`__
   -  `Konstanten für die SOLR Connection einrichten <#part4>`__
   -  `Search Marker <#part5>`__
   -  `Indexierung aktivieren <#part6>`__
   -  `Root-Page definieren <#part7>`__
   -  `SOLR Connections intialisieren <#part8>`__
   -  `Verbindungen überprüfen <#part9>`__

-  `Indexierung <#page3>`__

   -  `Inhalte für Indexierung wählen <#part10>`__
   -  `Scheduler Tasks einrichten <#part11>`__

-  `Anzeige der Suche und Ergebnisse <#page4>`__

   -  `Seite anlegen <#part12>`__
   -  `Content Element einfügen <#part13>`__
   -  `Suchen <#part14>`__

-  `Anpassung <#page5>`__

   -  `Anpassung der Templates in Version 7 <#part15>`__

      .. rubric:: Installation

Composer
========

Wechsele in das TYPO3 Verzeichnis und installiere die Extension SOLR mit
folgendem Befehl:

.. raw:: html

   <pre><code>composer require typo3-ter<span style="color: #000000; font-weight: bold;">/</span>solr</code></pre>

Einrichtung
===========

-  Wechsele in den Bereich "Extensions"

   -  Gebe bei Suche "solr" ein
   -  Aktiviere die Extension

Konfiguration
=============

Statisches Typoscript inkludieren
---------------------------------

-  Wechsele in den Bereich "Template" und wähle den obersten Knoten der
   Webseite aus

   -  Wähle "Info/Modify" im Dropdown aus
   -  Wähle "Edit the whole template record"
   -  Wähle im Menü "Includes"
   -  Klicke rechts auf die Option "Search - Base Configuration (solr)"
      und füge sie hinzu
   -  Klicke auf "Save" um die Einstellungen zu speichern

|Bild 1|

Konstanten für die SOLR Connection einrichten
---------------------------------------------

Aktualisiere die Konstanten auf Deiner Root-Page mit folgendem
Typoscript:

.. raw:: html

   <pre><code><a href="http://documentation.typo3.org/documentation/tsref/tlo-objects/plugin/"><span style="color: #990000; font-weight: bold;">plugin</span></a> <span style="color: #009900;">&#123;</span>
   &nbsp; &nbsp; <span style="color: #000066; font-weight: bold;">tx_solr</span> <span style="color: #009900;">&#123;</span>
   &nbsp; &nbsp; &nbsp; &nbsp; solr <span style="color: #009900;">&#123;</span>
   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; host <span style="color: #339933; font-weight: bold;">=</span> localhost
   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; port <span style="color: #339933; font-weight: bold;">=</span> <span style="color: #cc0000;">8983</span>
   &nbsp; &nbsp; &nbsp; &nbsp; <span style="color: #009900;">&#125;</span>
   &nbsp; &nbsp; <span style="color: #009900;">&#125;</span>
   <span style="color: #009900;">&#125;</span></code></pre>

Denke daran, den Wert für host anzupassen, wenn SOLR auf einem externen
Server läuft.

Search Marker
-------------

EXR:solr indexiert alles zwischen

.. raw:: html

   <pre><code><span style="color: #808080; font-style: italic;">&lt;!-- TYPO3SEARCH_begin --&gt;</span> und <span style="color: #808080; font-style: italic;">&lt;!-- TYPO3SEARCH_end --&gt;</span></code></pre>

Sollten diese Marker nicht vorhanden sein, müssen diese hinzugefügt
werden. Vor allem um die Qualität zu erhöhen und nur die relevanten
Inhalte zu indexieren. Der einfachste Weg ist, dies mit Typoscript zu
tun:

.. raw:: html

   <pre><code><span style="color: #000066; font-weight: bold;">page</span><span style="color: #339933; font-weight: bold;">.</span>10 <span style="color: #009900;">&#123;</span>
   &nbsp; &nbsp; <a href="http://documentation.typo3.org/documentation/tsref/functions/stdWrap/"><span style="font-weight: bold;">stdWrap</span></a><span style="color: #339933; font-weight: bold;">.</span>dataWrap <span style="color: #339933; font-weight: bold;">=</span> <span style="color: #339933; font-weight: bold;">&lt;!</span>--TYPO3SEARCH_begin--<span style="color: #339933; font-weight: bold;">&gt;|&lt;!</span>--TYPO3SEARCH_end--<span style="color: #339933; font-weight: bold;">&gt;</span>
   <span style="color: #009900;">&#125;</span></code></pre>

Indexierung aktivieren
----------------------

Das Indexing wird mit folgendem Tyoscript aktiviert:

.. raw:: html

   <pre><code><span style="color: #000066; font-weight: bold;">config</span> <span style="color: #009900;">&#123;</span>
   &nbsp; &nbsp; index_enable <span style="color: #339933; font-weight: bold;">=</span> <span style="color: #cc0000;">1</span>
   <span style="color: #009900;">&#125;</span></code></pre>

Root-Page definieren
--------------------

Wichtig ist auch, dass die Root-Page als solche aktiviert ist.

|Bild 2|

-  Aktviere die Checkbox bei **Use as Root Page**

SOLR Connections intialisieren
------------------------------

Als nächstes müssen die SOLR Connections aktiviert werden. Zum
Initialisieren wähle aus dem Menü "Initialize Solr connections":

|Bild 3|

Verbindungen überprüfen
-----------------------

-  Gehe zu "Reports"
-  Schaue Dir an ob bei "solr" Fehlermeldungen aufgetreten sind und ob
   die Verbindung geklappt hat

Indexierung
===========

Inhalte für Indexierung wählen
------------------------------

Wenn alles eingerichtet ist, wechsele auf der linken Seite zum Menüpunkt
"Search". Klicke im Modul auf "Index Queue", wähle die Inhalte aus und
klicke auf "Queue selected content for indexing".

|Bild 4|

Scheduler Tasks einrichten
--------------------------

Damit die Indexierung tatsächlich durchgeführt wird, muss ein Scheduler
Task eingerichtet werden, der auch manuell ausgeführt werden kann.

-  Wähle "Scheduler"
-  Füge einen neuen Task hinzu
-  Wähle aus der Oberkategorie solr den task "Index Queue Worker" aus
-  Klicke auf Speichern, damit wird der Task angelegt
-  Klicke in der Übersicht der Scheduler beim entsprechenden Task auf
   das play Symbol und "Run task"

|Bild 5|

Anzeige der Suche und Ergebnisse
================================

Seite anlegen
-------------

Lege unterhalb des Page Roots eine Seite "Suche" an.

|Bild 6|

Content Element einfügen
------------------------

Füge das Plugin "Search" auf der Seite ein.

|Bild 7|

Suchen
------

Öffne die Seite "Suche" auf der Webseite und gebe "\*" ein. Du solltest
nun die ersten Inhalte sehen.

|Bild 8|

Anpassung
=========

Anpassung der Templates in Version 7
------------------------------------

Der Pfad zu den Templates kann über folgendes Typoscript angepasst
werden. Der entsprechende Vermerk dazu findet sich auch in
**Configuration/TypoScript/Solr/setup.txt**

.. raw:: html

   <pre><code><a href="http://documentation.typo3.org/documentation/tsref/tlo-objects/plugin/"><span style="color: #990000; font-weight: bold;">plugin</span></a><span style="color: #339933; font-weight: bold;">.</span>tx_solr <span style="color: #009900;">&#123;</span>
   &nbsp; &nbsp; &nbsp; &nbsp; <span style="color: #aaa; font-style: italic;">// By convention the templates get loaded from EXT:solr/Resources/Private/Templates/Frontend/Search/(ActionName).html</span>
   &nbsp; &nbsp; &nbsp; &nbsp; <span style="color: #aaa; font-style: italic;">// If you want to define a different entry template, you can do this here to overwrite the convensional default template</span>
   &nbsp; &nbsp; &nbsp; &nbsp; templateFiles <span style="color: #009900;">&#123;</span>
   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; frequentSearched <span style="color: #339933; font-weight: bold;">=</span> EXT<span style="color: #339933; font-weight: bold;">:</span>solr<span style="color: #339933; font-weight: bold;">/</span>Resources<span style="color: #339933; font-weight: bold;">/</span>Private<span style="color: #339933; font-weight: bold;">/</span>Templates<span style="color: #339933; font-weight: bold;">/</span>Search<span style="color: #339933; font-weight: bold;">/</span>FrequentlySearched<span style="color: #339933; font-weight: bold;">.</span>html
   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; results <span style="color: #339933; font-weight: bold;">=</span> EXT<span style="color: #339933; font-weight: bold;">:</span>solr<span style="color: #339933; font-weight: bold;">/</span>Resources<span style="color: #339933; font-weight: bold;">/</span>Private<span style="color: #339933; font-weight: bold;">/</span>Templates<span style="color: #339933; font-weight: bold;">/</span>Search<span style="color: #339933; font-weight: bold;">/</span>Results<span style="color: #339933; font-weight: bold;">.</span>html
   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; form <span style="color: #339933; font-weight: bold;">=</span> EXT<span style="color: #339933; font-weight: bold;">:</span>solr<span style="color: #339933; font-weight: bold;">/</span>Resources<span style="color: #339933; font-weight: bold;">/</span>Private<span style="color: #339933; font-weight: bold;">/</span>Templates<span style="color: #339933; font-weight: bold;">/</span>Search<span style="color: #339933; font-weight: bold;">/</span>Form<span style="color: #339933; font-weight: bold;">.</span>html
   &nbsp; &nbsp; &nbsp; &nbsp; <span style="color: #009900;">&#125;</span>
   <span style="color: #009900;">&#125;</span></code></pre>

.. |Bild 1| image:: images/static_typoscript.png
.. |Bild 2| image:: images/root_page.png
.. |Bild 3| image:: images/solr_connection.png
.. |Bild 4| image:: images/queue.png
.. |Bild 5| image:: images/scheduler.png
.. |Bild 6| image:: images/searchpage.png
.. |Bild 7| image:: images/add_plugin.png
.. |Bild 8| image:: images/searchresults.png
