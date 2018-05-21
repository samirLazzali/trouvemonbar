<?php

class Tags {
    public static function getId($tag) {
	$connection = dbConnect();
	
	$rows = dbQuery($connection, "SELECT id FROM tags WHERE name = " . $connection->quote($tag) . ";");

	if (sizeof($rows) == 0) {
	    dbExec($connection, "INSERT INTO tags (name) VALUES (" . $connection->quote($tag) . ");");
	    return Tags::getId($tag);
	}

	return ($rows[0]->id);
    }

    public static function resetTags($annonceId) {
	$connection = dbConnect();
	
	dbExec($connection, "DELETE FROM links WHERE aid = $annonceId;");
    }

    public static function tagsToString($tagArray) {
	$str = "";
	foreach ($tagArray as $tag)
	    $str = $str . $tag . " ";

	if (sizeof($str > 0))
	    $str = substr($str, 0, -1);

	return $str;
    }

    public static function stringToTags($str) {
	$li = explode(" ", $str);
	$tagArray = array();

	foreach ($li as $tag)
	    if ($tag != "")
		$tagArray[] = $tag;

	return $tagArray;
    }


}
