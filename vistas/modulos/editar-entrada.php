<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Editar entrada
    
    </h1>

    <ol class="breadcrumb">
       
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear entrada</li>
    
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

          <form role="form" method="post" class="formularioEntrada">

            <div class="box-body">
  
              <div class="box">

                <?php

                    $item = "id";
                    $valor = $_GET["idEntrada"];

                    $entrada = ControladorEntradas::ctrMostrarEntradas($item, $valor);

                    $itemUsuario = "id";
                    $valorUsuario = $entrada["id_responsable"];

                    $responsable = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                    $porcentajeImpuestoEntrada = $entrada["impuesto"] * 100 / $entrada["neto"];


                ?>

                <!--=====================================
                ENTRADA DEL RESPONSABLE
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                

                    <input type="hidden" class="form-control" id="nuevoResponsable" value="<?php echo $responsable["nombre"]; ?>" readonly>

                    <input type="hidden" name="idResponsable" value="<?php echo $responsable["id"]; ?>">

                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                

                   <input type="hidden" class="form-control" id="nuevaEntrada" name="editarEntrada" value="<?php echo $entrada["codigo"]; ?>" readonly>
               
                  </div>
                
                </div>

                   <!--=====================================
                ENTRADA FECHA EMISION
                ======================================-->
            
                <div class="form-group col-xs-6">
                
                  <div class="input-group col-xs-12">
                      <label for="fecha_emision_entrada">Fecha de Emision</label>
                      <input type="text" class="form-control" id="fecha_emision_entrada" name="fecha_emision_entrada">

                  </div> 
                </div> 

                 <!--=====================================
                ENTRADA FECHA VENCIMIENTO
                ======================================-->
            
                <div class="form-group col-xs-6">
                
                  <div class="input-group col-xs-12">
                      <label for="fecha_vencimiento_entrada">Fecha de vencimiento</label>
                      <input type="text" class="form-control" id="fecha_vencimiento_entrada"
                      name="fecha_vencimiento_entrada">

                  </div> 
                </div> 

                <!--=====================================
                ENTRADA DEL PROVEEDOR
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <?php

                      $item = 'codigo';
                      $valor = $entrada['id_proveedor'];

                      $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                     

                      ?>
                   
                <select class="form-control"  name="editarProveedor" required>
                  
                  <option id="nuevoProveedor" value="<?php echo $proveedores["codigo"]?>"><?php echo $proveedores["proveedor"]?></option>

                  <?php

                  $item = 'estado';
                  $valor = 1;

                  $proveedores = ControladorProveedores::ctrMostrarProveedoresHabilitados($item, $valor);

                  foreach ($proveedores as $key => $value) {
                    
                    echo '<option value="'.$value["codigo"].'">'.$value["proveedor"].'</option>';
                  }

                  ?>
  
                </select>
               
                  </div>
                
                </div>



                
                <!--=====================================
                ENTRADA DEL COMPROBANTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <?php

                      $item = 'id';
                      $valor = $entrada['id_comprobante'];

                      $comprobante = ControladorComprobantes::ctrMostrarComprobantes($item, $valor);

                     

                      ?>
                   
                <select class="form-control"  name="editarComprobante" required>
                  
                  <option id="nuevoComprobante" value="<?php echo $comprobante["id"]?>"><?php echo $comprobante["codigo"].' '.$comprobante["nombre"]?></option>

                  <?php

                  $item = 'estado';
                  $valor = 1;

                  $comprobante = ControladorComprobantes::ctrMostrarComprobantesHabilitados($item, $valor);

                  foreach ($comprobante as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["codigo"].' '.$value["nombre"].'</option>';
                  }

                  ?>
  
                </select>
               
                  </div>
                
                </div>


                 <!-- ENTRADA PARA CODIGO ESTABLECIMIENTO -->

            <div class="form-group row">
            <div class="col-xs-4">
              
              <div class="input-group">
              
             
  
                <input type="text" class="form-control" id="nuevoCodigoEstablecimiento" name="editarCodigoEstablecimiento"
                value="<?php echo substr($entrada["comprobante"],0,3); ?>"  maxlength="3" placeholder="Establecimiento" required>

              </div>

            </div>
            <!-- ENTRADA PARA PUNTO DE EMISION -->
            <div class="col-xs-4">
              
              <div class="input-group">

  
                <input type="text" class="form-control" id="nuevoPuntoEmision" name="editarPuntoEmision" maxlength="3" value="<?php echo substr($entrada["comprobante"],3,3); ?>"placeholder="Punto de emision" required>

              </div>

            </div>

            <!-- ENTRADA PARA SECUENCIA DE COMPROBANTE-->
            <div class="col-xs-4">
              
              <div class="input-group">
              

  
                <input type="text" class="form-control" id="nuevaSecuencia" name="editarSecuencia"
                placeholder="Secuencia" maxlength="9" value="<?php echo ltrim(substr($entrada["comprobante"],6,9),0); ?>"required>


              </div>

             </div>

            </div>

             <!--=====================================
                ENTRADA DESCRIPCION
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevaDescripcion" name="editarDescripcion" value="<?php echo $entrada["descripcion"]; ?>"placeholder="Descripcion" required>

                 

                  </div>

                </div> 



                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProductoEntrada">

                <?php

                $listaProducto = json_decode($entrada["productos"], true);

                foreach ($listaProducto as $key => $value) {

                  $item = "codigo";
                  $valor = $value["codigo"];
                  $orden = "id";

                  $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                  $stockAntiguo = $respuesta["stock"] + $value["cantidad"];
                  
                  echo '<div class="row" style="padding:5px 15px">
            
                        <div class="col-xs-6" style="padding-right:0px">
            
                          <div class="input-group">
                
                            <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProductoEntrada" idProducto="'.$value["codigo"].'"><i class="fa fa-times"></i></button></span>

                            <input type="text" class="form-control nuevaDescripcionProductoEntrada" idProducto="'.$value["codigo"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly required>
                            
                            <input type="hidden" class="form-control nuevaIdProductoEntrada" idProducto="'.$value["codigo"].'" name="agregarProducto" value="'.$value["id"].'" readonly required>

                          </div>

                        </div>

                        <div class="col-xs-3">
              
                          <input type="number" class="form-control nuevaCantidadProductoEntrada" name="nuevaCantidadProductoEntrada" min="1" value="'.$value["cantidad"].'" step="any" stock="'.$stockAntiguo.'" required>

                        </div>

                        <div class="col-xs-3 ingresoPrecioEntrada" style="padding-left:0px">

                          <div class="input-group">

                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                   
                            <input type="text" class="form-control nuevoPrecioProductoEntrada" precioReal="'.$respuesta["precio_compra"].'" name="nuevoPrecioProductoEntrada" value="'.$value["total"].'" readonly required>

                            <input type="hidden" class="form-control impuestoValorAsignado" id="impuestoValor" value="'.$value["valorImpuesto"].'"  readonly required>

                            <input type="hidden" class="form-control nuevoPrecioReal" name="nuevoPrecioReal" value="'.$respuesta["precio_compra"].'" readonly required>

                            <input type="hidden" class="form-control nuevoImpuestoEntrada" id="impuestoentrada" value="'.$value["impuesto"].'" name="nuevoImpuestoEntrada[]" readonly required>

                            <input type="hidden" class="form-control nuevoImpuestoAcumuladoEntrada" value="'.$value["impuestoTotal"].'"  name="nuevoImpuestoAcumuladoEntrada[]" id="impuestoentradaAcumulado" readonly required>
   
                          </div>
               
                        
                        </div>

                      </div>';
                }


                ?>

                </div>

                <input type="hidden" id="listaProductosEntrada" name="listaProductosEntrada">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProductoEntrada">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA  TOTAL
                  ======================================-->
                  
                  <div class="col-xs- pull-right">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Subtotal</th>      
                          <th>Impuesto</th>      
                          <th>Total</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                        <td style="width: 33%">
                            
                            <div class="input-group">

                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                           
                              

                              <input type="text" class="form-control input-lg" id="nuevoSubTotalEntrada" name="nuevoSubTotalEntrada" subtotal="" value="<?php echo $entrada["neto"]; ?>" placeholder="00.00" readonly required>

                        
                            </div>

                          </td>
                          <td style="width: 33%">
                            
                            <div class="input-group">
                           
                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoEntradaTotal"
                              step="any" value="<?php echo $entrada["impuesto"]; ?>" name="nuevoImpuestoEntrada" placeholder="0" readonly required>

                               <input type="hidden" name="nuevoPrecioImpuestoEntrada" id="nuevoPrecioImpuestoEntrada" required>

                               <input type="hidden" name="nuevoPrecioNetoEntrada" id="nuevoPrecioNetoEntrada" required>

                        
                            </div>

                          </td>

                          </td>


                          <td style="width: 33%">
                          
                          <div class="input-group">

                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                            <input type="hidden" name="totalEntrada" id="totalEntrada" readonly>

                            <input type="text" class="form-control input-lg" id="nuevoTotalEntrada" name="nuevoTotalEntrada" total="" value="<?php echo $entrada["total_pagar"]; ?>" placeholder="00.00" readonly required>

                            
                            

                          </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>


              </div>

          </div>
                

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button>

          </div>

        </form>

        <?php

          $editarEntrada = new ControladorEntradas();
          $editarEntrada -> ctrEditarEntrada();
          
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
            
            <table class="table table-bordered table-striped dt-responsive tablaEntradas">
              
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
</form>
</div>

</div>

</div>
