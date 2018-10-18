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
$users = $userRepository->fetchAll();

$data = [];
foreach ($users as $user) {
    $data[] = $userHydrator->extract($user);
}

Router::get('/api/users', function() use($data) {
    echo json_encode($data);
});

Router::execute();
