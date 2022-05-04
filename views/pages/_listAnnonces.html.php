<div class="container">
    <h1>Annonces</h1>
    <?php if (!empty($rentals)){
        ; ?>
            <?php foreach ($rentals as $key) :?>
        <div class="cards">
            <img src="/assets/img/kamehouse.jpg">
            <p>Price: <?php echo $key->price ?>€</p>
            <p>Type: <?php echo $key->type ?></p>
            <p>Surface: <?php echo $key->surface ?>m2</p>

            <p>Adresses: <?php echo $key->adresses->city . ' ' . $key->adresses->country ?></p>

            <p>Description: <?php echo $key->description ?></p>
            <a href="/detail/<?php echo $key->id ?>">Detail</a>
        </div>
        <?php endforeach; } else{
        echo 'pas de reservation';
    }
    ?>
</div>
