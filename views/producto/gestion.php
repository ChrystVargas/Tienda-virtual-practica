<h1>Gestion de productos</h1>

<a href="<?=base_url?>producto/crear" class="button button-small">Crear producto</a>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
    <Strong class="alert_green">El producto se ha guardado correctamente</Strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] == 'failed'): ?>
    <Strong class="alert_red">El producto no se ha guardado correctamente</Strong>
<?php endif; ?>
<?php Utils::deleteSession('producto'); ?>


<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
    <Strong class="alert_green">El producto se ha borrado correctamente</Strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed'): ?>
    <Strong class="alert_red">El producto no se ha borrado correctamente</Strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>

<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>STOCK</th>
        <th>ACCIONES</th>
    </tr>
<?php while($prod = $productos->fetch_object()): ?>
    <tr>
        <td><?=$prod->id?></td>
        <td><?=$prod->nombre?></td>
        <td><?=$prod->precio?></td>
        <td><?=$prod->stock?></td>
        <td>
            <a href="<?=base_url?>producto/editar&id=<?=$prod->id?>" class="button button-gestion">Editar</a>
            <a href="<?=base_url?>producto/eliminar&id=<?=$prod->id?>" class="button button-gestion button-red">Eliminar</a>
        </td>
    </tr>    
<?php endwhile; ?>
</table>
