<?php

use \Router\Router;

$connection = \Database\DatabaseSingleton::getInstance();

$keywordRepository = new \Keyword\KeywordRepository($connection);
$keywordHydrator = new \Keyword\KeywordHydrator();

Router::get('/api/keywords', function() use($keywordRepository, $keywordHydrator) {
    $keywords = $keywordRepository->fetchAll();

    if (!$keywords) return http_response_code(500);

    echo json_encode($keywordHydrator->extractAll($keywords), JSON_UNESCAPED_UNICODE);
});
