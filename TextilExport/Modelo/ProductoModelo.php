<?php
require_once 'Modelo.php';
class ProductoModelo extends Modelo{

    public function get($id=''){
        if($id==''){
            $query="SELECT * from  Producto";
            return $this->getQuery($query);
        }
        else{
            $query="SELECT * FROM producto WHERE codigo_producto=:codigo_producto";
            return $this->getQuery($query,['codigo_producto'=>$id]);
        }
        
    }

    public function insertProducto($producto=array()){
        echo var_dump($producto);
        $query="INSERT INTO producto VALUES (:codigo_producto,:nombre_producto,:codigo_categoria,:precio_producto,:existencia_producto,:descripcion_producto,:img)";
         echo $this->setQuery($query,$producto);
        

    }

    public function updateProducto($producto=array()){
        $query="UPDATE producto SET nombre_producto=:nombre_producto, codigo_categoria=:codigo_categoria, precio_producto=:precio_producto,existencia_producto=:existencia_producto,descripcion_producto=:descripcion_producto  WHERE codigo_producto=:codigo_producto";
        return $this->setQuery($query,$producto);

    }

    public function removeProducto($id){
        $query="DELETE FROM Producto WHERE codigo_producto=:codigo_producto";
        return $this->setQuery($query,['codigo_producto'=>$id]);
    }

}