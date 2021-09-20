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
      
      Editar autoconsumo
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Editar autoconsumo</li>
    
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

          <form role="form" method="post" class="formularioAutoconsumo">

            <div class="box-body">
  
              <div class="box">

                
              <?php

              $item = "id";
              $valor = $_GET["idAutoconsumo"];

              $autoconsumos = ControladorAutoconsumos::ctrMostrarAutoconsumos($item, $valor);

              $itemUsuario = "id";
              $valorUsuario = $autoconsumos["id_usuario"];

              $responsable = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

          

              ?>

              <!--=====================================
              ENTRADA DEL RESPONSABLE
              ======================================-->

              <div class="form-group">

              <div class="input-group">



              <input type="hidden" class="form-control" id="editarResponsable" name="editarResponsable" value="<?php echo $responsable["nombre"]; ?>" readonly>

              <input type="hidden" name="idResponsable" value="<?php echo $responsable["id"]; ?>">

              </div>

              </div>  


                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 
                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                   <input type="text" class="form-control" id="editarAutoconsumo" name="editarAutoconsumo" value="<?php echo $autoconsumos["codigo"]; ?>" readonly>
               
                  </div>
                
                </div>

                
                <!--=====================================
                ENTRADA FECHA EMISION
                ======================================-->
            
                <div class="form-group col-xs-12">
                
                  <div class="input-group col-xs-3">
                      <label for="fecha_emision_autoconsumo">Fecha de Emision</label>
                      <input type="text" class="form-control" id="fecha_emision_autoconsumo" name="fecha_emision_autoconsumo" value="<?php echo $autoconsumos["fecha_emision"]; ?>">

                  </div> 
                </div> 

             
            <!--=====================================
                ENTRADA DESCRIPCION
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="editarDescripcion" name="editarDescripcion" placeholder="Descripcion" value="<?php echo $autoconsumos["descripcion"]; ?>" required>

                 

                  </div>

                </div> 


                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProductoAutoconsumo">

                <?php

$listaProducto = json_decode($autoconsumos["productos"], true);

foreach ($listaProducto as $key => $value) {

  $item = "id";
  $valor = $value["id"];
  $orden = "id";

  $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

  $stockAntiguo = $respuesta["stock"] - $value["cantidad"];
  
  echo'
  <div class="row" style="padding:5px 15px">

  <!-- Descripción del producto -->
  
  <div class="col-xs-5" style="padding-right:0px">
  
    <div class="input-group">
      
      <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProductoAutonconsumo" idProducto="'.$value["id"].'"><i class="fa fa-times"></i></button></span>
      

      <input type="text" class="form-control nuevaDescripcionProductoAutoconsumo" idProducto="'.$value["id"].'" value="'.$value["descripcion"].'" readonly required>
      <input type="text" class="form-control nuevoCodigoProductoAutoconsumo" idProducto="'.$value["id"].'" value="'.$value["codigo"].'" readonly required>

</div>

</div>


<!-- Cantidad del producto -->

<div class="col-xs-3">

<div class="input-group">
    
    <input type="number" class="form-control nuevaCantidadProductoAutoconsumo" min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" step="any" required
    

</div>
</div>
</div>

  

<!-- Precio del producto -->

  <div class="col-xs-3 ingresoPrecioAutoconsumo" style="padding-left:0px">

    <div class="input-group">

      <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
        
      <input type="text" class="form-control nuevoPrecioProductoAutoconsumo" precioReal="'.$respuesta["precio_compra"].'"  value="'.$value["total"].'" readonly required>
      


  </div>
    

</div>

<!-- Motivo autoproducto -->

                  <div class="col-xs-11 ingresoMotivo" style="padding-left:15px">
                  <div>
                          
                          
                        <input type="text" class="form-control nuevoMotivoAutoconsumo"  value="'.$value["motivo"].'" required>
                        

                      

                    </div>
                    </div>
</div>





';
}


?>

</div>
                


                <input type="hidden" id="listaProductosAutoconsumo" name="listaProductosAutoconsumo">

                <input type="hidden" name="idProducto" id="idProducto">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProductoAutonconsumo">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  AUTOCONSUMO TOTAL
                  ======================================-->
                  
                  <div class="col-xs-8 pull-right">
                    
                    <table class="table">

                      <thead>

                        <tr>
                        
                          <th>Total</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                          
                        

                          </td>

                           <td style="width: 33%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalAutoconsumo" name="nuevoTotalAutoconsumo" total="" value="<?php echo $autoconsumos["total"]; ?>" placeholder="00.00" readonly required>

                              <input type="hidden" name="totalAutoconsumo" id="totalAutoconsumo">
                              
                        
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

            <button type="submit" class="btn btn-primary pull-right">Guardar autoconsumo</button>

          </div>

        </form>

        <?php

          $editarAutoconsumo = new ControladorAutoconsumos();
          $editarAutoconsumo -> ctrEditarAutoconsumo();

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
            
            <table class="table table-bordered table-striped dt-responsive tablaAutoconsumos">
              
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
