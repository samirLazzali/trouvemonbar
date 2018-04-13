# Projet Web

## A toujours faire avant de faire quoi que ce soit :

Récupérez les dernières modifications des autres, histoire d'éviter de devoir faire des fusions après.

```
git pull
``` 

## Lancer le projet en local

* Ouvrez un terminal, exécutez `make start`.
* Rendez-vous ici [http://localhost:8080](http://localhost:8080), le site fonctionne !

## Connexion à la base de données

Si vous avez besoin d'accéder à la BDD du site, utilisez

`make db.connect`

## Tests unitaires

Je sais pas encore comment ça marche, mais ce sera exécuté comme ça :

`make phpunit.run`

## Quelques petits trucs :

* Annuler un commit : `git reset`
* Annuler tous les changements depuis le dernier commit : `git checkout .`
* Installer Docker : il faut être chanceux (et courageux)