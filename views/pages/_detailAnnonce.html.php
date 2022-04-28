<div class="container">
    <h1>Detail</h1>
    <?php foreach ($rentals as $key) {;?>
        <img src="/assets/img/kamehouse.jpg">
        <p>Price: <?php echo $key->price ?>€</p>
        <p>Type: <?php echo $key->type ?></p>
        <p>Surface: <?php echo $key->surface?>m2</p>
        <p>Adresses: <?php echo $key->adresses->city . ' ' . $key->adresses->country?></p>
        <?php foreach ($key->equipement as $items) :?>
            <p> <?php echo $items->label ?></p>
        <?php endforeach; ?>
        <?php
    }?>
</div>
