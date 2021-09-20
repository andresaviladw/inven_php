
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar proveedores
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar proveedores</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedor">
          
          Agregar proveedor

        </button>

      </div>

      <div class="box-body">
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           <th>Proveedor</th>
           <th>Documento ID</th>
           <th>Codigo</th>
           <th>Direccion</th>
           <th>Telefono</th>
           <th>Celular</th>
           <th>Email</th>
           <th>Nombre Referencia</th>
           <th>Telefono / Celular</th>
           <th>Fecha de Registro</th>
           <th>Acciones</th>
           <th>Estado</th>

         </tr> 

        </thead>

        <tbody>
        <?php
        $item = null;
        $valor = null;

        $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

        

        foreach ($proveedores as $key => $value) {
         ////para que las id no  comiencen desde 0 se sima key es dcir indice +1
          echo ' <tr>

                  
                  <td class=>'.$value["proveedor"].'</td>
                  <td>'.$value['documentoId'].'</td>
                  <td>'.$value['codigo'].'</td>
                  <td class=>'.$value["direccion"].'</td>
                  <td class=>'.$value["telefono"].'</td>
                  <td class=>'.$value["celular"].'</td>
                  <td class=>'.$value["email"].'</td>
                  <td class=>'.$value["nombre_referencia"].'</td>
                  <td class=>'.$value["movil_referencia"].'</td>
                  <td class=>'.$value["fecha"].'</td>
                  
                  

                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarProveedor" idProveedor="'.$value["codigo"].'" data-toggle="modal" data-target="#modalEditarProveedor"><i class="fa fa-pencil"></i></button>

                    </div>  

                  </td>';

                  
                  if($value["estado"] != 0){

                    echo '<td><button class="btn btn-success btn-xs btnHabilitarProveedor" idProveedorHabilitar="'.$value["codigo"].'" estadoProveedor="0">Habilitado</button></td>';

                  }else{

                    echo '<td><button class="btn btn-danger btn-xs btnHabilitarProveedor" idProveedorHabilitar="'.$value["codigo"].'" estadoProveedor="1">Deshabilitado</button></td>';

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
MODAL AGREGAR PROVEEDOR
======================================-->

<div id="modalAgregarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar proveedor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-id-card"></i></span> 

                <select name="tipoDocumentoProveedor" id="documentoProveedor" class="form-control input-lg">
                    <option value="cedula">Cedula</option>
                    <option value="ruc_natural">RUC Persona Natural</option>
                    <option value="ruc_privada">RUC Sociedad Privada</option>
                    <option value="ruc_publica">RUC Sociedad Publica</option>
                </select>

                <input type="text" class="form-control input-lg" name="nuevoIdDocumento" id="nuevoIdDocumento" placeholder="Documento ID" required >

              </div>

            </div>

            <!-- ENTRADA PARA EL CODIGO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCodigoProveedor" placeholder="Ingresar codigo" id="nuevoCodigoProveedor" required>

              </div>

            </div>
            <!-- ENTRADA PARA EL PROVEEDOR -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoProveedor" placeholder="Ingresar proveedor" id="nuevoProveedor" required>

              </div>

            </div>

            <!-- ENTRADA PARA DIRECCION -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar direccion" required>

              </div>

            </div>


            


            <!-- ENTRADA PARA TELEFONO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone-square"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar telefono" required>

              </div>

            </div>



            <!-- ENTRADA PARA CELULAR -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-mobile"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCelular" placeholder="Ingresar celular" required>

              </div>

            </div>



            <!-- ENTRADA PARA EMAIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-comment"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail"  size="30" placeholder="Ingresar email" required>

              </div>

            </div>

            
  <!-- ENTRADA PARA NOMBRE REFERENCIA -->

  <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombreReferencia" placeholder="Ingresar nombre referencia" required>

              </div>

            </div>


             <!-- ENTRADA PARA MOVIL REFERENCIA -->

  <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-mobile"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoMovilReferencia" placeholder="Ingresar celular" required>

              </div>

            </div>







          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar proveedor</button>

        </div>

        <?php

          $crearProveedor = new ControladorProveedores();
          $crearProveedor -> ctrCrearProveedor();

        ?>

      </form>

    </div>

  </div>

</div>

  <!--=====================================
MODAL EDITAR PROVEEDOR
======================================-->

<div id="modalEditarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-id-card"></i></span> 

                <select name="tipoDocumentoProveedorEditar" id="tipoDocumentoProveedorEditar" class="form-control input-lg">
                    <option value="cedula">Cedula</option>
                    <option value="ruc_natural">RUC Persona Natural</option>
                    <option value="ruc_privada">RUC Sociedad Privada</option>
                    <option value="ruc_publica">RUC Sociedad Publica</option>
                </select>

                <input type="text" class="form-control input-lg" id="editarIdDocumento" name="editarIdDocumento" value="" required>

                <input type="hidden"  name="idProveedor" id="idProveedor" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL CODIGO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCodigoProveedor" name="editarCodigoProveedor">

              </div>

            </div>
            <!-- ENTRADA PARA EL PROVEEDOR -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span> 

                <input type="text" class="form-control input-lg" id="editarProveedor" name="editarProveedor" value="" >

              </div>

            </div>



            <!-- ENTRADA PARA DIRECCION DEL PROVEEDOR -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDireccion" name="editarDireccion" value="" >

              </div>

            </div>



            <!-- ENTRADA PARA TELEFONO DEL PROVEEDOR -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone-square"></i></span> 

                <input type="text" class="form-control input-lg" id="editarTelefono" name="editarTelefono" value="" >

              </div>

            </div>



            <!-- ENTRADA PARA CELULAR DEL PROVEEDOR -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-mobile"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCelular" name="editarCelular" value="" >

              </div>

            </div>




            <!-- ENTRADA PARA EMAIL DEL PROVEEDOR -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-comment"></i></span> 

                <input type="email" class="form-control input-lg" id="editarEmail" name="editarEmail" value="" >

              </div>

            </div>


            <!-- ENTRADA PARA NOMBRE REferencia DEL PROVEEDOR -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span> 

                <input type="text" class="form-control input-lg" id="editarNuevaReferencia" name="editarNuevaReferencia" value="" >

              </div>

            </div>


            <!-- ENTRADA PARA MOVIL REferencia DEL PROVEEDOR -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-mobile"></i></span> 

                <input type="text" class="form-control input-lg" id="editarMovilReferencia" name="editarMovilReferencia" value="" >

              </div>

            </div>

            

            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar proveedor</button>

        </div>

     <?php

          $editarProveedor = new ControladorProveedores();
          $editarProveedor -> ctrEditarProveedor();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php


?> 
