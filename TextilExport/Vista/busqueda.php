<?php
/*parametro codigo*/
$cod=$_POST['cod'];
/*objeto para almacenar el producto encontrado*/
$prod_Encontrado="";
echo "LLEGO";
include_once './Controlador/ProductoControlador.php';
$modelo=new ProductoModelo();
$prod_Encontrado=$modelo->get($cod);

echo json_encode($prod_Encontrado);
?>