<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=34.224.216.117;dbname=pos", "root", "root");

		$link->exec("set names utf8");

		return $link;

	}

}
