<!DOCTYPE html>
<html lang="es">
<head>
    <?php include './Vista/cabecera.php';?>
    <title>TextilExport</title>
</head>
<body>
    <?php 
    if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
        $carrito_n=$_SESSION['carrito'];
        $_SESSION['carrito']=$carrito_n;
    }
    ?>
    <?php include './Vista/menu.php';?>
    <div class="contenedor">
        <div class="contenedor__filtros">
            <div class="contenedor__filtros__buscador">
                <label for="filtro__buscador" class="material-symbols-outlined">search</label>
                <input type="text" name="" id="filtro__buscador" onkeyup="filtrobuscar(this.value);" placeholder="Producto">
            </div>
        </div>
    </div>
    <div class="contenedor">
        <div id="contenedor_articulos" >
            <?php
            foreach($productos as $proc){
            ?>
            <form class="articulos" id="articulo" data-id="<?=$proc['codigo_producto']?>" onclick="abrir(this);event.preventDefault();">
                    <h3 class="articulo_nombre"><?=$proc['nombre_producto']?></h3>
                    <img src="<?=PATH."/Vista/assets/img/".$proc['img']?>" alt="">
                    <div class="artiulo_descripcion">
                        <div class="articulos__descripcion__general">
                            <h4 class="text_precio">$<?=$proc['precio_producto']?></h4>
                            <p class="<?=$proc['existencia_producto']>0?'p_disponible':'p_nodisponible'?>"><?=$proc['existencia_producto']?'Disponible':'Producto no disponible'?></p>
                        </div>
                        <input class="btn_ver" type="submit" value="Ver">
                    </div>
            </form>
            <?php }
            ?>

        </div>
        <div class="modal__contenedor" id="modal__contenedor">
            <div class="modal">
                <div class="modal_contenedor__img">
                    <img src="" alt="prodc" id="modal__img">
                </div>
                <form class="desc_modal" method="POST" action="<?=PATH."/Carrito/addProducto"?>">
                <a href="" class="btn__cerrar" id="btn__cerrar" onclick="event.preventDefault();"><span class="material-symbols-outlined">close</span></a>
                    <h2 id="modal__nombre">Prueba</h2>
                    <p id="modal__cat"></p>
                    <p id="modal__prec"></p>
                    <p id="modal__exis"></p>
                    <p id="modal__desc"></p>
                    <input type="hidden" name="precio" id="precio_c" value="12">
                    <input type="hidden" name="nombre" id="nombre_c" value="12">
                    <div id="contenedor__cantidades">
                        <div id="contenedor__cantidades_controles">
                            <a href="#" class="btn_control" id="btn_control_i" onclick="in_dec_cant(this);">-</a>
                            <input type="number" name="cantidad" id="modal_cantidad" min="1" max="" value="1" onchange="cambio_cant(this);">
                            <a href="#" class="btn_control" id="btn_control_d" onclick="in_dec_cant(this);">+</a>
                        </div>
                        <div id="contenedor_btn_aniadir">
                            <input id="btn_aniadir" type="submit" value="Añadir" name="aniadir">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal__contenedor" id="modal__contenedor__carrito">
        <div class="modal">
            <div id="modal__carrito__titulo">
                <a href="" class="btn__cerrar" id="btn__cerrar__carrito" onclick="event.preventDefault();"><span class="material-symbols-outlined">close</span></a>
                <h2 class="titulo_carrito">Carrito</h2>
            </div>
            <table id="contenedor_tabla_carrito" >
            <thead>
                <th class="tabla_carrito_nombre">Nombre</th>
                <th class="tabla_carrito_precio">Precio</th>
                <th class="tabla_carrito_cantidad">Cantidad</th>
                <th  class="tabla_carrito_subtotal">Subtotal</th>
                <th  class="tabla_car_acciones">Acciones</th>
            </thead>
            <tbody>
                <?php
                if(isset($_SESSION['carrito'])){
                    $index=0;
                    $total=0;
                    foreach ($carrito_n as $prod){
                ?>
                <tr id="carrito_" >
                    <td class="tabla_carrito_nombre"><?=$prod['nombre']?></td>
                    <td class="tabla_carrito_precio">$<?=$prod['precio']?></td>
                    <td class="tabla_carrito_cantidad"><?=$prod['cantidad']?></td>
                    <td class="tabla_carrito_subtotal">$<?=$prod['cantidad']*$prod['precio']?></td>
                    <?php $total+=$prod['cantidad']*$prod['precio']?>
                    <td class="tabla_car_acciones">
                        <a href="<?=PATH."/Carrito/rmvProducto/".$index?>" class="table__btn" data-btn="eliminar"><span class="material-symbols-outlined  btn__elim">delete</span></a>
                    </td>
                </tr>
                <?php
                    $index=$index+1; 
                    }
                ?>
                    <tr class="tr_final">
                        <td colspan="3"><b>Total:</b></td>
                        <td colspan="2"><b><?=isset($total)?"$".$total:"$0"?></b></td>
                    </tr>
                <?php 
                }else{
                    ?>
                    <tr class="tr_final">
                        <td colspan="5"><?="No hay productos en el carrito"?></td>
                    </tr>
                    <?php
                }?>
            </tbody>
            </table>
            <?php
                if(isset($_SESSION['carrito'])){
                ?>
                    <a href="<?=PATH."/Carrito/deleteCarrito"?>" type="button" class="table__btn" id="btn_vaciar_carrito">Vaciar Carrito</a>
                    <a href="<?=PATH."/Producto/Compra"?>" type="button" class="table__btn"  id="btn_cotizas">Comprar</a>
            <?php
            }?>
        </div>
    </div>
    <?php include './Vista/pie.php'?>
</body>
</html>