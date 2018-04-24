# ENSIIE Project Skeleton

## Install you application
* Change the parameters in .env file by your own values.
    * DOCKER_USER : result of the command echo $USER
    * DOCKER__USER_ID : result of the command $(echo id -u $USER)
* To install and start the application run `make install`
* Your web site is running here [http:localhost:8080](http:localhost:8080)

## Start you application
`make start`

This command starts the application without installing anything.

## Connect to the database
`make db.connect`

## Run unit tests
`make phpunit.run`

## Project structure

* .docker : for docker related files. Do not edit
* data : for test database entries.
* documents : for the files that will be uploaded on the server
* postgres-data : for files related to the postgres database. Do not edit.
* public : for client-side files.
    * js : for javascript functions.
    * css : for css files. Soon to be replaced by bootstrap
    * index.php : first php file to be run when a user visit the site.
* src : for php files. All the app logic is there.
    * app : for models and views. Users should not access there directly.
        * models : for classes that represent the underlying logic of the app
        * views : for display functions
        * class : for useful function regrouped into a class, such as Auth
    * helpers : for other functions such as math and string processing related ones.
    * db : for database related functions (connection, query, disconnect)
    * pages : pages of the web site. Users should access these.
* test : for unit tests. 

#How to create a page
 * create a new php file in src/pages .
 * require "../app/helpers.php" . 
    Do not use any other include or require. They should be all handled by the autoloader.
 * call writeHeader("Your title")
 * write the page logic (using the functions in sre/app/models)
 * create your view in src/app/views. Views should be mostly html with a bit of php for variables.
 * go back to your page and include the view using 
    include view("my_view.php");
 * call writeFoot()
 
 This way, all the "logic" part of the app is contained inside models, and all the "display"
 part is contained inside views. This should make maintenance, upgrades, and debbuging easier.   
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 







    
    
    