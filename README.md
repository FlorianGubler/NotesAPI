# m151-phpapi
Eine PHP REST API mit MariaDB Datenbankanbindung für eine Benutzerverwaltung und die Funkitonalitäten für Verwaltung von Usern und deren Notizen. Für den User, als auch für die Notizen gibt es die Möglichkeit zur Erstellung, Lesen, Auflistung und Lösung. In dieser Lösung wurde kein Sessionhandling oder Authorisierung umgesetzt, also sind alle Endpunkte für jeden verfügbar. Folgende Endpunkte werden angeboten:

| Endpunkt           | Beschreibung                 | Methode |
| ------------------ | ---------------------------- | ------- |
| user/list          | Lists all Users              | GET     |
| user/{userid}      | Get specific User            | GET     |
| user/{userid}      | Delete a specific User       | DELETE  |
| user/              | Create a new User            | POST    |
| user/note          | Create new Note for User     | POST    |
| user/note/list     | Lists all Notes for a User   | GET     |
| user/note/{noteid} | Gets a specific User Note    | GET     |
| user/note          | Deletes a specific User Note | DELETE  |

***
## Installation
Diese API ist eine Standalone Applikation. Es müssen also keine zusätzlichen Dependencys installiert werden. Für das lokale Hosting kann ein Apache V-Host erstellt werden. Hierfür müssen 2 Config Files angepasst werden:

**1. V-Hosts Conifg: ...\apache\conf\extra\httpd-vhosts.confg**
```xml
<VirtualHost *:80>
    ServerAdmin gubler.florian@gmx.net
    DocumentRoot "C:\Users\User\OneDrive\TBZ\M151\m151-phpapi"
    ServerName phpapi
    <Directory C:\Users\User\OneDrive\TBZ\M151\m151-phpapi>
     	Order allow, deny
		Allow from all
		Require all granted
    </Directory>
</VirtualHost>
```

**2. Hosts File: C:\Windows\System32\drivers\etc\hosts**
```xml
	127.0.0.1		phpapi
```

## Architektur
Hier wurde eine MVC Architektur umgesetzt. Da es sich aber um eine REST API Schnittstelle handelt, werden keine Views benötigt. Es ist also eine Model-Controller Architektur.

![MVC-Architektur](https://upload.wikimedia.org/wikipedia/commons/2/2e/ModelViewControllerDiagram.svg "MVC-Architketur")
<font size="2">*Quelle: [Wikipedia - MVC](https://upload.wikimedia.org/wikipedia/commons/2/2e/ModelViewControllerDiagram.svg)*</font>

Der View Teil ist in dieser API mit JSON implementiert. Die Responses, wie auch die Requests werden in JSON oder auch Path Parameter übergeben.

## Reflexion
//TODO


