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
      
      Importar desde excel
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active"> Importar desde excel</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <form class="formularioImportar" method="post" enctype="multipart/form-data">

      <input type="file" name="file_importar" id="file">

      <input type="hidden" name="idResponsable" value="<?php echo $_SESSION["id"]; ?>">

      <input type="text" class="productosImportar" id="listaProductosEntradaImporte" name="listaProductosEntradaImporte">

      
      <button type="submit" id="guardarImporte" class="btn btn-primary pull-right">Subir importe</button>
      <p></p>
      <button class='btn btn-success  pull-right' id='Importe' >Importar</button>
      
      
 

      <div class="form-group row nuevoProductoImportarEntrada">
      
      </div>
      
      
      <?php
        $crearImporte=new ControladorImportarExcel();
        $crearImporte->ctrSubirImporte();
      ?>
      
    </form>

    

      </div>
      
     
    </div>

  </section>

</div>




  
        