<?php


use \Router\Router;

$pdo =\Database\DatabaseSingleton::getInstance();
$keywordRepository = new \Keyword\KeywordRepository($pdo);
$userRepository = new \User\UserRepository($pdo);
$keywordHydrator = new \Keyword\KeywordHydrator();
// $bar = new \Bar\Bar();
$barHydrator = new \Bar\BarHydrator();


Router::get('/api/keywords', function() use($keywordRepository, $keywordHydrator) {
    // http://localhost:3000/api/addbar?keywords=%22o%22
    $keywords = $keywordRepository->fetchAll();

    if (!$keywords) return http_response_code(500);

    echo json_encode($keywordHydrator->extractAll($keywords), JSON_UNESCAPED_UNICODE);
});

Router::get('/api/addbar\?keywords\=(.+)', function($request) use($barHydrator) {
    $keywords = explode(',', rawurldecode($request->params[0]));
    var_dump($keywords);
    // query execution - get data
    $ch = curl_init();
    // $url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=48.853333,2.369167&radius=500&type=night_club&key=AIzaSyBL5wwReFZULzsHE0wJSifX_g43OMWR2jo';

    $url = 'https://www.facebook.com';

    curl_setopt($ch, CURLOPT_URL, $url);
    // Set so curl_exec returns the result instead of outputting it.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Get the response and close the channel.
    $response = curl_exec($ch);

    $arrayResponse = json_decode($response,true);

    curl_close($ch);

    // récupération des bars
    $bars = [];
    foreach ($arrayResponse['results'] as $value) {
        $photoref = "NULL";
        if(array_key_exists('photo',$value)){
            $photoref = $value['photos'][0]['photo_reference'];
        }
        $rating = -1;
        if(array_key_exists('rating',$value)){
            $rating = $value["rating"];
        }
        $tmp_bar = (new \Bar\Bar())
            ->setId(-1)
            ->setName($value["name"])
            ->setAddress($value["vicinity"])
            ->setPhoto($photoref)
            ->setRating($rating)
            ->setLat($value["geometry"]['location']['lat'])
            ->setLng($value["geometry"]['location']['lng']);

        array_push($bars,$tmp_bar);

    }


    if (!$bars) return http_response_code(500);


    echo json_encode($barHydrator->extractAll($bars), JSON_UNESCAPED_UNICODE);

});
