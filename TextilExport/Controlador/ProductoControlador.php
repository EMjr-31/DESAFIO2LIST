<?php
require_once 'Controlador.php';
require_once './Modelo/ProductoModelo.php';
class ProductoControlador extends Controlador{

    private $model;

    function __construct(){
        $this->model=new ProductoModelo();
    }

    public function Index(){
        $viewBag=array();
        $productos=$this->model->get();
        $viewBag['productos']=$productos;
        $this->render("index.php",$viewBag);
    }

    public function details($id){
        $viewBag=array();
        $productos=$this->model->get($id);
        $viewBag['productos']=$productos[0];
        $this->render("details.php",$viewBag);
    }

    public function create(){
        $this->render("nuevo.php");
    }

    public function add(){
        if(isset($_POST['Guardar'])){
            $viewbag=array();
            extract($_POST);
            $errores=array();
            $editorial=array();
            $editorial['codigo_editorial']=$codigo_editorial;
            $editorial['nombre_editorial']=$nombre_editorial;
            $editorial['contacto']=$contacto;
            $editorial['telefono']=$telefono;

            if(estaVacio($codigo_editorial)|| is_null($codigo_editorial)){
                array_push($errores,'Debes Ingresar el codigo del editorial');
            }elseif(!esCodigoEditorial($codigo_editorial)){
                array_push($errores,'El codigo del editorial debe tener el formato " EDI### "');
            }
            if(estaVacio($nombre_editorial)|| is_null($nombre_editorial)){
                array_push($errores,'Debes Ingresar el nombre del editorial');
            }elseif(!esTexto($nombre_editorial)){
                array_push($errores,'El nombre del editorial no puede contener numeros');
            }
            if(estaVacio($contacto)|| is_null($contacto)){
                array_push($errores,'Debes Ingresar el nombre del contacto');
            }elseif(!esTexto($contacto)){
                array_push($errores,'El nombre del contacto no puede contener numeros');
            }
            if(estaVacio($telefono)|| is_null($telefono)){
                array_push($errores,'Debes ingresar un numero de telefono');
            }elseif(!esTelefono($telefono)){
                array_push($errores,'El telefono debe tener un formato correcto');
            }

            if(count($errores)==0){
             
                $this->model->insertEditorial($editorial);
                header('location:'.PATH.'/Editoriales');
            }else{
                $viewbag['errores']=$errores;
                $viewbag['editorial']=$editorial;
                $this->render("new.php",$viewbag);
            }
           
        }

    }

    public function delete($id){
        $this->model->removeProducto($id);
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

    public function  admin(){
        $viewBag=array();
        $productos=$this->model->get();
        $viewBag['productos']=$productos;
        $this->render("admin.php",$viewBag);
    }
}