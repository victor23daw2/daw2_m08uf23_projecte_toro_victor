<?php 
session_start();
session_destroy();
?>
<html>

<head>
	<title>
		Login
	</title>
</head>

<body>
	<form action="https://zends-vitoar:443/projecte/auth.php" method="POST">
		Usuari amb permisos d'administració LDAP: <input type="text" name="adm"><br>
		Contrasenya de l'usuari: <input type="password" name="cts"><br>
		<input type="submit" value="Envia" />
		<input type="reset" value="Neteja" />
	</form>
</body>

</html>