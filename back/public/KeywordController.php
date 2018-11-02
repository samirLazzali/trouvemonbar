<?php


use \Router\Router;

$pdo =\Database\DatabaseSingleton::getInstance();
$keywordRepository = new \Keyword\KeywordRepository($pdo);
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
    // http://localhost:3000/api/addbar?keywords=%22o%22
    // query execution - get data
    $keywords = urldecode($request->params[0]);
    $ch = curl_init();

    https://maps.googleapis.com/maps/api/place/findplacefromtext/json?
    $input=rawurlencode($keywords.' paris');
    $inputtype='textquery';
    $fields='photos,name,rating,geometry';
    $key = 'AIzaSyBL5wwReFZULzsHE0wJSifX_g43OMWR2jo';


    $url = 'https://maps.googleapis.com/maps/api/place/findplacefromtext/json?';
    $url .= 'input='.$input.'&';
    $url .= 'inputtype='.$inputtype.'&';
    $url .= 'fields='.$fields.'&';
    $url .= 'key='.$key;

    curl_setopt($ch, CURLOPT_URL, $url);
    // Set so curl_exec returns the result instead of outputting it.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Get the response and close the channel.
    $response = curl_exec($ch);
    $arrayResponse = json_decode($response,true);

    curl_close($ch);


    // récupération des bars
    $bars = [];
    foreach ($arrayResponse['candidates'] as $value) {
        $photoref = "NULL";
        if(array_key_exists('photos',$value)){
            $photoref = $value['photos'][0]['photo_reference'];
        }
        $tmp_bar = (new \Bar\Bar())
            ->setId(-1)
            ->setName($value["name"])
            ->setPhoto($photoref)
            ->setLat($value["geometry"]['location']['lat'])
            ->setLng($value["geometry"]['location']['lng']);

        array_push($bars,$tmp_bar);
    }

    if (!$bars) return http_response_code(500);
    // var_dump($bars);die();

    echo json_encode($barHydrator->extractAll($bars), JSON_UNESCAPED_UNICODE);

});
