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
      
      Crear autoconsumo
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear autoconsumo</li>
    
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

                <!--=====================================
                ENTRADA DEL RESPONSABLE
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    

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

                    $autoconsumos = ControladorAutoconsumos::ctrMostrarAutoconsumos($item, $valor);

                    if(!$autoconsumos){

                      echo '<input type="hidden" class="form-control" id="nuevoAutoconsumo" name="nuevoAutoconsumo" value="1" readonly>';
                      
                    }else{

                      foreach ($autoconsumos as $key => $value) {
                        
                        
                      
                      }

                      $codigo = $value["codigo"] + 1;



                      echo '<input type="hidden" class="form-control" id="nuevoAutoconsumo" name="nuevoAutoconsumo" value="'.$codigo.'" readonly>';
                  

                    }

                    ?>
                    
                    
                  </div>
                
                </div>

                
                <!--=====================================
                ENTRADA FECHA EMISION
                ======================================-->
            
                <div class="form-group col-xs-12">
                
                  <div class="input-group col-xs-3">
                      <label for="fecha_emision_autoconsumo">Fecha de Emision</label>
                      <input type="text" class="form-control" id="fecha_emision_autoconsumo" name="fecha_emision_autoconsumo">

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

                <div class="form-group row nuevoProductoAutoconsumo">
                
                

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

                              <input type="text" class="form-control input-lg" id="nuevoTotalAutoconsumo" name="nuevoTotalAutoconsumo" total="" placeholder="00.00" readonly required>

                              <input type="hidden" name="totalEntrada" id="totalEntrada">
                              
                        
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

          $guardarAutoconsumo = new ControladorAutoconsumos();
          $guardarAutoconsumo -> ctrCrearAutoconsumo();
          
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
