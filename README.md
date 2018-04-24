# Projet WEB Groupe du BG (Gub)

## Installation
* Installer docker à coup de sudo-apt install docker.io ou un truc du genre
* Changer les paramètres dans le fichier .env (vim .env dans le repo) : Changer l'adresse IP (demander au prof), le DOCKER\_USER et le DOCKER\_USER\_ID (pour recup celui la taper `$(echo id -u $USER)` dans le terminal ou demander au prof
* Lancer `make install` dans le repo pour installer docker sur le site
* Le site sera up sur [http:localhost:8080](http:localhost:8080) et modifié en temps réel avec vos modifs
* Ne pas oublier de add, commit et push après modifications (et de pull avant)

## Start you application
`make start`

This command starts the application without installing anything.

## Connect to the database
`make db.connect`

## Run unit tests
`make phpunit.run`
