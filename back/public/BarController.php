<?php

use \Router\Router;

$pdo = \Database\DatabaseSingleton::getInstance();
$commentValidator = new \Comment\CommentValidator();
$commentRepository = new \Comment\CommentRepository($pdo);
$barHydrator = new \Bar\BarHydrator();
$barRepository = new \Bar\BarRepository($pdo);

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

Router::post('/api/bars/{}', function($request) use($barRepository, $commentValidator, $commentRepository) {

    if (!$commentValidator->validate($request->body)) {
        return http_response_code(400);
    }

    $comment = (new \Comment\Comment())
        ->setIdBar($request->body->idBar)
        ->setIdUser($request->body->idUser)
        ->setContent($request->body->content)
        ->setDate($request->body->dateCom);

    if(!$commentRepository->isSoloCom($comment)) {
        http_response_code(418);
        echo json_encode(['error' => 'Vous avez déjà posté un avis sur ce bar']);
        return;
    }

    if(!$commentRepository->createComment($comment)) {
        return http_response_code(500);
    } else {
        return http_response_code(201);
    }
});
