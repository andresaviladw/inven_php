<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

		<?php

		if($_SESSION["perfil"] == "Especial"){

			echo '<li class="active">

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			</li>

		';

		}
		if($_SESSION["perfil"] == "Administrador"){

			echo '

			<li>

				<a href="usuarios">

					<i class="fa fa-user"></i>
					<span>Usuarios</span>

				</a>

			</li>';

		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){


			echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-th-large"></i>
					
					<span>Categorias</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="categorias">
							
							<i class="fa fa-check-circle-o"></i>
							<span>Categorias</span>

						</a>

					</li>

					<li>

						<a href="subcategorias">
							
							<i class="fa fa-check-circle-o"></i>
							<span>Sub Categorias</span>

						</a>

					</li>';

					

				

				echo '</ul>

			</li>';
			echo '

			<li>

				<a href="proveedores">

					<i class="fa fa-get-pocket"></i>
					<span>Proveedores</span>

				</a>

			</li>

			';
			echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-product-hunt"></i>
					
					<span>Productos</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>
				
				<ul class="treeview-menu">
					
					<li>

						<a href="productos">
							
							<i class="fa fa-check-circle-o"></i>
							<span>Gestionar productos</span>

						</a>

					</li>
					
					<li>

					<a href="crear-entrada">
						
						<i class="fa fa-check-circle-o"></i>
						<span>Ingresar productos</span>

					</a>

				</li>
					<li>

					<a href="importar-entradas">
						
						<i class="fa fa-check-circle-o"></i>
						<span>Importar desde excel</span>

					</a>

				</li>
					<li>

					<a href="impuestos">
						
						<i class="fa fa-check-circle-o"></i>
						<span>Gestion de Impuestos</span>

					</a>

				</li>
					<li>

					<a href="preciosventas">
						
						<i class="fa fa-check-circle-o"></i>
						<span>Precios de Venta</span>

					</a>

				</li>

				<li>

					<a href="gestionar-entradas">
						
						<i class="fa fa-check-circle-o"></i>
						<span>Gestionar Entradas</span>

					</a>

				</li>
			
				
				
			
				
			
			</ul>';
				

			
			echo '

				

			</li>';

		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){

			echo '<li>

				<a href="clientes">

					<i class="fa fa-users"></i>
					<span>Clientes</span>

				</a></li>';

		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){

			echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>
					
					<span>Ventas</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="ventas">
							
							<i class="fa fa-circle-o"></i>
							<span>Administrar ventas</span>

						</a>

					</li>

					<li>

						<a href="crear-venta">
							
							<i class="fa fa-circle-o"></i>
							<span>Crear venta</span>

						</a>

					</li>

					<li>

						<a href="autoconsumos">
							
							<i class="fa fa-circle-o"></i>
							<span>Autoconsumos</span>

						</a>

					</li>
					<li>

						<a href="crear-autoconsumo">
							
							<i class="fa fa-circle-o"></i>
							<span>Crear Autoconsumo</span>

						</a>

					</li>';
					

					

				

				echo '</ul>

			</li>';

		}

		?>

		</ul>

	 </section>

</aside>