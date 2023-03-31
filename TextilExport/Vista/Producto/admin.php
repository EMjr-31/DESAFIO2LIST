<!DOCTYPE html>
<html lang="es">
<head>
    <?php include './Vista/cabecera.php';?>
    <title>TextilExport - Admin </title>
</head>
<body>
    <header>
        <h1>TextilExport - Admin </h1>
        <span class="material-symbols-outlined">admin_panel_settings</span>
    </header>
    <div class="contenedor">
        <div class="contenedor__filtros">
            <div class="contenedor__filtros__buscador">
                <label for="filtro__buscador" class="material-symbols-outlined">search</label>
                <input type="text" name="" id="filtro__buscador" onkeyup="filtrobuscar(this.value);" placeholder="Producto">
            </div>
            <div class="contenedor__agregar">
                 <a href="#" data-btn="agregar" onclick="abrir(this);event.preventDefault();">Agregar</a>
                 <span class="material-symbols-outlined">add_circle </span>
            </div>
        </div>
    </div>
    <div class="contenedor">
        <table id="contenedor_tabla" >
            <thead>
                <th class="tabla_codigo">Codigo</th>
                <th class="tabla_nombre">Nombre</th>
                <th class="tabla_existencias">Existencias</th>
                <th  class="tabla_precio">Precio</th>
                <th  class="tabla_acciones">Acciones</th>
            </thead>
            <tbody>
                <?php
                    
                    foreach($productos as $proc){
                ?>
                <tr id="<?=$proc['codigo_producto']?>" >
                    <td class="tabla_codigo"><?=$proc['codigo_producto']?></td>
                    <td class="tabla_nombre filtro"><?=$proc['nombre_producto']?></td>
                    <td class="tabla_existencias"><?=$proc['existencia_producto']?></td>
                    <td class="tabla_precio">$<?=$proc['precio_producto']?></td>
                    <td class="tabla_acciones">
                        <a href="#" class="table__btn "  data-btn="modificar" onclick="abrir(this);event.preventDefault();"><span class="material-symbols-outlined btn__mod">edit</span></a>
                        <a href="#" class="table__btn" data-btn="eliminar" onclick="abrir(this);event.preventDefault();"><span class="material-symbols-outlined  btn__elim">delete</span></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>

        </table>
        <div class="modal__contenedor" id="modal__contenedor">
            <div class="modal">
                <div class="modal_contenedor__img"> 
                </div>
                <form class="desc_modal" action="" method="POST" enctype="multipart/form-data" id="desc_modal_from">
                    <a href="" class="btn__cerrar" id="btn__cerrar" onclick="event.preventDefault();"><span class="material-symbols-outlined">close</span></a>
                    <h3 id="pregunta"></h3>
                    <label  for="modal__input__codigo" class="label">Codigo</label>
                    <input type="text" name="codigo_producto" id="modal__input__codigo" class="label input" required>
                    <label for="modal__input__nombre" class="label">Nombre</label> 
                    <input type="text" name="nombre_producto" id="modal__input__nombre" class="label input" required>
                    <label for="modal__input__categoria" class="label">Categoria</label>
                    <select type="text" name="codigo_categoria" id="modal__input__categoria" class="label input" required>
                                <?php
                                    foreach($categorias as $cat){
                                ?>
                                    <option value="<?=$cat['codigo_categoria']?>"><?=$cat['nombre_categoria']?></option>
                                    <?php } ?>  
                    </select>
                    <label for="modal__input__descripcion" class="label">Descripcion</label>
                    <input type="text" name="descripcion_producto" id="modal__input__descripcion" class="label input" required>
                    <label for="modal__input__existencia" class="label">Existencias</label>
                    <input type="number" name="existencia_producto" id="modal__input__existencia" class="label input" min="1" value="1" required >
                    <label for="modal__input__precio" class="label">Precio</label class="label">
                    <input step="0.01" type="number" min="0.1" name="precio_producto" id="modal__input__precio" class="label input">
                    <input type="file" name="file" accept="image/png, .jpg" class="form__btn" id="btn__subir">
                    <input type="submit" value="Guardar" class="form__btn" id="btn__guardar" name="btn">
                </form>
            </div>
        </div>
    </div>
    <footer>
    <p>LIS104 G02T</p>
    </footer>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?=PATH?>/Vista/assets/js/modal_admin.js"></script>
    <script src="<?=PATH?>/Vista/assets/js/filtro_busqueda_admin.js"></script>
    <script src="<?=PATH?>/Vista/assets/js/cargar__img.js"></script>
</body>
</html>