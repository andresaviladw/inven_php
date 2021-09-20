<?php




?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar autoconsumos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar autoconsumos</li>
    
    </ol>

  </section>

  

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="crear-autoconsumo">

          <button class="btn btn-primary">
            
            Agregar autoconsumo

          </button>

        </a>

         <button type="button" class="btn btn-default pull-right" id="daterange-btn-autoconsumo">
           
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

  echo '<a href="vistas/modulos/descargar-reportes-autoconsumos.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

}else{

   echo '<a href="vistas/modulos/descargar-reportes-autoconsumos.php?reporte=reporte">';

}         

?>
   
   <button class="btn btn-success" style="margin-top:5px">Descargar reporte de autoconsumos en Excel</button>
  
  </a>



      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th>Código</th>
           <th>Responsable</th>
           <th>Descripcion</th>
           <th>Total</th> 
           <th>Fecha de emision</th> 
           <th>Fecha de creacion</th>
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

          $respuesta = ControladorAutoconsumos::ctrRangoFechasAutoconsumo($fechaInicial, $fechaFinal);

          foreach ($respuesta as $key => $value) {
           
           echo '<tr>

                  

                  <td>'.$value["codigo"].'</td>';

                 

                  $itemUsuario = "id";
                  $valorUsuario = $value["id_usuario"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>

                  <td>'.$value["descripcion"].'</td>
                  <td>$ '.number_format($value["total"],2).'</td>
                  <td>'.$value["fecha_emision"].'</td>
                  <td>'.$value["fecha_creacion"].'</td>
                  
        

                  <td>

                    <div class="btn-group">';


                      if($_SESSION["perfil"] == "Administrador"){

                        if ($value['estado']!=0) {
                          echo '<button class="btn btn-warning btnEditarAutoconsumo" idAutoconsumo="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';
                        }
                      

                      
                  if($value["estado"] !=0){

                    

                    echo '<td><button class="btn btn-success btn-xs  AutoconsumoAnular" idAutoconsumoHabilitarAnular="'.$value["id"].'" estadoAutoconsumoAnular="0">Aprobado</button></td>';

                  } else{
                    
                    echo '<td><button class="btn btn-danger btn-xs  AutoconsumoAprobar" idAutoconsumoHabilitarAprobar="'.$value["id"].'" estadoAutoconsumoAprobar="1">Anulado</button></td>';
                    
                
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
          
            $anularVenta= ControladorAutoconsumos::ctrAnularAutoconsumo();

            $aprobarVenta= ControladorAutoconsumos::ctrAprobarAutoconsumo();
        ?>       
      </div>

    </div>

  </section>

</div>




