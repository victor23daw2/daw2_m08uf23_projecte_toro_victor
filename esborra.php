<?php
require 'vendor/autoload.php';
session_start(); // Inici de sessió

use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

if (!isset($_SESSION['adm'])) {
  header("Location: ./index.php");
  exit;
}

ini_set('display_errors', 0);

$uid = $_POST['uid'];
$unorg = $_POST['unorg'];
$dn = 'uid=' . $uid . ',ou=' . $unorg . ',dc=fjeclot,dc=net';
#
#Opcions de la connexió al servidor i base de dades LDAP
$opcions = [
  'host' => 'zend-vitoar.fjeclot.net',
  'username' => 'cn=admin,dc=fjeclot,dc=net',
  'password' => 'fjeclot',
  'bindRequiresDn' => true,
  'accountDomainName' => 'fjeclot.net',
  'baseDn' => 'dc=fjeclot,dc=net',
];
#
# Esborrant l'entrada
#
$ldap = new Ldap($opcions);
$ldap->bind();
try {
  $ldap->delete($dn);
  echo "<b>Entrada esborrada</b><br>";
  echo '<a href="https://zends-vitoar:443/projecte/menu.php">Torna al menú</a>';
} catch (Exception $e) {
  echo "<b>Aquesta entrada no existeix</b><br>";
  echo '<a href="https://zends-vitoar:443/projecte/menu.php">Torna al menú</a>';
}?>
<html>
  <head>
    <title>Esborra</title>
    <link rel="stylesheet" type="text/css" href="css.css" />
  </head>
  <body>
    <h2>Esborrar</h2>
    <form
      action="/projecte/esborra.php"
      method="POST">
      Unitat organitzativa: <input type="text" name="unorg" /><br />
      Usuari: <input type="text" name="uid" /><br />
      <input type="submit" value="Esborrar usuari" />
      <input type="reset" value="Netejar" />
    </form>
    <a href="https://zends-vitoar:443/projecte/menu.php">Torna al menu</a>
  </body>
</html>