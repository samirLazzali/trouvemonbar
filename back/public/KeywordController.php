<?php


use \Router\Router;

$pdo =\Database\DatabaseSingleton::getInstance();
$keywordRepository = new \Keyword\KeywordRepository($pdo);
$userRepository = new \User\UserRepository($pdo);
$keywordHydrator = new \Keyword\KeywordHydrator();
$barHydrator = new \Bar\BarHydrator();


Router::get('/api/keywords', function() use($keywordRepository, $keywordHydrator) {
    // http://localhost:3000/api/addbar?keywords=%22o%22
    $keywords = $keywordRepository->fetchAll();
    if (!$keywords) return http_response_code(500);
    echo json_encode($keywordHydrator->extractAll($keywords), JSON_UNESCAPED_UNICODE);
});