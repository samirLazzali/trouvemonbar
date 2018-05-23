<?php

function create_file_value($id,$type,$name,$date) {
	return array(
				'id'=> $id,
				'type' => $type,
				'name' => $name,
				'date' => $date
				);
}

function get_id_file($file) {
	return $file['id'];
}

function get_type_file($file) {
	return $file['type'];
}

function get_name_file($file) {
	return $file['name'];
}

function get_date_file($file) {
	return $file['date'];
}