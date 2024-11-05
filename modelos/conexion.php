<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=54.235.42.17;dbname=pos", "root", "root");

		$link->exec("set names utf8");

		return $link;

	}

}
