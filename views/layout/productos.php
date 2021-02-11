<?php while($prod = $productos->fetch_object()): ?>
<div class="product">
    <a href="<?=base_url?>producto/ver&id=<?=$prod->id?>">
        <img src="<?=base_url?>uploads/images/<?=$prod->imagen?>" alt="<?=$prod->imagen?>">
        <h2><?=$prod->nombre?></h2>
    </a>
    <p><?=$prod->precio?> Soles</p>
    <a href="<?=base_url?>carrito/add&id=<?=$prod->id?>" class="button">Comprar</a>
</div>
<?php endwhile; ?>