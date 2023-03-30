<?php
require_once 'Controlador.php';
require_once './Modelo/ProductoModelo.php';
class CarritoControlador extends Controlador{
    //aniadir productos al 
    function addProducto(){
        if(isset($_SESSION['carrito'])){
            $carrito_n=$_SESSION['carrito'];
            if(isset($_POST['nombre'])){
                $nombre=$_POST['nombre'];
                $precio=$_POST['precio'];
                $cantidad=$_POST['cantidad'];
                $carrito_n[]=array("nombre"=>$nombre,"precio"=>$precio,"cantidad"=>$cantidad);
            }
        }else{
            $nombre=$_POST['nombre'];
            $precio=$_POST['precio'];
            $cantidad=$_POST['cantidad'];
            $carrito_n[]=array("nombre"=>$nombre,"precio"=>$precio,"cantidad"=>$cantidad);
        }
        $_SESSION['carrito']=$carrito_n;
        header("Location: ".$_SERVER['HTTP_REFERER']."");
    }

    function rmvProducto($indice){
        $carrito_n=$_SESSION['carrito'];
        $indice=$indice<1?0:$indice;
        if(isset($_SESSION['carrito'])){
            echo $carrito_n[$indice];
            unset($carrito_n[$indice]);
        }
        foreach ($carrito_n as $prod){
            $nombre=$prod['nombre'];
            $precio=$prod['precio'];
            $cantidad=$prod['cantidad'];
            $nuevo_orden[]=array("nombre"=>$nombre,"precio"=>$precio,"cantidad"=>$cantidad);
        }
        $_SESSION['carrito']=$nuevo_orden;
        header("Location: ".$_SERVER['HTTP_REFERER']."");

    }

    function deleteCarrito(){
        unset($_SESSION['carrito']);
        //session_destroy($_SESSION['carrito']);
        header("Location: ".$_SERVER['HTTP_REFERER']."");
    }

}
