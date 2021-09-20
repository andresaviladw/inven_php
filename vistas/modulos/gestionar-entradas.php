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
      
      Administrar entradas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar entradas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="crear-entrada">

          <button class="btn btn-primary">
            
            Agregar entrada

          </button>

        </a>

        <button type="button" class="btn btn-default pull-right" id="daterange-btn-entradas">
           
           <span>
             <i class="fa fa-calendar"></i> 

             <?php

               if(isset($_GET["fechaInicial"])){

                 echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];
               
               }else{
                
                 echo 'Rango de fecha';

               }

             ?>
           </span>

           <i class="fa fa-caret-down"></i>

        </button>

      </div>

      <div class="box-tools pull-right">

      </div>

      <?php

        if(isset($_GET["fechaInicial"])){

          echo '<a href="vistas/modulos/descargar-reporte-entradas.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

        }else{

          echo '<a href="vistas/modulos/descargar-reporte-entradas.php?reporte=reporte">';

        }         

        ?>
          
          <button class="btn btn-success" style="margin-top:5px">Descargar reporte de entradas en Excel</button>
          
          </a>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
  
           <th>Código Entrada</th>
           <th>Responsable</th>
           <th>Proveedor</th>
           <th>Comprobante</th>
           <th># Comprobante</th>
           <th>Descripcion</th>
           <th>Neto</th> 
           <th>Impuesto</th> 
           <th>Total</th> 
           <th>Fecha</th>
           <th>Acciones</th>
           <th>Estado</th>

         </tr> 

        </thead>

        <tbody>

        <?php
     
     if(isset($_GET["fechaInicial"])){

      $fechaInicial = $_GET["fechaInicial"];
      $fechaFinal = $_GET["fechaFinal"];

    }else{

      $fechaInicial = null;
      $fechaFinal = null;

    }


          $respuesta = ControladorEntradas::ctrRangoFechasEntradas($fechaInicial, $fechaFinal);

          
          foreach ($respuesta as $key => $value) {
           
           echo '<tr>



                  <td>'.$value["codigo"].'</td>';

                  $itemUsuario = "id";
                  $valorUsuario = $value["id_responsable"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>';

                  $itemProveedor = "codigo";
                  $valorProveedor = $value["id_proveedor"];

                  $respuestaProveedor = ControladorProveedores::ctrMostrarProveedores($itemProveedor, $valorProveedor);

                  echo '<td>'.$respuestaProveedor["proveedor"].'</td>';

                  $itemComprobante = "id";
                  $valorComprobante = $value["id_comprobante"];

                  $respuestaComprobante = ControladorComprobantes::ctrMostrarComprobantes($itemComprobante, $valorComprobante);

                  echo '<td>'.$respuestaComprobante["codigo"].' '.$respuestaComprobante["nombre"].'</td>';


                  echo '<td>'.substr($value["comprobante"],0,3).'-'.substr($value["comprobante"],3,3).'-'.ltrim(substr($value["comprobante"],6,9),0).'</td>';

                  echo '<td>'.$value["descripcion"].'</td>';
                

              echo '
              <td>'.number_format($value["neto"],2).'</td>
                  <td>'.number_format($value["impuesto"],2).'</td>
                  <td>'.number_format($value["total_pagar"],4).'</td>

                  <td>'.$value["fecha_entrada"].'</td>

                  <td>
                  <div class="btn-group">

                      
                        
                  

                  </button>';

                  if($_SESSION["perfil"] == "Administrador"){
                    if($value["estado"] != 0){
                 echo  '<button class="btn btn-warning btnEditarEntrada" idEntrada="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';
                    }else {
                      echo '<button>Sin Accion</button>';
                    }
                    
                 if($value["estado"] != 0){

                  echo '<td><button class="btn btn-success btn-xs  EntradaAnular" idEntradaHabilitarAnular="'.$value["id"].'" estadoEntradaAnular="0">Aprobado</button></td>';

                }else{

                  echo '<td><button class="btn btn-danger btn-xs EntradaAprobar" idEntradaHabilitarAprobar="'.$value["id"].'" estadoEntradaAprobar="1">Anulado</button></td>';

                }

                }else {
                  echo '
                  <button>Sin Accion</button></td>';
                  echo '<td><button>Sin Estado</button></td>';
                }

                echo '</div>  


                </tr>';
            }

        ?>
               
        </tbody>

       </table>
       <?php
        $anularEntrada=ControladorEntradas::ctrAnularEntrada();

        $aprobarEntrada=ControladorEntradas::ctrAprobarEntrada();
       ?>

      </div>

    </div>

  </section>

</div>




