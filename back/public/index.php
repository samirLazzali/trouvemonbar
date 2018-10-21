<?php
header("Content-Type:application/json");

require '../vendor/autoload.php';
use \Router\Router;

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userHydrator = new \User\UserHydrator();
$userRepository = new \User\UserRepository($connection, $userHydrator);

// get all users
Router::get('/api/users', function() use($userRepository, $userHydrator) {
    $users = $userRepository->fetchAll();

    echo json_encode($userHydrator->extractAll($users));
});


$barHydrator = new \Bar\BarHydrator();
$barRepository = new \Bar\BarRepository($connection, $barHydrator);

// get all bars
Router::get('/api/bars', function() use($barRepository, $barHydrator) {
    $bars = $barRepository->fetchAll();
    echo json_encode($barHydrator->extractAll($bars));

});

// get a bar per id
Router::get('/api/bars/{}', function($request) use($barRepository, $barHydrator) {
 	print_r($request->params);
 //    if(isset($request->params[0]) and is_int($request->params[0]))
	// {
	// 	$id = $request->params[0];
 //    	$bars = $barRepository->fetchById($id);
 //    	echo json_encode($barHydrator->extract($bar));
	// }
	// else
	// {
	// 	echo json_encode($barHydrator->extract(array('error' => 'No such bar.')));
	// }
// });

// $bars = $barRepository->fetchById(1);
// echo json_encode($barHydrator->extract($bar));

Router::execute();


// simple route

// get the user 1
// Router::get('/api/users/1, function() {});

// create a new user with a request body
// Router::post('/api/users', function() {});

// update the user 1 with a request body
// Router::put('/api/users/1', function() {});

// delete all users
// Router::delete('/api/users', function() {});

// delete the user 1
// Router::delete('/api/users/1', function() {});

// for create and delete, if id 1 does not exist return 404

// nested route

// get all messages of the user 1
// Router::get('/api/users/1/messages, function() {})

// create a message of the user 1 with the request body
// Router::post('/api/users/1/messages, function() {})

// update the message 2 of the user 1 with the request body
// Router::put('/api/users/1/messages/2, function() {})

// delete the message 2 of the user 1
// Router::delete('/api/users/1/messages/2, function() {})
