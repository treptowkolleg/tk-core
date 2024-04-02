# Entwicklungsumgebung für JAVA

## Chocolatey

*Überspringe diesen Schritt, falls du bereits Chocolatey installiert hast.*

Für die Installation erforderlicher Software für die PHP-Entwicklung, aber auch für andere
Programmiersprachen, benötigen wir einen Softwarepaketmanager. Ein einfacher Paketmanager
**Chocolatey**.

Öffne die Windows Powershell mit Administratorrechten und gib folgenden Befehl ein:

````shell
Get-ExecutionPolicy
````

Sollte ''Restricted'' zurückgegeben werden, führe
````shell
Set-ExecutionPolicy AllSigned
````
oder
````shell
Set-ExecutionPolicy Bypass -Scope Process
````
aus.

Installiere abschließend **Chocolatey** mit:

````shell
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))
````

Wenn alles geklappt hat, kannst du mit dem Befehl ``choco -?`` überprüfen, ob **Chocolatey** nun verfügbar ist.

Sollte beim späteren Ausführen eine Fehlermeldung ausgegeben werden
wie ``xxx.ps1 cannot be loaded because the execution of scripts is disabled on this system``
sollten die Sicherheitsrichtlinien für externe Quellen angepasst werden:

````shell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope LocalMachine
````

Danach sollte das Ausführen funktionieren.

### Empfohlene Software für die PHP-Entwicklung

- Git
- JAVA JDK
- JAVA IDE

## Git

*Überspringe diesen Schritt, falls du bereits Git installiert hast.*

Git ist perfekt für die Versionierung von Softwareprojekten. Git hilft dir außerdem dabei, von
überall aus auf deine Dateien zugreifen zu können.

*Da Git ziemlich kompliziert ist, wird es dazu eine eigene Sektion geben.*

````shell
choco install git
````

## JAVA JDK

Symfony ist eigentlich für das gleichnamige PHP-Framework gedacht. Dennoch ist
es für unsere Zwecke perfekt geeignet, da die Verwaltung des Testservers so
deutlich einfacher erledigt werden kann.

````shell
choco install symfony-cli
````

Über ein Terminal im Projektordner kann dann der PHP-Testserver einfach gestartet
oder beendet werden:

````shell
symfony server:start
````

````shell
symfony server:stop
````

## JAVA IDE

Für die eigentliche Entwicklungsarbeit sollten wir auf eine IDE zurückgreifen.

Ein klarer Sieger ist die **Jetbrains IntelliJ (CE)**. Sie bietet alles, was das
JAVA-Herz begehrt. Mit dabei sogar eine Git- und Package-Manager-Integration.

````shell
choco install intellijidea-community
````