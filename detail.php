<?php 
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

session_start();
	echo "<!DOCTYPE html>";
	echo "<html lang='en'>";
		include 'database_connection.php';
		include 'functions.php';
		include 'head.php';
		echo "<body>";
			include 'header.php';
			if (isset($_SESSION['s_usuario'])){
				if (isset($_REQUEST['id_articulo']) && empty($_REQUEST['id_foto'])){
					$id_articulo=$_REQUEST['id_articulo'];
					$id_subcategoria="";
					$cond="SELECT id_categoria FROM cms_articulo WHERE id_articulo=$id_articulo"; 
					$result = mysqli_query($link, $cond);
					while($row = mysqli_fetch_assoc($result)){
						$id_subcategoria=$row['id_categoria'];
					}
					$i="i";
					echo "<nav>";
						echo "<ul>";
							echo "<li><a href='main.php?inicio=".$i."'>INICIO</a></li>";
							echo "<li><a href='main.php?id_subcategoria=$id_subcategoria'>ATRAS</a></li>";
						echo "</ul>";
					echo "</nav>";
					echo "<div class='titulo'>";
						$cond="SELECT nombre from cms_articulo where id_articulo=$id_articulo";
						$result = mysqli_query($link, $cond);
						while($row = mysqli_fetch_assoc($result)){
							echo $row['nombre'];
						}
					echo "</div>";
					echo "<div class='general_foto'>";
						mostrar("cms_articulo", "id_articulo", "id_articulo", $id_articulo, "descripcion");
						echo "<div class='seccion_fotos'>";
							$cond="SELECT * from cms_foto where id_articulo=$id_articulo";
							$result = mysqli_query($link, $cond);
							while($row = mysqli_fetch_assoc($result)){
								echo "<div class='foto'>";
									echo "<a href='detail.php?foto=".$row['id_foto']."'><img src='./img/".$row['foto']."' style='width: 100%'></a>";
								echo "</div>";
							}
						echo "</div>";
					echo "</div>";
					echo "<div class='seccion_enlaces'>";	
						$cond="SELECT * from cms_links where id_articulo=$id_articulo";
						$result = mysqli_query($link, $cond);
						echo "<hr>";
						while($row = mysqli_fetch_assoc($result)){
							echo "<div class='enlaces'>";
								echo "<a target='_blank' href='".$row['vinculo']."' >".$row['texto']."</a>";
							echo "</div>";
							echo "<hr>";
						}
					echo "</div>";
				}
				elseif (isset($_REQUEST['foto'])){
					$id_foto=$_REQUEST['foto'];
					$cond="SELECT id_articulo from cms_foto where id_foto=$id_foto";
					$result = mysqli_query($link, $cond);
					$i="i";
					echo "<nav>";
						echo "<ul>";
							echo "<li><a href='main.php?inicio=".$i."'>INICIO</a></li>";
							while ($row=mysqli_fetch_assoc($result)){
								echo "<li><a href='detail.php?id_articulo=".$row['id_articulo']."'>ATRAS</a></li>";
							}
						echo "</ul>";
					echo "</nav>";
					$cond="SELECT descripcion, foto from cms_foto where id_foto=$id_foto";
					$result = mysqli_query($link, $cond);
					echo "<div class='container_foto'>";
						while($row = mysqli_fetch_assoc($result)){
							echo "<div class='foto_individual'>";
								echo "<img src='./img/".$row['foto']."' style='width: 100%'>";
							echo "</div>";
							echo "<div class='foto_descripcion'>";
								echo $row['descripcion'];
							echo "</div>";
						}
					echo "</div>";
				}
			}
			header("Location: index.php");
		echo "</body>";
		include 'scripts.php';
	echo "</html>";
?>