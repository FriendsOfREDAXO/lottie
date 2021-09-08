
# REDAXO-AddOn: Lottie

Das AddOn stellt den Lottie-Player für das Abspielen von [Lottie-Animationen](https://lottiefiles.com/) im .json-Format zur Verfügung.

![Screenshot](https://raw.githubusercontent.com/FriendsOfREDAXO/lottie/assets/titel-animation.gif)

Das AddOn ermöglicht im REDAXO-Medienpool eine Vorschau von .json-Dateien als Lottie-Animation und liefert die nötigen Assets (.js-Files) sowie eine PHP-Methode zur einfachen Einbindung von Lottie-Playern im Frontend.

## AddOn Features
### Für das Frontend
- Statische PHP Methode zur Ausgabe der Animationen
- Player-Optionen können je Ausgabe definiert werden
- Eigenes Lottie-Player-HTML kann per Fragment eingebracht werden
- Notwendige Assests werden im Assets-Ordner des AddOns mitgeliefert (Einbindung im Frontend muss manuell erfolgen)

### Für das Backend
- Automatische Einbindung des Lottie-Players im Backend
- Lottie bindet sich in die Detailseite des Medienpools ein
- Konfigurationsmöglichkeit, ob alle .json-Dateien im Medienpool als Lottie-Animation behandelt werden sollen, oder nur in bestimmten Ordnern des Medienpools

## Lottie-Player

### Lottie-Files im Medienpool

Der Lottie-Player bindet sich automatisch in der Detailseite der Medienpools ein, wenn der Dateityp eine .json-Datei ist. Damit nicht jede .json-Datei im Medienpool als Lottie-Animation dargestellt wird, kann man in der AddOn-Konfiguration eine oder mehrere Medienpool-Kategorien definieren, in denen .json-Dateien als Lottie-Animationen dargestellt werden.

### Einbindung im Frontend

Die nötigen Dateien findet man im Assets-Ordner.
Eigene CSS und JS sollten nach Möglichkeit an anderer Stelle abgelegt werden, um Probleme nach einem Update zu vermeiden.

Lottie benötigt eine JS-Datei, die mitgeliefert wird (`lottie-player.js`).

Weitere Informationen und Resourcen zur Konfiguration von Lottie und z.B. Interaktivität bei Scroll oder Hover etc. gibt es auf [lottiefiles.com](https://lottiefiles.com).

#### JS für Lottie

```php
<script src="<?= rex_url::base('assets/addons/lottie/vendor/lottie/lottie-player.js') ?>"></script>
```

### Modul-Beispiel, hier mit MFORM

#### Eingabe

```php
$mform = new MForm();
$mform->addFieldset("Animation");
$mform->addMediaField(1, array('label'=>'.json-File'));
echo $mform->show();
```

#### Ausgabe über `rex_lottie::outputLottie($jsonFile, $options)`

```php
$lottie = rex_lottie::outputLottie('REX_MEDIA[1]','autoplay,loop');
```
> Beispiel mit den Parametern autoplay und loop.

#### Eigenes Lottie-Player-HTML-Fragment
Der HTML-Code für den Lottie-Player im Frontend kommt aus dem Fragment `lottie-player.php`. Wenn man eigenen HTML-Code in der Lottie-Player-Ausgabe haben möchte oder mehr anpassen will, ausser den Optionen, kann man dies mit einem eigenen Fragment tun.

## Methoden in der rex_lottie class

`rex_lottie::outputLottie($json,$options)`
Erstellt einen HTML-Lottie-Player anhand einer .json-Datei.

`checkMedia($filename)`
Überprüft, ob es sich bei der Mediendatei um eine .json-Datei handelt (bool).

## Resources für Lottie
Viele gratis-Lottie-Animationen sowie Hinweise zur Einbindung, Interaktivität (on-scroll, hover, etc), dem eigenen Erstellen von Lottie-Animationen gibt es auf [lottiefiles.com](https://lottiefiles.com)

## Bugtracker

Du hast einen Fehler gefunden oder ein nettes Feature parat? [Lege ein Issue an](https://github.com/FriendsOfREDAXO/lottie/issues). Bevor du ein neues Issue erstellst, suche bitte, ob bereits eines mit deinem Anliegen existiert.

## Lizenz

siehe [LICENSE.md](https://github.com/FriendsOfREDAXO/lottie/blob/master/LICENSE.md)

Lottie stammt ursprünglich von Airbnb und steht unter MIT-Lizenz siehe [LICENSE.md](https://github.com/airbnb/lottie/blob/master/LICENSE).


## Autor

**Friends Of REDAXO**

* http://www.redaxo.org
* https://github.com/FriendsOfREDAXO

**Projekt-Lead**
[Daniel Springer](https://github.com/danspringer)


## Credits

First Release: [Daniel Springer](https://github.com/danspringer)
