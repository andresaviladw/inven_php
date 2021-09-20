
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar ventas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar ventas</li>
    
    </ol>

  </section>

  

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="crear-venta">

          <button class="btn btn-primary">
            
            Agregar venta

          </button>

        </a>

         <button type="button" class="btn btn-default pull-right" id="daterange-btn">
           
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

  echo '<a href="vistas/modulos/descargar-reporte-ventas.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

}else{

   echo '<a href="vistas/modulos/descargar-reporte-ventas.php?reporte=reporte">';

}         

?>
   
   <button class="btn btn-success" style="margin-top:5px">Descargar reporte de ventas en Excel</button>
  
  </a>



      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th>Código factura</th>
           <th>Cliente</th>
           <th>Vendedor</th>        
           <th>Sub Total</th>
           <th>Impuesto</th>
           <th>Descuento</th>
           <th>Total</th> 
           <th>Utilidad</th> 
           <th>Fecha de Creacion</th>
           <th>Fecha de emision</th>
           <th>Fecha de vencimiento</th>
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

          $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

          foreach ($respuesta as $key => $value) {
           
           echo '<tr>

                  

                  <td>'.ltrim(substr($value["codigo"],0,9),0).'</td>';

                  $itemCliente = "id";
                  $valorCliente = $value["id_cliente"];

                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  echo '<td>'.$respuestaCliente["nombre"].'</td>';

                  $itemUsuario = "id";
                  $valorUsuario = $value["id_vendedor"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>';

                  

                  

                  $productos=  json_decode($value["productos"], true);

                

                  
              
                  

                 echo ' <td>'.number_format($value["neto"],2).'</td>
                  <td>'.number_format($value["impuesto"],2).'</td>
                  <td>'.number_format($value["descuento"],2).'</td>
                  <td>'.number_format($value["total"],2).'</td>
                  <td>'.number_format($value["utilidad"],2).'</td>

                  <td>'.$value["fecha_creacion"].'</td>
                  <td>'.$value["fecha_emision"].'</td>
                  <td>'.$value["fecha_vencimiento"].'</td>
                
                  
                  ';

                  

                 echo '<td>

                    <div class="btn-group">

                      
                        
                      <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'">

                        <i class="fa fa-print"></i>

                      </button>';

                      if($_SESSION["perfil"] == "Administrador"){

                        if ($value['estado']!=0) {
                          echo '<button class="btn btn-warning btnEditarVenta" idVenta="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';
                        }
                      

                      
                  if($value["estado"] !=0){

                    

                    echo '<td><button class="btn btn-success btn-xs  VentaAnular" idVentaHabilitarAnular="'.$value["id"].'" estadoVentaAnular="0">Aprobado</button></td>';

                  } else{
                    
                    echo '<td><button class="btn btn-danger btn-xs  VentaAprobar" idVentaHabilitarAprobar="'.$value["id"].'" estadoVentaAprobar="1">Anulado</button></td>';
                    
                
                    }
                      
                     
                    
                  }
                  
                } 
              
              
              
              echo '</div>  
              
              </td>
              
              </tr>';
              
              
              ?>
               
        </tbody>

       </table>
           <?php
          
            $anularVenta= ControladorVentas::ctrAnularVenta();

            $aprobarVenta= ControladorVentas::ctrAprobarVenta();
        ?>       
      </div>

    </div>

  </section>

</div>




