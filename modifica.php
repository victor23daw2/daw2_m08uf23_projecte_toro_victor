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
#
# Atribut a modificar --> Número d'idenficador d'usuari
#
$atribut = $_POST['radioValue']; # El número identificador d'usuar té el nom d'atribut uidNumber
$nou_contingut = $_POST['nouContingut'];
#
# Entrada a modificar
#
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
# Modificant l'entrada
#
$ldap = new Ldap($opcions);
$ldap->bind();
$entrada = $ldap->getEntry($dn);
if ($entrada) {
  Attribute::setAttribute($entrada, $atribut, $nou_contingut);
  $ldap->update($dn, $entrada);
  echo "Atribut modificat";
  echo '<a href="https://zends-vitoar:443/projecte/menu.php">Torna al menú</a>';
} else {
  echo "<b>Aquesta entrada no existeix</b><br><br>";
  echo '<a href="https://zends-vitoar:443/projecte/menu.php">Torna al menú</a>';
}?>
<html>
  <head>
    <title>Editar</title>
    <link rel="stylesheet" type="text/css" href="css.css" />
  </head>
  <body>
    <h2>Editar</h2>
    <form
      action="https://zends-vitoar:443/projecte/modifica.php"
      method="POST"
    >
      Unitat organitzativa: <input type="text" name="unorg" /><br />
      Usuari: <input type="text" name="uid" /><br /><br />
      Escull una opcio: <br />

      <input type="radio" name="radioValue" value="uidNumber" /><span
        >Numero d'identificacio</span
      ><br />
      <input type="radio" name="radioValue" value="gidNumber" /><span>Grup</span
      ><br />
      <input type="radio" name="radioValue" value="homeDirectory" /><span
        >Directori Personal</span
      ><br />
      <input type="radio" name="radioValue" value="loginShell" /><span
        >Shell</span
      ><br />
      <input type="radio" name="radioValue" value="cn" /><span>Nom complet</span
      ><br />
      <input type="radio" name="radioValue" value="sn" /><span>Cognom</span
      ><br />
      <input type="radio" name="radioValue" value="givenName" /><span>Nom</span
      ><br />
      <input type="radio" name="radioValue" value="postalAddress" /><span
        >Adressa</span
      ><br />
      <input type="radio" name="radioValue" value="mobile" /><span>Mobil</span
      ><br />
      <input type="radio" name="radioValue" value="telephoneNumber" /><span
        >Telefon</span
      ><br />
      <input type="radio" name="radioValue" value="title" /><span>Titol</span
      ><br />
      <input type="radio" name="radioValue" value="description" /><span
        >Descripcio</span
      ><br /><br />
      <input
        type="text"
        name="nouContingut"
        placeholder="Contigut a modificar"
      /><br /><br />
      <input type="submit" value="Editar usuari" />
      <input type="reset" value="Netejar" />
    </form>
    <a href="https://zends-vitoar:443/projecte/menu.php"
      >Torna al menu</a
    >
  </body>
</html>