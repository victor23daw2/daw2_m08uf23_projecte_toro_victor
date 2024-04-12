<?php
require 'vendor/autoload.php';
session_start(); // Inici de sessió

if (!isset($_SESSION['adm'])) {
	header("Location: ./index.php");
	exit;
}
?>

<html>

<head>
	<title>
		PÀGINA WEB DEL MENÚ PRINCIPAL DE L'APLICACIÓ D'ACCÉS A BASES DE DADES LDAP
	</title>

	<link rel="stylesheet" type="text/css" href="css.css">
</head>

<body>
	<h2> MENÚ PRINCIPAL DE L'APLICACIÓ D'ACCÉS A BASES DE DADES LDAP</h2>
	<a href="https://zends-vitoar:443/projecte/mostra.php">Consultar Usuari</a> <br>
	<a href="https://zends-vitoar:443/projecte/afegeix.php">Crear Usuari</a> <br>
	<a href="https://zends-vitoar:443/projecte/modifica.php">Editar Usuari</a> <br>
	<a href="https://zends-vitoar:443/projecte/esborra.php">Eliminar Usuari</a> <br>
	<a href="https://zends-vitoar:443/projecte/index.php">Torna a la pàgina inicial</a>
	<a href="https://zends-vitoar:443/projecte/login.php">Tanca la sessió</a>

	
</body>

</html>