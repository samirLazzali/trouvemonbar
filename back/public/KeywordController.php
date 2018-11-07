<?php

use \Router\Router;

$pdo =\Database\DatabaseSingleton::getInstance();
$keywordRepository = new \Keyword\KeywordRepository($pdo);
$userRepository = new \User\UserRepository($pdo);
$keywordHydrator = new \Keyword\KeywordHydrator();

Router::get('/api/keywords', function() use($keywordRepository, $keywordHydrator) {
    $keywords = $keywordRepository->fetchAll();

    if (!$keywords) return http_response_code(500);

    echo json_encode($keywordHydrator->extractAll($keywords), JSON_UNESCAPED_UNICODE);
});

Router::post('/api/keywords', function($request) use($userRepository, $keywordRepository, $keywordHydrator) {
    if (!array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
        http_response_code(401);
        echo json_encode(['error' => 'You are not authorized without JWT']);
        return;
    }

    [, $token] = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);

    try {
        $userId = \Token\JwtHS256::validate($token, getenv('SECRET'));
        $user = $userRepository->fetchFullById($userId);
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => $e->getMessage()]);
        return;
    }

    if(!(!is_null($request->body->keywords) && is_array($request->body->keywords) && count($request->body->keywords) > 0)) return http_response_code(400);

    $keywords = $request->body->keywords;

    // Get all the keyword ids associated to the request
    $keyword_ids = array();
    foreach($keywords as $keyword)
    {
        $keyword_id = $keywordRepository->getIdByKeyword($keyword);
        if($keyword_id != -1)
        {
            $keyword_ids[] = $keyword_id;
        }
    }
    if(count($keyword_ids) < 1) return http_response_code(400);
    $user_id = $user->getId();
    // Insert thoses keyword_ids inside the keyword inside the table keyuser
    if(!$keywordRepository->addKeywordByUser($user_id,$keyword_ids))
        return http_response_code(200);
    else
        return http_response_code(500);

});
