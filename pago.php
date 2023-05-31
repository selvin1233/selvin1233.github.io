<?php

require 'config/config.php';
require 'config/database.php';
$db = new database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

print_r($_SESSION);

$lista_carrito = array();

if($productos != null){
    foreach($productos as $clave => $cantidad){


       $sql = $con->prepare("SELECT id, nombre, precio, $cantidad as cantidad FROM productos WHERE id =? AND activo=1");
       $sql->execute([$clave]);
       $lista_carrito[] = $sql->fetch(pdo::FETCH_ASSOC);
    }
} else {
    header("Location: index.php");
    exit;
}

//session_destroy();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tienda online</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="css/estilos.css" rel="stylesheet">

</head>
<body>
<header>
  <div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand">
        <strong>SPORTS ZONE</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarheader">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a href="#" class="nav-link active">Catalogo</a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">Contacto</a>
            </li>
        </ul>

          <a href="carrito.php" class="btn btn-primary">
            carrito<span id = "num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span>
          </a>
      </div>
    </div>
  </div>
</header>

<main>
        <div class="conteiner">

            <div class="row">
                <div class="col-6">
                    <h4>detalles de pago</h4>
                    <div id="paypal-button-container"></div>
                </div>
                 <div class="col-6"></div>   
                    <div class="table-responsive">
                        <table class="table">
                       <thead>
                            <tr>
                                <th>producto</th>
                                <th>subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                <tbody>
                    <?php if($lista_carrito == null){
                            echo '<tr><td colspan="5" class="text-center"><b>lista vacia</b></td></tr>';
                            } else {

                            $total = 0;
                            foreach($lista_carrito as $producto){
                                $_id = $producto['id'];
                                $nombre = $producto['nombre'];
                                $precio = $producto['precio'];
                                $cantidad = $producto['cantidad'];
                                $subtotal = $precio;
                                $total += $subtotal;
                    
                                ?>
                                    <tr>
                                        <td><?php echo $nombre; ?></td>
                                        <td>
                                            <div id="subtotal_<?php echo $_id; ?>" name="precio[]"><?php echo MONEDA . number_format($precio, 2, ".",","); ?></div>
                                        </td>
                                    </tr>
                            <?php } ?>

                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">
                                            <p class="h3" id="precio"><?php echo MONEDA . number_format($total, 2, '.',','); ?></p>
                                        </td>
                                    </tr>
                </tbody>
                    <?php } ?>
                        </table>
            </div>
       </div>  
    </div>
</main>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 
    <script src="https://www.paypal.com/sdk/js?client-id=AVPI1TmjQoFMRrzf9PwQJZOmjYXke3fXtFTDYmVzU_RMLAU4CjdA35qvhSCJTvspz-XZXlsobbQ0vt2E&currency=MXN"></script>   
 
    <script>
        paypal.Buttons({
            style:{
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: 100
                        }
                    }]
                });
            },

            onAproove: function(data, actions){
               actions.order.capture().then(function (detalles){
                 window.location.href="completado.Html"
               });
            },

            onCancel: function(data){
                alert("pago cancelado");
                console.log(data);
            }
        }).render('#paypal-button-container');
    </script>

</body>
</html>