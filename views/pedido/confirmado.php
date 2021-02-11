<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
    <h1>Tu pedido se ha confirmado</h1>
    <p>Tu pedido a sido guardado con exito, una vez que realices la transferencia bancaria a la cuenta 76526181DA515 con el coste del pedido, sera procesado y enviado.</p>

    <h3>Datos del pedido:</h3>
    <?php if(isset($pedido)): ?>
        <pre>
            Numero del pedido: <?=$pedido->id?>
            Total a pagar: <?=$pedido->coste?>
            Productos:

        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
                <th>Imagen</th>
            </tr>
        <?php while($producto = $productos->fetch_object()): ?>
            <tr>
                <td><?=$producto->id?></td>
                <td><a href="<?=base_url?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a></td>
                <td><?=$producto->precio?></td>
                <td><?=$producto->unidades?></td>
                <td><img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" alt="<?=$producto->imagen?>" class="img_carrito"></td>
            </tr>
        <?php endwhile; ?>
        </table>

        </pre>
    <?php endif; ?>
<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'failed'): ?>
    <h1>Tu pedido no a podido procesarse</h1>
<?php endif; ?>
