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
      
      Crear entrada
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
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

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
               <!--      <span class="input-group-addon"><i class="fa fa-user"></i></span>  -->

                    <input type="hidden" class="form-control" id="nuevoResponsable" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idResponsable" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    

                    <?php

                    $item = null;
                    $valor = null;

                    $entradas = ControladorEntradas::ctrMostrarEntradas($item, $valor);

                    if(!$entradas){

                      echo '<input type="hidden" class="form-control" id="nuevaEntrada" name="nuevaEntrada" value="1" readonly>';
                      
                    }else{

                      foreach ($entradas as $key => $value) {
                        
                        
                      
                      }

                      $codigo = $value["codigo"] + 1;



                      echo '<input type="hidden" class="form-control" id="nuevaEntrada" name="nuevaEntrada" value="'.$codigo.'" readonly>';
                  

                    }

                    ?>
                    
                    
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA FECHA EMISION
                ======================================-->
            
                <div class="form-group col-xs-6">
                
                  <div class="input-group col-xs-6">
                      <label for="fecha_emision_entrada">Fecha de Emision</label>
                      <input type="text" class="form-control" id="fecha_emision_entrada" name="fecha_emision_entrada">

                  </div> 
                </div> 

                 <!--=====================================
                ENTRADA FECHA VENCIMIENTO
                ======================================-->
            
                <div class="form-group col-xs-6">
                
                  <div class="input-group col-xs-6">
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
              
              <span class="input-group-addon"><i class="fa fa-get-pocket"></i></span> 

              <select class="form-control" id="nuevoProveedor" name="nuevoProveedor" required>
                
                <option value="">Selecionar proveedor</option>

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
              
              <span class="input-group-addon"><i class="fa fa-get-pocket"></i></span> 

              <select class="form-control" id="nuevoComprobante" name="nuevoComprobante" required>
                
                <option value="">Selecionar comprobante</option>

                <?php

                $item = 'estado';
                $valor = 1;

                $comprobantes = ControladorComprobantes::ctrMostrarComprobantesHabilitados($item, $valor);

                foreach ($comprobantes as $key => $value) {
                  
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
              
             
  
                <input type="text" class="form-control" id="nuevoCodigoEstablecimiento" name="nuevoCodigoEstablecimiento" maxlength="3" placeholder="Establecimiento">

              </div>

            </div>
            <!-- ENTRADA PARA PUNTO DE EMISION -->
            <div class="col-xs-4">
              
              <div class="input-group">

  
                <input type="text" class="form-control" id="nuevoPuntoEmision" name="nuevoPuntoEmision" maxlength="3" placeholder="Punto de emision" >

              </div>

            </div>

            <!-- ENTRADA PARA SECUENCIA DE COMPROBANTE-->
            <div class="col-xs-4">
              
              <div class="input-group">
              

  
                <input type="text" class="form-control" id="nuevaSecuencia" name="nuevaSecuencia"
                placeholder="Secuencia" maxlength="9" required>

              </div>

             </div>

            </div>

            <!--=====================================
                ENTRADA DESCRIPCION
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevaDescripcion" name="nuevaDescripcion" placeholder="Descripcion" required>

                 

                  </div>

                </div> 



                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProductoEntrada">

                

                </div>

                <input type="hidden" id="listaProductosEntrada" name="listaProductosEntrada">

                <input type="hidden" name="idProducto" id="idProducto">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProductoEntrada">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-0 pull-right">
                    
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

                      
                              <input type="text" class="form-control input-lg" id="nuevoSubTotalEntrada" name="nuevoSubTotalEntrada" subtotal="" placeholder="00.00" readonly required>

                              
                              
                        
                            </div>

                          </td>
                          
                        <td style="width: 33%">
                            
                            <div class="input-group">
                           
                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoEntradaTotal"
                              step="any" name="nuevoImpuestoEntrada" placeholder="0" readonly required>

                               <input type="hidden" name="nuevoPrecioImpuestoEntrada" id="nuevoPrecioImpuestoEntrada" required>

                               <input type="hidden" name="nuevoPrecioNetoEntrada" id="nuevoPrecioNetoEntrada" required>

                        
                            </div>

                          </td>

                          </td>


                           <td style="width: 33%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="hidden" name="totalEntrada" id="totalEntrada" readonly>

                              <input type="text" class="form-control input-lg" id="nuevoTotalEntrada" name="nuevoTotalEntrada" total="" placeholder="00.00" readonly required>

                              
                              
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>
      
              <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

                <div class="form-group row">
                  
                  <div class="col-xs-5" style="padding-right:0px">
                    
                     <div class="input-group">
                  
                      <select class="form-control" id="nuevoFormaPagoEntrada" name="nuevoFormaPagoEntrada" required>
                        <option value="">Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Crédito</option>
                        <option value="TD">Tarjeta Débito</option>                  
                      </select>    

                    </div>

                  </div>

                  <div class="cajasFormaPagoEntrada"></div>

                  <input type="hidden" id="listaFormaPagoEntrada" name="listaFormaPagoEntrada">

                </div>

     

               
              </div>

          </div>


          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar entrada</button>

          </div>

        </form>

        <?php

          $guardarEntrada = new ControladorEntradas();
          $guardarEntrada -> ctrCrearEntrada();
          
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
