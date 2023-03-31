
/*elemento ventana modal*/
const modal= document.getElementById('modal__contenedor');
/*Funcion que se ejecuta al seleccionar un producto y realiza la busqueda de dicho producto*/
function abrir(elemento){
    desabilitarScroll();
    const btn= elemento;
    let modalStyle = window.getComputedStyle(modal);
    if( modalStyle.getPropertyValue('display')=="none"){
        modal.style.display='flex';
        var tipobtn= btn.getAttribute("data-btn");
        switch (tipobtn) {
            case "agregar": 
                agregar();
            break;               
            case "modificar": 
                editar(elemento);            
            break;
            case "eliminar": console.log("E");
                eliminar(elemento); 
            break;
        }
        ;
        /*
        
        */
    }
}

/*funcion para agregar */
function agregar(){
    var labels= document.querySelectorAll('.label');
    labels.forEach(function(label){
        label.classList.remove("articulos__filtro");
    });
    imgDefecto();
    document.getElementById('desc_modal_from').setAttribute("action","/LIS/LABORATORIOS/DESAFIO2/TextilExport/Producto/add");
    document.getElementById('btn__guardar').setAttribute("value","Guardar");
    document.getElementById('btn__subir').classList.remove("articulos__filtro");
    document.getElementById('modal__input__codigo').removeAttribute("readonly");
}
/*funcion para editar*/
function editar(elemento){
    document.getElementById('pregunta').innerHTML="";
    var labels= document.querySelectorAll('.label');
    labels.forEach(function(label){
        label.classList.remove("articulos__filtro");
    });
    var codigo=((elemento.parentNode).parentNode).getAttribute("id");
    document.getElementById('desc_modal_from').setAttribute("action","editar.php");
    document.getElementById('btn__guardar').setAttribute("value","Guardar Cambios");
    document.getElementById('btn__subir').classList.add("articulos__filtro");
    document.getElementById('modal__input__codigo').setAttribute("readonly","");
    $.post('/LIS/LABORATORIOS/DESAFIO2/TextilExport/Producto/buscar/'+codigo,
        function(datos, estado){
            console.log(datos);
            cargarProducto(datos);
            //console.log(estado);
        }
        );
}
function eliminar(elemento){
    document.getElementById('pregunta').innerHTML="";
    document.getElementById('btn__subir').classList.add("articulos__filtro");
    document.getElementById('btn__guardar').setAttribute("value","Eliminar");

    var labels= document.querySelectorAll('.label');
    labels.forEach(function(label){
        label.classList.add("articulos__filtro");
    });

    var inputs= document.querySelectorAll('.input');
    inputs.forEach(function(input){
        input.setAttribute("required","");
    });
    
    var codigo=((elemento.parentNode).parentNode).getAttribute("id");
    $.post('/LIS/LABORATORIOS/DESAFIO2/TextilExport/Producto/buscar/'+codigo,
        function(datos, estado){
            console.log(datos);
            cargarProducto2(datos);
            //console.log(estado);
        }
        );
}
/*Funcion para mostrar el productos a seleccionar*/
function cargarProducto(datos){
    /*Convertimos el JSON en un Objeto JS*/
    let prod=JSON.parse(datos)[0];
    console.log(prod);
    /*cargamos la informacion*/
    document.getElementById('modal__img').src="/LIS/LABORATORIOS/DESAFIO2/TextilExport/Vista/assets/img/"+prod['img'];
    document.getElementById('modal__input__codigo').setAttribute("value",prod["codigo_producto"]);
    document.getElementById('modal__input__nombre').setAttribute("value",prod["nombre_producto"]);
    document.getElementById('modal__input__categoria').setAttribute("value",prod["codigo_categoria"]);
    document.getElementById('modal__input__descripcion').setAttribute("value",prod["descripcion_producto"]);
    document.getElementById('modal__input__existencia').setAttribute("value",prod["existencia_producto"]);
    document.getElementById('modal__input__precio').setAttribute("value",prod["precio_producto"]);
}
function cargarProducto2(datos){
    /*Convertimos el JSON en un Objeto JS*/
    console.log('LLEGAMOS');
    let prod=JSON.parse(datos)[0];
    /*cargamos la informacion*/
    document.getElementById('desc_modal_from').setAttribute("action","/LIS/LABORATORIOS/DESAFIO2/TextilExport/Producto/delete/"+prod['img']);
    document.getElementById('modal__img').src="/LIS/LABORATORIOS/DESAFIO2/TextilExport/Vista/assets/img/"+prod['img'];
    document.getElementById('modal__input__codigo').setAttribute("value",prod["codigo_producto"]);
    document.getElementById('modal__input__nombre').setAttribute("value",prod["nombre_producto"]);
    document.getElementById('modal__input__categoria').setAttribute("value",prod["codigo_categoria"]);
    document.getElementById('modal__input__descripcion').setAttribute("value",prod["descripcion_producto"]);
    document.getElementById('modal__input__existencia').setAttribute("value",prod["existencia_producto"]);
    document.getElementById('modal__input__precio').setAttribute("value",prod["precio_producto"]);
    document.getElementById('pregunta').innerHTML="Esta seguro de eliminar el poducto \" "+prod["nombre_producto"]+" \"?";
}

/* Cargar imagen*/
function imgDefecto(){
    document.getElementById('modal__img').src="/LIS/LABORATORIOS/DESAFIO2/TextilExport/Vista/assets/img/subir_img.jpg";
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