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
      
      Administrar impuestos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar impuestos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarImpuesto">
          
          Agregar impuesto

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
          
           <th>Codigo</th>
           <th>Nombre</th>
           <th>Valor</th>
           <th>Acciones</th>
           <th>Estado</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $impuestos = ControladorImpuestos::ctrMostrarImpuestos($item, $valor);

          foreach ($impuestos as $key => $value) {
           
            echo ' <tr>


                    <td>'.$value["codigo"].'</td>
                    <td>'.$value["nombre"].'</td>
                    <td>'.$value["valor"].'</td>

                    <td>

                      <div class="btn-group">';
                          
                        
                        if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial" ){
                          echo '<button class="btn btn-warning btnEditarImpuesto" idImpuesto="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarImpuesto"><i class="fa fa-pencil"></i></button>';

                          
                  if($value["estado"] != 0){

                    echo '<td><button class="btn btn-success btn-xs btnHabilitarImpuesto" idImpuestoHabilitar="'.$value["id"].'" estadoImpuesto="0">Habilitado</button></td>';

                  }else{

                    echo '<td><button class="btn btn-danger btn-xs btnHabilitarImpuesto" idImpuestoHabilitar="'.$value["id"].'" estadoImpuesto="1">Deshabilitado</button></td>';

                  }

                        }else {
                         echo '<button>Sin Accion</button>';
                        }

                      echo '</div>  

                    </td>

                  </tr>';
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

<div id="modalAgregarImpuesto" class="modal fade" role="dialog">
  
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

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCodigo" id="nuevoCodigo" placeholder="Ingresar codigo" required>

              </div>

            </div>
            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" id="nuevoNombre" placeholder="Ingresar nombre de impuesto" required>

              </div>

            </div>
            <!-- ENTRADA PARA EL VALOR -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoValor" id="nuevoValor" placeholder="Ingresar valor" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar impuesto</button>

        </div>

        <?php

          $crearImpuesto = new ControladorImpuestos();
          $crearImpuesto -> ctrCrearImpuesto();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR IMPUESTO
======================================-->

<div id="modalEditarImpuesto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar impuesto</h4>

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

                 <input type="hidden"  name="idImpuesto" id="idImpuesto" required>

              </div>

            </div>
            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre" required>

                 

              </div>

            </div>
            <!-- ENTRADA PARA EL VALOR -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarValor" id="editarValor" required>

                 

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

          $editarImpuesto = new ControladorImpuestos();
          $editarImpuesto -> ctrEditarImpuesto();

        ?> 

      </form>

    </div>

  </div>

</div>



