<?php
session_start();
include_once 'Controlador/ProductoControlador.php';
include_once 'Controlador/CarritoControlador.php';
include_once 'Controlador/CategoriaControlador.php';
include_once 'Controlador/UsuarioControlador.php';
include_once 'Core/config.php';
$url=$_SERVER['REQUEST_URI'];
$url=explode("/",$url);
$controller=empty($url[5])?"Index":$url[5];
$controller.="Controlador";
$fileController="Controlador/$controller.php";
$method=empty($url[6])?"index":$url[6];
$param=empty($url[7])?"":$url[7];
if(!is_file($fileController)){
    echo "<h1>Error 404</h1>";
    exit;
}
$controlador=new $controller();
if(!method_exists($controlador,$method)){
    echo "<h1>Error 404</h1>";
    exit;
}
$controlador->$method($param);
