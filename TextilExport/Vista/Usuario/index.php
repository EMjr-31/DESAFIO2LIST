<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TextilExport</title>
<link href="<?=PATH?>/Vista/assets/css/estilos_login.css" rel="stylesheet">
</head>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> Sign In </h2>
    <h2 class="inactive underlineHover">Iniciar sesion</h2>

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form >
      <input type="text" id="login" class="fadeIn second" name="nombre_usuario" placeholder="Usuario">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>
    <input type="text" id="password" class="fadeIn third" name="contrasenia_usuario" placeholder="Contraseña">

    <!-- Remind Passowrd -->
    <div id="formFooter">
      
    </div>

  </div>
</div>
    
</body>
</html>