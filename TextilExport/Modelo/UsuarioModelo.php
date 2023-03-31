lines (9 sloc)  314 Bytes

<?php
require_once 'Modelo.php';
class UsuarioModelo extends Modelo{

    public function validarUsuarios($user,$pass){
        $query="SELECT nombre_usuario, codigo_rol FROM usuarios
        WHERE nombre_usuario=:user AND contrasenia_usuario=SHA2(:pass,256)";
        return $this->getQuery($query,['user'=>$user, 'pass'=>$pass]);
    }
}