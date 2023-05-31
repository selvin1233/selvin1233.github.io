<?php 

define("CLIENT_ID", "AVPI1TmjQoFMRrzf9PwQJZOmjYXke3fXtFTDYmVzU_RMLAU4CjdA35qvhSCJTvspz-XZXlsobbQ0vt2E*");
define("CURRENCY", "MXM");
define("KEY_TOKEN", "APR.wqc-354*");
define("MONEDA", "$");

session_start();

$num_cart = 0;
if(isset( $_SESSION['carrito']['productos'])) {
    $num_cart = count($_SESSION['carrito']['productos']);
}

?>