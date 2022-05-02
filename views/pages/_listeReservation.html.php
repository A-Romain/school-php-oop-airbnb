<div class="container">
    <h1>Reservation</h1>

    <?php foreach ($rentals as $item){
        foreach ($item->rentals as $key){ ?>
        <div>
            <img src="/assets/img/kamehouse.jpg">
            <p>Price: <?php echo $key->price ?>€</p>
            <p>Surface: <?php echo $key->surface ?>m2</p>
            <p>Adresses: <?php echo $key->adresses->city . ' ' . $key->adresses->country ?></p>
        </div>
        <?php
        }
    } ?>
</div>