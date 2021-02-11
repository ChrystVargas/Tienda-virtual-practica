<?php
require_once 'models/Pedido.php';

class PedidoController
{
    public function hacer()
    {
        require_once 'views/pedido/hacer.php';
    }

    public function add()
    {
        if (isset($_SESSION['identity'])) {
            $usuario_id = $_SESSION['identity']->id;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

            $stats = Utils::statsCarrito();
            $coste = $stats['total'];

            if ($provincia && $localidad && $direccion) {
                //Guardar pedido
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                $save = $pedido->save();

                //Guardar linea pedido
                $save_linea = $pedido->save_linea();

                if ($save && $save_linea) {
                    $_SESSION['pedido'] = 'complete';
                } else {
                    $_SESSION['pedido'] = 'failed';
                }
            } else {
                $_SESSION['pedido'] = 'failed';
            }

            header("Location:" . base_url . 'pedido/confirmado');
        } else {
            header("Location:" . base_url);
        }
    }

    public function confirmado()
    {
        if (isset($_SESSION['identity'])) {
            $identity = $_SESSION['identity'];
            $pedidos = new Pedido();
            $pedidos->setUsuario_id($identity->id);
            $pedido = $pedidos->getOneByUser();

            $pedidos->setId($pedido->id);
            $productos = $pedidos->getProductsByPedido();
        }

        require_once 'views/pedido/confirmado.php';
    }

    public function mis_pedidos()
    {
        Utils::isIdentity();
        $identity = $_SESSION['identity']->id;
        $pedido = new Pedido();
        //Sacar todos los pedidos del usuario
        $pedido->setUsuario_id($identity);
        $pedidos = $pedido->getAllByUser();

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function detalle()
    {
        Utils::isIdentity();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $pedidos = new Pedido();
            $pedidos->setId($id);
            $pedido = $pedidos->getOne();

            $productos = $pedidos->getProductsByPedido();

            require_once 'views/pedido/detalle.php';
        } else {
            header("Location:" . base_url . 'pedido/mis_pedidos');
        }
    }

    public function gestion()
    {
        Utils::isAdmin();
        $gestion = true;

        $pedidos = new Pedido();
        $pedidos = $pedidos->getAll();
        require_once 'views/pedido/mis_pedidos.php';
    }

    public function estado()
    {
        Utils::isAdmin();

        if (isset($_POST['pedido_id']) && isset($_POST['estado'])) {
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];

            //Actualizar pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->editStatus();

            header("Location:" . base_url.'pedido/detalle&id='.$id);
        } else {
            header("Location:" . base_url);
        }
    }
}
