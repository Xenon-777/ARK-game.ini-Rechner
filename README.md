# ARK game.ini Rechner

Berechnet eine game.ini aus den angegebenen Daten

Dabei ist zu beachten:

* Die Berechungskurve ist die Basis einer Exponentialfunktion die zur berechung der Werte benutzt wird. 1 ist demzufolge eine Gerade, heist, alle Werte sind gleich weit auseinader. Um so grösser die Basis um so kleiner werden die Abstände und Werte in unteren Level und um so höher in oberen Level.
* Da die Berechnung Mathematisch ist sind die Abstände völlig fliesend und nicht wie in orginal geradlinig über mehrere Levels und dann mit großen Sprüngen aufgeteilt.
* Die Dinosaurier Level sind die Gezähmten Level, heist, geben an um wieviel Levels man ein gezähmten Dinosaurier noch weiter leveln kann. z.B bei einen Wert von 100 kann man ein gezämtes Tier mit Level 30 auf 130 bringen oder mit Level 65 auf 165. 

Einbauen in das Spiel:

In das Spiele config Verzeichnis gehen:
* Local : .../Steam/SteamApps/common/ARK/ShooterGame/Saved/Config/WindowsNoEditor
* Server Windows : .../Steam/SteamApps/common/ARK/ShooterGame\Saved\Config\Windows\
* Server Linux : ...[\Steam\SteamApps\common\ARK\]ShooterGame\Saved\Config\Linux\

Verfahren:
* Die vorhandene leere game.ini umbenennen z.B. in game-old.ini
* Die berechnete Datei von der Seite (ARK_game.ini) dort kopieren
* Die Datei umbenennen zu game.ini
* Die ARK_game.ini gut aufheben fals ein Update die game.ini überschreibt

Hat man bereits eine game.ini mit anderen Inhalten die nichts mit den Level oder den Engram Punkten zu tun haben mus man diese editiren und den Inhalt von der ARK_game.ini einfügen. 
