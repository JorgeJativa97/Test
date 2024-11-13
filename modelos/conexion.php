<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=54.167.8.100;dbname=pos", "root", "root");

		$link->exec("set names utf8");

		return $link;

	}

}
