<?php
include_once 'ProductosModelo.php';

 $model = new ProductoModelo();
 echo var_dump($model->get());
