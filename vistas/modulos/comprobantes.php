

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar comprobantes 
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar comprobantes</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarComprobante">
          
          Agregar comprobante

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
         
           <th>Codigo</th>
           <th>Comprobante</th>
           <th>Acciones</th>
           <th>Estado</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $comprobantes = ControladorComprobantes::ctrMostrarComprobantes($item, $valor);

          foreach ($comprobantes as $key => $value) {
           
            echo ' <tr>

                    

                    <td>'.$value["codigo"].'</td>

                    <td>'.$value["nombre"].'</td>
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarComprobante" idComprobante="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarComprobante"><i class="fa fa-pencil"></i></button>';


                      echo '</div>  

                    </td>';
                    if($value["estado"] != 0){

                      echo '<td><button class="btn btn-success btn-xs btnHabilitarComprobante" idComprobanteHabilitar="'.$value["id"].'" estadoComprobante="0">Habilitado</button></td>';
  
                    }else{
  
                      echo '<td><button class="btn btn-danger btn-xs btnHabilitarComprobante" idComprobanteHabilitar="'.$value["id"].'" estadoComprobante="1">Deshabilitado</button></td>';
  
                    }

                  echo '</tr>';
          }

        ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CATEGORÍA
======================================-->

<div id="modalAgregarComprobante" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar codigo" required>

              </div>

            </div>

            
            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar comprobante</button>

        </div>

        <?php

          $crearComprobante = new ControladorComprobantes();
          $crearComprobante -> ctrCrearComprobante();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CATEGORÍA
======================================-->

<div id="modalEditarComprobante" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCodigo" id="editarCodigo" required>

                 <input type="hidden"  name="idComprobante" id="idComprobante" required>

              </div>

            </div>


            
            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre" required>

          

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

          $editarComprobate= new ControladorComprobantes();
          $editarComprobate -> ctrEditarComprobate();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarComprobante = new ControladorComprobantes();
  $borrarComprobante -> ctrBorrarComprobante();

?>


