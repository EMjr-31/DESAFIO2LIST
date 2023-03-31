<?php
require_once 'Modelo.php';
class CategoriaModelo extends Modelo{

    public function getCategoria($id=''){
        if($id==''){
            $query="SELECT * from categorias";
            return $this->getQuery($query);
        }
        else{
            $query="SELECT * FROM categorias WHERE codigo_categoria=:codigo_categoria";
            return $this->getQuery($query,['codigo_categoria'=>$id]);
        }
        
    }

    public function insertCategoria($producto=array()){
        echo var_dump($producto);
        $query="INSERT INTO categorias VALUES (:codigo_categoria,:nombre_categoria)";
         return $this->setQuery($query,$producto);
        

    }

    public function updateEditorial($producto=array()){
        $query="UPDATE categorias SET nombre_categoria=:nombre_categoria";
        return $this->setQuery($query,$producto);

    }

    public function removeCategoria($id){
        $query="DELETE FROM categorias WHERE codigo_categoria=:codigo_categoria";
        return $this->setQuery($query,['codigo_categoria'=>$id]);
    }

}