<?php
session_start();
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
/*--Este codigo es propiedad intelectual de Iván Córdoba Donet ivancordoba77@gmail.com--*/
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
/*--Conexion con la base de datos--------------------------------------------------------------------------*/
	include 'inicio_conjunto.php';
/*--Ficher de funciones------------------------------------------------------------------------------------*/
	include 'funciones.php';
/*--META, TITLE, LINKS-------------------------------------------------------------------------------------*/
	include 'head.php';
/*--BODY---------------------------------------------------------------------------------------------------*/
	echo "<body>";
/*--CABECERA-----------------------------------------------------------------------------------------------*/
		include 'header.php';
		if (isset($_SESSION['s_usuario'])){
			if (isset($_REQUEST['inicio'])){
				unset($_SESSION['id_cat']);
				unset($_SESSION['id_subcat']);
			}
			if (isset($_REQUEST['id_categoria'])){
				$id_categoria=$_REQUEST['id_categoria'];
				unset($_SESSION['id_subcat']);
				$_SESSION['id_cat']=$id_categoria;
			}
			if (isset($_REQUEST['id_subcategoria'])){
				$id_subcategoria=$_REQUEST['id_subcategoria'];
				$_SESSION['id_subcat']=$id_subcategoria;
			}
			echo "<nav>";
				echo "<ul>";
					mostrar("cms_categoria", "id_categoria", "id_categoria_padre", 0, "nombre");
				echo "</ul>";
			echo "</nav>";
			if (isset($_SESSION['id_cat'])){	
				echo "<div class='seccion_subcategorias'>";
					mostrar("cms_categoria", "id_categoria", "id_categoria_padre", $_SESSION['id_cat'], "nombre");
				echo "</div>";
				mostrar("cms_articulo", "id_articulo", "id_categoria", $_SESSION['id_cat'], "nombre");
			}
			if (isset($_SESSION['id_subcat'])){
				echo "<div class='seccion_subcategorias'>";
					mostrar("cms_categoria", "id_categoria", "id_categoria_padre", $_SESSION['id_subcat'], "nombre");
				echo "</div>";
				echo "<div class='general_foto'>";
					mostrar("cms_articulo", "id_articulo", "id_categoria", $_SESSION['id_subcat'], "nombre");
				echo "</div>";
			}
		}
		else{
			echo "<div class='formulario_inicio_sesion'>";
				echo "Usuario incorrecto <br>";
				echo "<a href='index.php'>volver a intentarlo</a>";
			echo "</div>";
		}
	echo "</body>";
echo "</html>";
?>