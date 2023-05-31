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
       <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>producto</th>
                        <th>precio</th>
                        <th>cantidad</th>
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
                        <td><?php echo MONEDA . number_format($precio, 2, ".",","); ?></td>
                        <td>
                            <imput type="number" min="1" max="10" stop="1" value="<?php echo $cantidad ?>" size="5" id="cantidad<?php echo $_id; ?>" onchange="">
                        </td>
                        <td>
                            <div id="subtotal_<?php echo $_id; ?>" name="precio[]"><?php echo MONEDA . number_format($precio, 2, ".",","); ?></div>
                        </td>
                        <td><a href="#" id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a></td>
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

       <?php if($lista_carrito != null) { ?>
       <div class="row">
          <div class="col-md-5 offest-md-7 d-grid gap-2">
          <a href="pago.php" class="btn btn-primary btn-lg">Realizar pago :D </a>
       </div>
       <?php } ?>
      
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿desea eliminar el producto de la lista?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button id="btn-elimina" type="button" class="btn btn-danger" onclick="elimina()">Eliminar</button>
      </div>
    </div>
  </div>
</div>
 
  
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 
    <script>

        let eliminaModal = document.getElementById('eliminaModal')
        eliminaModal.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
            buttonElimina.value = id
            })

        function addproducto(id, token) {
            let url= 'clases/carrito.php'
            let formdata = new FormData()
            formdata.append('id',id)
            formdata.append('token', token)

            fetch(url, {
                   method: 'POST',
                   body: formdata,
                   mode: 'cors'
                }).then(Response => Response.json())
                .then(data => {
                    if(data.ok){
                        let elemento = document.getElementById('num_cart')
                        elemento.innerHTML = data.numero
                    }
                })


        }
           
        
    </script>
</body>
</html>