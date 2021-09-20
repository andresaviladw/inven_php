

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear venta</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-6 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <!-- <span class="input-group-addon"><i class="fa fa-user"></i></span>  -->

                    <input type="hidden" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

                </div> 
                <!--=====================================
                ENTRADA FECHA EMISION
                ======================================-->
            
                <div class="form-group col-xs-6">
                
                  <div class="input-group col-xs-6">
                      <label for="fecha_emision">Fecha de Emision</label>
                      <input type="text" class="form-control" id="fecha_emision" name="fecha_emision">

                  </div> 
                </div> 

                 <!--=====================================
                ENTRADA FECHA VENCIMIENTO
                ======================================-->
            
                <div class="form-group col-xs-6">
                
                  <div class="input-group col-xs-6">
                      <label for="fecha_vencimiento">Fecha de vencimiento</label>
                      <input type="text" class="form-control" id="fecha_vencimiento"
                      name="fecha_vencimiento">

                  </div> 
                </div> 

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php

                    $item = null;
                    $valor = null;

                    $emisor=ControladorEmisor::ctrMostrarEmisor($item, $valor);

                    $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                    foreach ($emisor as $key => $valores1) {
                        
                        
                      
                    }

                    

                    if(!$ventas){

                      foreach ($ventas as $key => $valueVenta) {

                      
                 
                      }

                      $id_venta=$valueVentas['id']+1;

                      echo '<input type="hidden" class="form-control" id="idventa" value="'.$id_venta.'" readonly>';

                      echo '<input type="hidden" class="form-control" id="nuevaDetalleVenta" name="nuevaDetalleVenta" value="'.$valores1['codigo_establecimiento'].' '.$valores1['punto_emision'].'" readonly>';
                      echo '<input type="text" class="form-control" id="nuevaSecuencia" name="nuevaSecuencia" value="'.str_pad($valores1['secuencia_factura'], 9, "0", STR_PAD_LEFT).'" readonly>';


                  

                    }else{

                      foreach ($ventas as $key => $valueVenta) {
                        
                        
                      
                      }

                      foreach ($emisor as $key => $valores1) {
                        
                        
                      
                      }

                      $id_venta=$valueVenta['id']+1;

                      

                     

                      echo '<input type="hidden" class="form-control" id="idventa" value="'.$id_venta.'" readonly>';


                      /* Secuencia de factura */
                      $codigo = str_pad(intval ($valueVenta["codigo"]) + 1, 9, "0", STR_PAD_LEFT);

                      echo '<input type="hidden" class="form-control" id="nuevaDetalleVenta" name="nuevaDetalleVenta" value="'.$valores1['codigo_establecimiento'].' '.$valores1['punto_emision'].'" readonly>';

                      echo '<input type="text" class="form-control" id="nuevaSecuencia" name="nuevaSecuencia" value="'.$codigo.'" readonly>
                      
                      ';
                  

                    }

                    ?>
                    
                    
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                    <option value="">Seleccionar cliente</option>

                    <?php

                      $item = 'estado';
                      $valor = 1;

                      $clientes = ControladorClientes::ctrMostrarClientesHabilitados($item, $valor);

                       foreach ($clientes as $key => $value) {

                         echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                       }

                    ?>

                    </select>
                    
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                  
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA DEL DESCRIPCION
                ======================================--> 

                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <?php

                    if(!$ventas){
                      echo '<input type="text" class="form-control" id="nuevaDescripcion" name="nuevaDescripcion" value="'.'Venta '.$valores1['secuencia_factura'].'">';
                    }else{
                      $valorsuma=ltrim($valueVenta["codigo"],0);
                      echo '<input type="text" class="form-control" id="nuevaDescripcion" name="nuevaDescripcion" value="'.'Venta '.($valorsuma+1).'">';
                    }

                    ?>
                  
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">

                

                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================
                  ================-->
                  
                  <div class="col-xs-12 pull-right">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Sub Total</th>      
                          <th>Impuesto</th>
                          <th>Descuento</th>
                          <th>Total</th>     
                        </tr>
                        

                      </thead>

                      <tbody>
                      
                        <tr>

                        
                        <td style="width: 28%">
                            
                            <div class="input-group">
                              
                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                               <input type="text"  class="form-control input-lg" min="0" name="nuevoPrecioSubtotal" id="nuevoPrecioSubtotal" totalsubtotal="" placeholder="0.00" readonly required>

                               <input+ type="hidden" name="totalSubtotal" id="totalSubtotal">
                               

                             
                        
                            </div>

                          </td>
                          
                          <td style="width: 22%">
                            
                            <div class="input-group">
                              
                          

                               <input type="text"  class="form-control input-lg" min="0" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" placeholder="0.00" readonly required>

                               

                             
                        
                            </div>

                          </td>

                          <td style="width: 22%">
                            
                            <div class="input-group">

                           
                           
                              <input type="number" class="form-control input-lg" min="0" id="nuevoDescuentoVenta"
                              step="any" name="nuevoDescuentoVenta" placeholder="0.00" value="0.00" required>

                               <input type="hidden" name="nuevoPrecioDescuento" id="nuevoPrecioDescuento" required>

                             
                        
                            </div>

                          </td>



                           <td style="width: 40%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0.00" readonly required>

                              <input type="hidden" name="totalVenta" id="totalVenta">
                              
                        
                            </div>

                          </td>
                          
                          

                        </tr>

                        <tr>
                        <td style="width: 23%">
                            
                            <div class="input-group">
                           
                              
                              <input type="hidden" class="form-control input-lg" id="nuevoTotalUtilidadVenta" name="nuevoTotalUtilidadVenta" totalUtilidad="" readonly required>

                             
                              <input type="hidden" name="totalUtilidadVenta" id="totalUtilidadVenta">
                              
                        
                            </div>

                          </td>
                       
                         

                         
                
                        
              </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

               

     

               
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>

          </div>

        </form>

        <?php

          $guardarVenta = new ControladorVentas();
          $guardarVenta -> ctrCrearVenta();
    
          
        ?>

        </div>
          
      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-6 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaVentas">
              
               <thead>

                 <tr>
                  <th>Imagen</th>
                  <th>Código</th>
                  <th>Descripcion</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>

    </div>
   
  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <select name="documento" id="documento" class="form-control input-lg">
                    <option value="cedula">Cedula</option>
                    <option value="ruc_natural">RUC Persona Natural</option>
                    <option value="ruc_privada">RUC Sociedad Privada</option>
                    <option value="ruc_publica">RUC Sociedad Publica</option>
                </select>

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" 
                id="nuevoDocumentoId" placeholder="Ingresar documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL CELULAR -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-mobile"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCelular" placeholder="Ingresar celular" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

      <?php

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();

      ?>

    </div>

  </div>

</div>
