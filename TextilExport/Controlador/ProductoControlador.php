<?php
require_once 'Controlador.php';
require_once './Modelo/ProductoModelo.php';
require_once './Modelo/CategoriaModelo.php';
class ProductoControlador extends Controlador{

    private $model;

    function __construct(){
        $this->model=new ProductoModelo();
    }

    public function Index(){
        $viewBag=array();
        $productos=$this->model->get();
        $viewBag['productos']=$productos;
        $cat=new CategoriaModelo();
        $viewBag['categorias']=$cat->getCategoria();
        $this->render("index.php",$viewBag);
    }

    public function details($id){
        $viewBag=array();
        $productos=$this->model->get($id);
        $viewBag['productos']=$productos[0];
        $this->render("details.php",$viewBag);
    }


    public function add(){
        if(isset($_POST['btn'])){
            if(1==1){
                if(isset($_FILES['file'])){
                    $archivo=$_FILES['file'];
                    $archivo_nombre=$archivo['name'];
                    $archivo_tipo=$archivo['type'];
                    echo var_dump($archivo);
                    $ext= explode('.',$archivo_nombre);
                    $tipos=array("image/jpeg","image/png","image/jpg");
                    if(!in_array($archivo_tipo,$tipos)){
                        echo "No se permite ese formato de imagen o La imagen del producto no se subio";
                    }else{
                        //mover archivo
                        $nuevo_nombre=trim($_POST['codigo_producto']).'.'.$ext[1];
                        move_uploaded_file($archivo['tmp_name'], $_SERVER['DOCUMENT_ROOT'].PATH.'/Vista/assets/img/'.$nuevo_nombre);
                        //agregar
                        $viewbag=array();
                        extract($_POST);
                        $errores=array();
                        $producto=array();
                        $producto['codigo_producto']=$codigo_producto;
                        $producto['nombre_producto']=$nombre_producto;
                        $producto['codigo_categoria']=$codigo_categoria;
                        $producto['precio_producto']=$precio_producto;
                        $producto['existencia_producto']=$existencia_producto;
                        $producto['descripcion_producto']=$descripcion_producto;
                        $producto['img']=$nuevo_nombre;
                        $this->model->insertProducto($producto);
                        //header('location:'.PATH.'/Producto');
                    }
                }else{
                    echo "La imagen del producto no se subio";
                }
            }
        
         }else{
            echo "Formularrio no completado";
         }

           
    }

    public function delete($id){
        $cod= explode('.',$id)[0];
        unlink($_SERVER['DOCUMENT_ROOT'].PATH.'/Vista/assets/img/'.$id);
        $this->model->removeProducto($cod);
    }


    public function buscar($cod){

        /*objeto para almacenar el producto encontrado*/
        $prod_Encontrado="";
        $prod_Encontrado=$this->model->get($cod);

        echo json_encode($prod_Encontrado);

    }

    function Compra(){
        $viewBag=array();
        $this->render("compra.php",$viewBag);
    }
    
    function update($img){
        if(isset($_POST['btn'])){
            //agregar
            $viewbag=array();
            extract($_POST);
            $errores=array();
            $producto=array();
            $producto['codigo_producto']=$codigo_producto;
            $producto['nombre_producto']=$nombre_producto;
            $producto['codigo_categoria']=$codigo_categoria;
            $producto['precio_producto']=$precio_producto;
            $producto['existencia_producto']=$existencia_producto;
            $producto['descripcion_producto']=$descripcion_producto;
                if(isset($_FILES['file']) || is_null($_FILES['file'])){
                    $archivo=$_FILES['file'];
                    $archivo_nombre=$archivo['name'];
                    $archivo_tipo=$archivo['type'];
                    $ext= explode('.',$archivo_nombre);
                    $tipos=array("image/jpeg","image/png","image/jpg");
                    if(!in_array($archivo_tipo,$tipos)){
                        $this->model->updateProducto($producto);
                    }else{
                        //mover archivo
                        $nuevo_nombre=trim($_POST['codigo_producto']).'.'.$ext[1];
                        echo unlink($_SERVER['DOCUMENT_ROOT'].PATH.'/Vista/assets/img/'.$img);
                        echo move_uploaded_file($archivo['tmp_name'], $_SERVER['DOCUMENT_ROOT'].PATH.'/Vista/assets/img/'.$nuevo_nombre);

                        $this->model->updateProducto($producto);
                        //header('location:'.PATH.'/Producto/admin');
                    }
                }
                //header('location:'.PATH.'/Producto/admin');
        }
    }

    public function  admin(){
        $viewBag=array();
        $productos=$this->model->get();
        $cat=new CategoriaModelo();
        $viewBag['categorias']=$cat->getCategoria();
        $viewBag['productos']=$productos;
        $this->render("admin.php",$viewBag);
    }
}