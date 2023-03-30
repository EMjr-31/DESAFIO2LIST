<?php

abstract class Controlador{

    public function render($view,$viewBag=array()){
        $file="Vista/".static::class."/$view";
       $file=str_replace("Controlador","",$file);
       if(is_file($file)){
        extract($viewBag);
        ob_start();//Abriendo el buffer
        require($file);
        $content=ob_get_contents();
        ob_end_clean();
        echo $content;
       }
       else{
        echo "No existe esta vista";
       }
    }
} 