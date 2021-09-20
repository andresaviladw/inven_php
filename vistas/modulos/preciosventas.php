<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Precios de Venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Precios de Venta</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary " data-toggle="modal" data-target="#modalAgregarPrecioventa">
          
          Agregar Precio de Venta

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive  tablaPrecioVenta" width="100%">
         
        <thead>
         
         <tr>
           
           <th>Codigo</th>
           <th>Producto</th>
           <th>Precio Compra</th>
           <th>Precio Venta</th>
           <th>Acciones</th>
           <th>Estado</th>
         
           

         </tr> 

        </thead>


       </table>
       <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CATEGORÍA
======================================-->

<div id="modalAgregarPrecioventa" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar precio venta</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            


            
            <!-- ENTRADA PARA SELECCIONAR PRODUCTO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevoProducto" name="nuevoProducto" required>
                  
                  <option value="">Selecionar producto</option>

                  <?php

                  $item = null;
                  $valor = null;
                  $orden = "id";

                  $productos = ControladorProductos::ctrMostrarProductos($item, $valor,$orden);

                  foreach ($productos as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["codigo"]." - ".$value["descripcion"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL VALOR DE VENTA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoPrecioCompra" readonly required>

              </div>

            </div>
         

            <!-- ENTRADA PARA EL VALOR DE VENTA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoPrecioVenta" id="nuevoPrecioVenta"  placeholder="Ingresar precio de venta" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Precio venta</button>

        </div>

        <?php

          $crearPrecioVenta = new ControladorPreciosVentas();
          $crearPrecioVenta -> ctrCrearPrecioVenta();

        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR PRECIO VENTA
======================================-->

<div id="modalEditarPrecioVenta" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Sub categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <!-- ENTRADA PARA SELECCIONAR PRODUCTO -->

          <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg"  name="editarProducto" required>
                  
                  <option id="editarProducto"></option>
                  <?php

                    $item = null;
                    $valor = null;
                    $orden = "id";

                    $productos = ControladorProductos::ctrMostrarProductos($item, $valor,$orden);

                  foreach ($productos as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["codigo"]." - ".$value["descripcion"].'</option>';
                  }

                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL PRECIO DE VENTA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarPrecioVenta" id="editarPrecioVenta" required>

                 <input type="hidden"  name="idPrecioVenta" id="idPrecioVenta" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL VALOR DE VENTA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarPrecioCompra" readonly>

              </div>

            </div>

                        

  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      <?php

          $editarPrecioVenta = new ControladorPreciosVentas();
          $editarPrecioVenta -> ctrEditarPrecioVenta();

        ?> 

      </form>

    </div>

  </div>

</div>


