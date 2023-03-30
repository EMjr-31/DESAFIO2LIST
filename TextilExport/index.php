<?php
session_start();
include_once 'Controlador/ProductoControlador.php';
include_once 'Controlador/CarritoControlador.php';
include_once 'Core/config.php';
$url=$_SERVER['REQUEST_URI'];
$url=explode("/",$url);
$controller=empty($url[5])?"Index":$url[5];
$controller.="Controlador";
$method=empty($url[6])?"index":$url[6];
$param=empty($url[7])?"":$url[7];
$controlador=new $controller();
$controlador->$method($param);
