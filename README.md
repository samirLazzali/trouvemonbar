# Vitz 

## Groupe

- Thomas Kowalski
- Thibaut Milhaud
- Florian Barre
- Pierrick Barbarroux

## Comptes existants 

`Oxymore:motdepasse`

Ou (à la place de `Oxymore`) : 

- `Iko`
- `Drascma`
- `Yéti`

Vous pouvez aussi créer votre propre compte, mais vous ne serez pas modérateur.

**Remarque :** les noms de comptes (et les e-mails) ne sont pas sensibles à la casse.

## Installation

```
make install
```

## Initialisation (importation) d'une BDD existatne

```
make db.init
```

**Remarque :** c'est automatiquement appelé à l'installation.

En cas de problème avec l'importation, contactez-nous ou utilisez la récupération depuis Twitter automatique (partie suivante).

## Récupération de tweets depuis Twitter

Nous avons un script Python (utilisant `twarc`) qui permet de faire ça automatiquement :

```
cd tweet-extractor
python3 extract.py # à arrêter quand on le souhaite
python3 generationlikes.py # pour générer des likes / dislikes dans la BDD
```

## Exportation de la BDD 

```
make db.export
``` 