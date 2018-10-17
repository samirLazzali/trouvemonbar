<?php
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

$userHydrator = new \User\UserHydrator();
$data = [];
foreach ($users as $user) {
    $data[] = $userHydrator->extract($user);
}
echo json_encode($data);
?>
