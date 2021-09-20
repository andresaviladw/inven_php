<?php

class ControladorProveedores
{
    
	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCrearProveedor(){

		if(isset($_POST["nuevoIdDocumento"])){

			if(preg_match('/^[0-9]+$/', $_POST["nuevoIdDocumento"]) &&
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoProveedor"]) &&
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDireccion"])  &&
            preg_match('/^[0-9]+$/', $_POST["nuevoTelefono"]) &&
            preg_match('/^[0-9]+$/', $_POST["nuevoCelular"]) &&
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreReferencia"]) &&
            preg_match('/^[0-9]+$/', $_POST["nuevoMovilReferencia"])){
                $tabla = "proveedores";


                $datos = array("tipoDocumento" => trim($_POST["tipoDocumentoProveedor"]),
                "documentoId" => trim($_POST["nuevoIdDocumento"]),
                               
                                "codigo"=>trim($_POST["nuevoCodigoProveedor"]),
                                "proveedor"=>trim( $_POST["nuevoProveedor"]),
					           "direccion" => trim(ucwords($_POST['nuevaDireccion'])),
                               "telefono" => trim($_POST["nuevoTelefono"]),
                               "celular" => trim($_POST["nuevoCelular"]),
                               "email" => trim($_POST["nuevoEmail"]),
                               "nombre_referencia" => trim(ucwords($_POST["nuevoNombreReferencia"])),
                               "movil_referencia" => trim($_POST["nuevoMovilReferencia"]),);

                               var_dump($datos);

                $respuesta = ModeloProveedor::mdlIngresarProveedor($tabla, $datos);
                
                var_dump($respuesta);
			
				/*if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El proveedor ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "proveedores";

						}

					});
				

					</script>';


				}else{

                    echo '<script>
    
                        swal({
    
                            type: "error",
                            title: "¡Error al guardar!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
    
                        }).then(function(result){
    
                            if(result.value){
                            
                                window.location = "proveedores";
    
                            }
    
                        });
                    
    
                    </script>';
    
                }	
 */

            }else{

				echo '<script>

					swal({

						type: "error",
						title: "¡Error al guardar por que los campos no pueden ir vacios o llevar caracteres especiales, los campos telefono y celular son numericos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "proveedores";

						}

					});
				

				</script>';

			}
			   }

				


		}
/**
	 * METODO PARA MOSTRAR PROVEEDORES 
	 */

    static public function ctrMostrarProveedores($item,$valor)
    {
       $tabla='proveedores';

        $respuesta=ModeloProveedor::mdlMostrarProveedores($tabla,$item,$valor);
        
        return $respuesta;
    }
/**
	 * METODO PARA MOSTRAR PROVEEDORES HABILITADOS 
	 */

    static public function ctrMostrarProveedoresHabilitados($item,$valor)
    {
       $tabla='proveedores';

        $respuesta=ModeloProveedor::mdlMostrarProveedoresHabilitados($tabla,$item,$valor);
        
        return $respuesta;
    }



    /**
     * EDITAR PROVEEDOR
     */
   static public function ctrEditarProveedor()
   {
      if (isset($_POST['editarProveedor'])) {
       if(
       preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarProveedor"]) &&
       preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDireccion"])  &&
       preg_match('/^[0-9]+$/', $_POST["editarTelefono"]) &&
       preg_match('/^[0-9]+$/', $_POST["editarCelular"]) &&
       preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNuevaReferencia"]) &&
       preg_match('/^[0-9]+$/', $_POST["editarMovilReferencia"]) ){

           $tabla = "proveedores";

           $datos = array("tipoDocumento" =>trim($_POST["tipoDocumentoProveedorEditar"]),
            "documentoId" =>trim($_POST["editarIdDocumento"]),
           'id'=>trim($_POST['idProveedor']),
           'codigo'=>trim($_POST['editarCodigoProveedor']),
                               
                                "proveedor" => trim(ucwords($_POST["editarProveedor"])),
					           "direccion" => trim(ucwords($_POST['editarDireccion'])),
                               "telefono" => trim($_POST["editarTelefono"]),
                               "celular" => trim($_POST["editarCelular"]),
                               "email" => trim($_POST["editarEmail"]),
                               "nombre_referencia" => trim(ucwords($_POST["editarNuevaReferencia"])),
                               "movil_referencia" => trim($_POST["editarMovilReferencia"]));

                              
          
           $respuesta = ModeloProveedor::mdlEditarProveedor($tabla, $datos);


           if ($respuesta=='ok') {
               echo'<script>

                   swal({
                         type: "success",
                         title: "El proveedor ha sido cambiado correctamente",
                         showConfirmButton: true,
                         confirmButtonText: "Cerrar"
                         }).then(function(result){
                                   if (result.value) {

                                   window.location = "proveedores";

                                   }
                               })

                   </script>';
           }else {
            echo'<script>

                swal({
                      type: "error",
                      title: "¡ El proveedor no ha sido guardado!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                        if (result.value) {

                        window.location = "proveedores";

                        }
                    })

              </script>';
        }

       }else {
            echo'<script>

                swal({
                      type: "error",
                      title: "¡ Los cambios no se han guardado por que los campos no pueden ir vacios o llevar caracteres especiales, los campos telefono y celular son numericos !",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                        if (result.value) {

                        window.location = "proveedores";

                        }
                    })

              </script>';
        }
      }
   } 

}


	
	