<?php

require_once 'Controlador.php';
require_once './Modelo/CategoriaModelo.php';
class CategoriaControlador extends Controlador{

    private $model;

    function __construct(){

        $this->model=new CategoriaModelo();
    }

    public function index(){
        $viewBag=array();
        $categorias=$this->model->getCategoria();
        $viewBag['categorias']=$categorias;
        $this->render("index.php",$viewBag);
    }

    public function create(){
        $this->render("new.php");
    }

    public function add(){
        if(isset($_POST['btn'])){
            extract($_POST);
            $errores=array();
            $categoria=array();
            $viewBag=array();
            $categoria['codigo_categoria']=$codigo_categoria;
            $categoria['nombre_categoria']=$nombre_categoria;
                if($this->model->insertCategoria($categoria)>0){
                    echo "Editorial creado exitosamente";
                    header('location:'.PATH.'/Categoria');
                }
                else{
                    echo "YA existe un editorial con este codigo";
                   // $viewBag['errores']=$errores;
                    $viewBag['categoria']=$categoria;
                    //$this->render("new.php",$viewBag);

                }
            }


            
    }

    public function edit($id){
        $viewBag=array();
        $editorial=$this->model->getCategoria($id);
        $viewBag['editorial']=$editorial[0];
        $this->render("edit.php",$viewBag);
    }

    public function update(){
        if(isset($_POST['btn'])){
            extract($_POST);
            $errores=array();
            $categoria=array();
            $viewBag=array();
            $categoria['codigo_categoria']=$codigo_categoria;
            $categoria['nombre_categoria']=$nombre_categoria;
            $this->model->updateCategoria($categoria);
            header('location:'.PATH.'/Categoria');
            
        }
    }

    public function delete($id){
        $this->model->removeCategoria($id);
        header('location:'.PATH.'/Categoria');
    }


    public function buscar($cod){

        /*objeto para almacenar el producto encontrado*/
        $prod_Encontrado="";
        $prod_Encontrado=$this->model->getCategoria($cod);

        echo json_encode($prod_Encontrado);

    }

}