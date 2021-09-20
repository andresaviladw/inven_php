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

        <input type="text" name="autoconsumodetalle" value="detalle_autoconsumo">
        <input type="text" name="entradadetalle" value="detalle_entrada">
        <input type="text" name="ventadetalle" value="detalle_venta">
       

      <button type="submit"  class="btn btn-primary pull-right">Actualizar</button>

    </form>

      </div>
      <?php
        $actualizarkardex=new ControladorTemporalKardex();
        $actualizarkardex->ctrActualizarKardex();
      ?>
      
      
     
    </div>

  </section>

</div>




  
        