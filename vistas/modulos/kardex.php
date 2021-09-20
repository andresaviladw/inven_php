<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Cargar datos para kardex
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active"> Cargar datos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <form class="formularioKardexImportar" method="post" enctype="multipart/form-data">

      <input type="hidden" name="idResponsable" value="<?php echo $_SESSION["id"]; ?>">

      <input type="text" class="productosImportar" id="listaProductosKardexImporte" name="listaProductosKardexImporte">

      
      <button type="submit" id="guardarKardexImporte" class="btn btn-primary pull-right">Cargar datos</button>

      
      
  
    </form>

    

      </div>
      
     
    </div>

  </section>

</div>




  
        