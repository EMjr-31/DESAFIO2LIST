
/*elemento ventana modal*/
const modal= document.getElementById('modal__contenedor');
/*Funcion que se ejecuta al seleccionar un producto y realiza la busqueda de dicho producto*/
function abrir(elemento){
    desabilitarScroll();
    const articulo= elemento;
    let modalStyle = window.getComputedStyle(modal);
    if( modalStyle.getPropertyValue('display')=="none"){
        modal.style.display='flex';
        var codigo= articulo.getAttribute("data-id");
        $.post('/LIS/LABORATORIOS/DESAFIO2/TextilExport/Producto/buscar/'+codigo,
        function(datos, estado){
            cargarProducto(datos);
            //console.log(estado);
        }
        );
    }
}
/*Funcion para mostrar el productos a seleccionar*/
function cargarProducto(datos){
    /*Convertimos el JSON en un Objeto JS*/
    var prod=JSON.parse(datos)[0];
    console.log(prod);
    /*cargamos la informacion*/
    document.getElementById('modal__img').src="/LIS/LABORATORIOS/DESAFIO2/TextilExport/Vista/assets/img/"+prod['img'];
    document.getElementById('modal__nombre').innerHTML=prod['nombre_producto'];
    document.getElementById('nombre_c').value=prod["nombre_producto"];
    document.getElementById('modal__cat').innerHTML="<b>Categoria: </b>"+prod["codigo_categoria"];
    document.getElementById('modal__desc').innerHTML="<b>Descripcion: </b>"+prod["descripcion_producto"];
    document.getElementById('modal__prec').innerHTML="<b>Precio: </b>$"+prod["precio_producto"];
    document.getElementById('precio_c').value=prod["precio_producto"];
    if(prod["existencia_producto"]>0){
        document.getElementById('modal_cantidad').value="1";
        document.getElementById('modal__exis').innerHTML="<b>En existencia: </b>"+prod["existencia_producto"]+" unidades";
        document.getElementById('modal__exis').style.color="black";
        document.getElementById('modal_cantidad').setAttribute("max",prod["existencia_producto"]);
        document.getElementById('contenedor__cantidades').style.display="flex";
    }else{
        document.getElementById('modal__exis').innerHTML="<b>Producto no disponible</b>";
        document.getElementById('modal__exis').style.color="#FE8484";
        document.getElementById('contenedor__cantidades').style.display="none";
    }
   
}

/*Funcion para cerrar la cerrar la ventana moval y evitar el recargar la pagina*/
document.getElementById('btn__cerrar').addEventListener("click", function(event){
    event.preventDefault();
    modal.style.display='none'; 
    habilitarScroll();
});

/* barra de desplaza,miento*/
function desabilitarScroll(){  
    var x = window.scrollX;
    var y = window.scrollY;
    window.onscroll = function(){ window.scrollTo(x, y) };
}

function habilitarScroll(){  
    window.onscroll = null;
}