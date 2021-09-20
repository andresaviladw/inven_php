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
      
      Administrar emisor
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar emisor</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">


      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Documento Id</th>
           <th>Razon Social</th>
           <th>Nombre Comercial</th>
           <th>Direccion</th>
           <th>Telefono</th>
           <th>Celular</th>
           <th>Email</th>
           <th>C. Establecimiento</th>
           <th>Punto de emision</th>
           <th>Secuencia</th>
           <th>#. Autorizacion</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $emisor = ControladorEmisor::ctrMostrarEmisor($item, $valor);

          foreach ($emisor as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["documento_id"].'</td>

                    <td>'.$value["razon_social"].'</td>
                    <td>'.$value["nombre_comercial"].'</td>
                    <td>'.$value["direccion"].'</td>
                    <td>'.$value["telefono"].'</td>
                    <td>'.$value["celular"].'</td>
                    <td>'.$value["email"].'</td>
                    <td>'.$value["codigo_establecimiento"].'</td>
                    <td>'.$value["punto_emision"].'</td>
                    <td>'.$value["secuencia_factura"].'</td>
                    <td>'.$value["numero_autorizacion"].'</td>
                   ';
                    
                  

                   echo ' <td>

                      
                          
                        <button class="btn btn-warning btnEditarEmisor" idEmisor="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarEmisor"><i class="fa fa-pencil"></i></button>';

                        

                      echo ' 

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

<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

       
        


      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR EMISOR
======================================-->

<div id="modalEditarEmisor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar emisor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
              <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                <select id="editarDocumentoEmisor" name="seleccionarDocumentoEmisor" class="form-control input-lg">
                  
                    <option value="cedula">Cedula</option>
                    <option value="ruc_natural">RUC Persona Natural</option>
                    <option value="ruc_privada">RUC Sociedad Privada</option>
                    <option value="ruc_publica">RUC Sociedad Publica</option>
                </select>

                <input type="text"class="form-control input-lg" name="editarDocumentoIdEmisor" id="editarDocumentoIdEmisor" required>

                <input type="hidden"  name="idEmisor" id="idEmisor" required>

              </div>

            </div>


            <!-- ENTRADA PARA RAZON SOCIAL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span> 

                <input type="text" class="form-control input-lg" id="editarRazonSocial" name="editarRazonSocial"  required>

              </div>

            </div>


            
            <!-- ENTRADA PARA NOMBRE COMERCIAL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span> 

                <input type="text" class="form-control input-lg" id="editarNombreComercial" name="editarNombreComercial"  required>

              </div>

            </div>


            <!-- ENTRADA PARA DIRECCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDireccion" name="editarDireccion"  required>

              </div>

            </div>

            <!-- ENTRADA PARA TELEFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone-square"></i></span> 

                <input type="text" class="form-control input-lg" id="editarTelefono" name="editarTelefono"  required>

              </div>

            </div>

            <!-- ENTRADA PARA CELULAR -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-mobile"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCelular" name="editarCelular"  required>

              </div>

            </div>

            <!-- ENTRADA PARA EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-comment"></i></span> 

                <input type="email" class="form-control input-lg" id="editarEmail" name="editarEmail"  required>

              </div>

            </div>



            <!-- ENTRADA PARA CODIGO ESTABLECIMIENTO -->

            <h4>Codigo de Establecimiento:</h4>
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCodigoEstablecimiento" name="editarCodigoEstablecimiento" maxlength="3" required>

              </div>

            </div>


            
            <!-- ENTRADA PARA PUNTO DE EMISION -->
            <h4>Punto de Emision:</h4>
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-minus-circle"></i></span> 
               

                <input type="text" class="form-control input-lg" id="editarPuntoEmision" name="editarPuntoEmision" maxlength="3" required>
              </div>
            </div>

            
            <!-- ENTRADA PARA SECUENCIA FACTURA -->
            <h4>Secuencia de factura:</h4>
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-minus-circle"></i></span> 
               

                <input type="number" class="form-control input-lg" id="editarSecuenciaFactura" name="editarSecuenciaFactura" required>
              </div>
            </div>
            
            <!-- ENTRADA PARA NUMERO DE AUTORIZACION -->
            <h4>Numero de autorizacion:</h4>
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-minus-circle"></i></span> 
               

                <input type="text" class="form-control input-lg" id="editarNumeroAutorizacion" name="editarNumeroAutorizacion" required>
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

          $editarEmisor = new ControladorEmisor();
          $editarEmisor -> ctrEditarEmisor();

        ?> 

      </form>

    </div>

  </div>
    </div>

  </div>

</div>