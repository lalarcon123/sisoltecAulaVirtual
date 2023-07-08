<?php

  define( 'DB_HOST', 'localhost');          // Set database host '67.20.76.56'
  define( 'DB_USER', 'root' );             // Set database user
  define( 'DB_PASS', '' );             // Set database password
  define( 'DB_NAME', 'sisoltecaulavirtual' );        // Set database name

$con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$con){
    @die("<h2 style='text-align:center'>Imposible conectarse a la base de datos! </h2>".mysqli_error($con));
}
if (@mysqli_connect_errno()) {
    @die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
}
$con->set_charset("utf8");

?>
