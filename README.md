# Projet WEB Groupe du BG (Gub)

## Installation
* Installer docker à coup de sudo apt-get install docker.io et docker-compose ou un truc du genre
* Changer les paramètres dans le fichier .env (vim .env dans le repo) : Changer l'adresse IP REMOTE\_HOST (demander au prof), le DOCKER\_USER et le DOCKER\_USER\_ID (pour recup celui la taper `$(echo id -u $USER)` dans le terminal ou demander au prof
* Lancer `make install` dans le repo pour installer docker sur le site
* Le site sera up sur [http:localhost:8080](http:localhost:8080) et modifié en temps réel avec vos modifs
* Ne pas oublier de add, commit et push après modifications (et de pull avant)

## Lancer l'application
`make start`

Apparement ca lance l'application jsp à quoi ca sert

## Se connecter à la BDD
`make db.connect` (bsahtek)

## Modifier la BDD

Quand vous modifiez la BDD dans data/db.sql, retournez dans la racine du repo et tapez `make db.install` pour mettre à jour la BDD

## Lancer les tests unitaires
`make phpunit.run`
