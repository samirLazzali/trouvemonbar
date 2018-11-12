<?php

use \Router\Router;


$pdo =\Database\DatabaseSingleton::getInstance();
$CommentRepository = new \Comment\CommentRepository($pdo);
$userRepository = new \User\UserRepository($pdo);
$commentHydrator = new \Comment\CommentHydrator();

Router::get('/api/bars/{}/users/{}/comments', function($request) use($userRepository, $commentRepository, $commentHydrator) {

    if(!(isset($request->params[0]) && isset($request->params[1]))) return http_response_code(400);
    $str_bar_id = $request->params[0];
    $bar_id = ctype_digit($str_bar_id) ? intval($str_bar_id) : null;
    if ($bar_id == null)
    {
        return http_response_code(400);
    }
    $str_user_id = $request->params[1];
    $user_id = ctype_digit($str_user_id) ? intval($str_user_id) : null;
    if ($user_id == null)
    {
        return http_response_code(400);
    }
    $comment=$commentRepository->getByIdBarIdUser($bar_id, $user_id);
    if ($comment == null) {
        http_response_code(404);
        echo json_encode(array('error' => 'No such comment with those ids.'));
        return;
    }
    echo json_encode($commentHydrator->extract($comment), JSON_UNESCAPED_UNICODE);
});
