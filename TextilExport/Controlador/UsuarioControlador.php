<?php
require_once 'Controlador.php';
require_once './Modelo/UsuarioModelo.php';

class UsuarioControlador extends Controlador{

    public function login(){
        $this->render("index.php");
    }

    
    public function logout(){
        session_unset();
        session_destroy();
        header('location:'.PATH.'/Usuarios/login');

    }
    public function validar(){
        $model=new UsuarioModelo();
        $user=$_POST['nombre_usuario'];
        $pass=$_POST['nombre_usuario'];
        
        if(!empty($model->validarUsuarios($user,$pass))){
            $login_data=$model->validarUsuarios($user,$pass);
            $login_data=$login_data[0];
            $_SESSION['login_data']=$login_data;
            header('location:'.PATH.'/Productos');
           // 
        }
        else{
            $errores=array();
            $viewBag=array();
            array_push($errores,"El usuario y/o password son incorrectos");
            $viewBag['errores']=$errores;
            $this->render("login.php",$viewBag);
        }
    }
}
