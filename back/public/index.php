<?php
header("Content-Type:application/json");

require_once '../vendor/autoload.php';
require_once __DIR__ . '/keyword.php';
require_once __DIR__ . '/login.php';

use \Router\Router;

$pdo = \Database\DatabaseSingleton::getInstance();
$barHydrator = new \Bar\BarHydrator();
$barRepository = new \Bar\BarRepository($pdo, $barHydrator);

Router::get('/api/bars\?keywords\=(.+)', function($request) use($barRepository, $barHydrator)
{
    $keywords = explode(',', rawurldecode($request->params[0]));
    $bars = $barRepository->fetchByKeyWords($keywords);

    if($bars == NULL) {
        http_response_code(404);
        echo json_encode(array('error' => 'No such bar with those keywords'));
        return;
    }

    echo json_encode($barHydrator->extractAll($bars), JSON_UNESCAPED_UNICODE);
});

Router::get('/api/bars/{}', function($request) use($barRepository, $barHydrator)
{
    $id = intval($request->params[0]);

    if (strval($id) !== $request->params[0]) {
    	http_response_code(400);
        echo json_encode(array('error' => 'Parameters are not correct.'));
        return;
    }

    $bar = $barRepository->fetchById($id);
    if ($bar == null) {
        http_response_code(404);
        echo json_encode(array('error' => 'No such bar with this id.'));
        return;
    }

    echo json_encode($barHydrator->extract($bar), JSON_UNESCAPED_UNICODE);
});

Router::execute();
