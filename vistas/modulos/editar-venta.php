<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Editar venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear venta</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-6">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
              <div class="box">

                <?php

                    $item = "id";
                    $valor = $_GET["idVenta"];

                    $venta = ControladorVentas::ctrMostrarVentas($item, $valor);

                    $itemUsuario = "id";
                    $valorUsuario = $venta["id_vendedor"];

                    $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                    $itemCliente = "id";
                    $valorCliente = $venta["id_cliente"];

                    $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                    $porcentajeImpuesto = $venta["impuesto"] ;


                    $porcentajeDescuento = $venta["descuento"] * 100;


                ?>

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $vendedor["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $vendedor["id"]; ?>">

                  </div>

                </div> 

                
                <!--=====================================
                ENTRADA FECHA EMISION
                ======================================-->
            
                <div class="form-group col-xs-6">
                
                  <div class="input-group col-xs-6">
                      <label for="fecha_emision">Fecha de Emision</label>
                      <input type="text" class="form-control" id="fecha_emision"
                      value="<?php echo $venta["fecha_emision"]; ?>" name="fecha_emision">

                  </div> 
                </div> 

                 <!--=====================================
                ENTRADA FECHA VENCIMIENTO
                ======================================-->
            
                <div class="form-group col-xs-6">
                
                  <div class="input-group col-xs-6">
                      <label for="fecha_emision">Fecha de vencimiento</label>
                      <input type="text" class="form-control" id="fecha_vencimiento"
                      name="fecha_vencimiento" value="<?php echo $venta["fecha_vencimiento"]; ?>">

                  </div> 
                </div> 

                <!--========v=============================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                   <input type="text" class="form-control"  name="editarVenta" value="<?php echo $venta["codigo"]; ?>" readonly>

                   <input type="text" class="form-control" id="editarVenta" name="editarVentaOtros" value="<?php echo $venta["detalle"]; ?>" readonly>

                   <?php

$id_venta=$venta['id'];

echo'

<input type="hidden" class="form-control" id="idventa" value="'.$id_venta.'" readonly>';
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

                    <option value="<?php echo $cliente["id"]; ?>"><?php echo $cliente["nombre"]; ?></option>

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
                   <input type="text" class="form-control" id="editarDescripcion" name="editarDescripcion" value="<?php echo $venta["descripcion"]; ?>" >

                  
                  
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">

                <?php

                $listaProducto = json_decode($venta["productos"], true);

                foreach ($listaProducto as $key => $value) {

                  $item = "id";
                  $valor = $value["id"];
                  $orden = "id";

                  $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                  $itemVenta = "id_producto";
                  $valorVenta = $value["id"];

                  $respuestaPrecioVenta = ControladorPreciosVentas::ctrMostrarPreciosVentasVarios($itemVenta, $valorVenta);

                  $stockAntiguo = $respuesta["stock"] + $value["cantidad"];

                  
               echo  '<div class="row" style="padding:2px 5px">

			  <!-- Descripción del producto -->
	          
	          <div class="col-xs-5" style="padding-right:0px">
	          
	            <div class="input-group">
	              
	              <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'.$value["id"].'"><i class="fa fa-times"></i></button></span>

	              <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'"   name="agregarProductoVentas" value="'.$value["descripcion"].'" readonly required>
	              <input type="text" class="form-control nuevoCodigoProducto" idProducto="'.$value["id"].'"   name="agregarProductoVentas" value="'.$value["codigo"].'" readonly required>

	            </div>

	          </div>

	          <!-- Cantidad del producto -->

	          <div class="col-xs-3">
	            
         <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto[]" min="1" value="'.$value["cantidad"].'" step="any" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>';
         
         $id_venta=$value['id']+1;
				 
				echo '<input type="text" class="form-control idVentaForaneo" idProducto="'.$value["id"].'" value="'.$venta['id'].'" readonly required>
				 
				 <input type="text" class="form-control idProductoForaneo" idProducto="'.$value["id"].'"  value="'.$value["id"].'" readonly required>

			  </div> 
			  
			  <!-- Precio del producto VENTA -->

            <div class="col-xs-3 ingresoPrecioVenta">';
            
            
               
          

            
            echo '
 
        <select class="form-control nuevoproductoventa" idProducto="'.$value["id"].'" name="nuevoproductoventa[]"  required>';


        
	 
             echo ' 
             <option value='.$value["precio"].'>'.$value["precio"].'</option>
             ';
             foreach ($respuestaPrecioVenta as $key => $valueVenta) {

             echo '<option value="'.$valueVenta["precio_venta"].'">'.$valueVenta["precio_venta"].'</option>';

            }
            echo ' </div>

	         
	          <!-- Precio del producto -->

	          <div class="col-xs-3 ingresoPrecio" style="padding-left:0px">

	            <div class="input-group">

	              
	                 
				  <input type="text" class="form-control nuevoPrecioProductoImpuesto" name="nuevoPrecioProductoImpuesto[]" value="'.$value["precioIva"].'" readonly required>
				  
	              
				  <input type="text" class="form-control nuevoImpuesto" value="'.$value["valorImpuesto"].'" name="nuevoImpuesto[]" readonly required>
				  
				  
				  <input type="text" class="form-control nuevoPrecioImpuestoAcumulado" name="nuevoImpuestoAcumulado[]" value="'.$value["impuestoTotal"].'" readonly required>
				  
	              <input type="text" class="form-control nuevoPrecioSinImpuesto" name="nuevoPrecioSinImpuesto[]" value="'.$value["precioSinIva"].'" readonly required>
				  <input type="text" class="form-control nuevoPrecioCompra" value="'.$value["precio_compra"].'" name="nuevoPrecioCompra"  readonly required>
				  
	              <input type="text" class="form-control nuevoPrecioUtilidadVenta" name="nuevoPrecioUtilidadVenta[]" value="'.$value["utilidadTotal"].'" readonly required>
	              <input type="text" class="form-control diferenciaUtilidad" name="diferenciaUtilidad[]" value="'.$value["utilidad"].'" readonly required>
	 
	           
			  </div>
	
		
			  </div>
			           
		        
	  ';
                
                }


                ?>

                

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
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

                               <input type="text"  class="form-control input-lg" min="0" name="nuevoPrecioSubtotal" id="nuevoPrecioSubtotal" totalsubtotal="" value="<?php echo $venta["neto"]; ?>" placeholder="0.00" readonly required>

                               <input+ type="hidden" name="totalSubtotal" id="totalSubtotal">
                               

                             
                        
                            </div>

                          </td>
                          
                          <td style="width: 22%">
                            
                            <div class="input-group">
                              
                          

                               <input type="text"  class="form-control input-lg" min="0" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" value="<?php echo $venta["impuesto"]; ?>" placeholder="0.00" readonly required>

                               

                             
                        
                            </div>

                          </td>

                          <td style="width: 22%">
                            
                            <div class="input-group">

                           
                           
                              <input type="number" class="form-control input-lg" min="0" id="nuevoDescuentoVenta"
                              step="any" name="nuevoDescuentoVenta" placeholder="0.00" value="<?php echo $venta["descuento"]; ?>" required>

                               <input type="hidden" name="nuevoPrecioDescuento" id="nuevoPrecioDescuento" required>

                             
                        
                            </div>

                          </td>



                           <td style="width: 40%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" value="<?php echo $venta["total"]; ?>" total="" placeholder="0.00" readonly required>

                              <input type="hidden" name="totalVenta" id="totalVenta">
                              
                        
                            </div>

                          </td>
                          
                          

                        </tr>

                        <tr>
                        <td style="width: 23%">
                            
                            <div class="input-group">
                           
                              
                              <input type="text" class="form-control input-lg" id="nuevoTotalUtilidadVenta" name="nuevoTotalUtilidadVenta" totalUtilidad="" value="<?php echo $venta["utilidad"]; ?>" readonly required>

                             
                              <input type="hidden" name="totalUtilidadVenta" id="totalUtilidadVenta">
                              
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>
                  
                  

                <hr>

                </div>

                
<!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

                <div class="form-group row">
                  
                  <div class="col-xs-5" style="padding-right:0px">
                    
                     <div class="input-group">
                  
                      <select class="form-control" id="nuevoFormaPagoVenta" name="nuevoFormaPagoVenta"  required>

                      <?php

                      
                      if ($venta["forma_pago"]!=0) {
                       $formapago="EFECTIVO";
                      }else {
                        $formapago="Credito por Cobar";
                      }
                      ?>
                       
                        <option value="value="<?php echo $venta["forma_pago"]; ?>"><?php echo $formapago; ?></option>
                        <option value="1">EFECTIVO</option>
                        <option value="0">Credito por Cobar</option>                 
                      </select>    

                    </div>

                  </div>

                  <div class="cajasFormaPagoVenta"></div>

                  <input type="hidden" id="listaFormaPagoVenta" name="listaFormaPagoVenta">

                </div>
                

          </div>
          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button>

          </div>

        </form>

        <?php

          $editarVenta = new ControladorVentas();
          $editarVenta -> ctrEditarVenta();
          
        ?>

        </div>
            
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

</div>
