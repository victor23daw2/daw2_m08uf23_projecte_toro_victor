<?php
require 'vendor/autoload.php';
session_start(); // Inici de sessió

use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

if (!isset($_SESSION['adm'])) {
  header("Location: ./index.php");
  exit;
}

ini_set('display_errors', 1);
#Dades de la nova entrada
#
$uid = $_POST['uid'];
$unorg = $_POST['unorg'];
$num_id = $_POST['num_id'];
$grup = $_POST['grup'];
$dir_pers = $_POST['dir_pers'];
$sh = $_POST['sh'];
$cn = $_POST['cn'];
$sn = $_POST['sn'];
$nom = $_POST['nom'];
$mobil = $_POST['mobil'];
$adressa = $_POST['adressa'];
$telefon = $_POST['telefon'];
$titol = $_POST['titol'];
$descripcio = $_POST['descripcio'];

$objcl = array('inetOrgPerson', 'organizationalPerson', 'person', 'posixAccount', 'shadowAccount', 'top');
#
#Afegint la nova entrada
$domini = 'dc=fjeclot,dc=net';
$opcions = [
  'host' => 'zend-vitoar.fjeclot.net',
  'username' => "cn=admin,$domini",
  'password' => 'fjeclot',
  'bindRequiresDn' => true,
  'accountDomainName' => 'fjeclot.net',
  'baseDn' => 'dc=fjeclot,dc=net',
];
$ldap = new Ldap($opcions);
$ldap->bind();
$nova_entrada = [];
Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
Attribute::setAttribute($nova_entrada, 'uid', $uid);
Attribute::setAttribute($nova_entrada, 'uidNumber', $num_id);
Attribute::setAttribute($nova_entrada, 'gidNumber', $grup);
Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir_pers);
Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
Attribute::setAttribute($nova_entrada, 'cn', $cn);
Attribute::setAttribute($nova_entrada, 'sn', $sn);
Attribute::setAttribute($nova_entrada, 'givenName', $nom);
Attribute::setAttribute($nova_entrada, 'mobile', $mobil);
Attribute::setAttribute($nova_entrada, 'postalAddress', $adressa);
Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telefon);
Attribute::setAttribute($nova_entrada, 'title', $titol);
Attribute::setAttribute($nova_entrada, 'description', $descripcio);
$dn = 'uid=' . $uid . ',ou=' . $unorg . ',dc=fjeclot,dc=net';

if ($ldap->add($dn, $nova_entrada)) {
  echo "Usuari creat";
  echo '<a href="https://zends-vitoar:443/projecte/menu.php">Torna al menú</a>';
} else {
  echo "Error al crear l'usuari";
  echo '<a href="https://zends-vitoar:443/projecte/menu.php">Torna al menú</a>';
}?>
<html>
  <head>
    <title>Crear</title>
    <link rel="stylesheet" type="text/css" href="css.css" />
  </head>
  <body>
    <h2>Crear</h2>
    <form
      action="https://zends-vitoar:443/projecte/afegeix.php"
      method="POST"
    >
      Unitat organitzativa: <input type="text" name="unorg" /><br />
      Usuari: <input type="text" name="uid" /><br />
      Numero d'identificacio: <input type="text" name="num_id" /><br />
      Grup: <input type="text" name="grup" /><br />
      Directori personal: <input type="text" name="dir_pers" /><br />
      Shell de inici de sessio: <input type="text" name="sh" /><br />
      Nom complet: <input type="text" name="cn" /><br />
      Cognom: <input type="text" name="sn" /><br />
      Nom: <input type="text" name="nom" /><br />
      Mobil: <input type="text" name="mobil" /><br />
      Adressa: <input type="text" name="adressa" /><br />
      Telefon: <input type="text" name="telefon" /><br />
      Titol: <input type="text" name="titol" /><br />
      Descripcio: <input type="text" name="descripcio" /><br />
      <input type="submit" value="Afegeix usuari" />
      <input type="reset" value="Netejar" />
    </form>
    <a href="https://zends-vitoar:443/projecte/menu.php"
      >Torna al menu</a
    >
  </body>
</html>