<div class="container">
    <div class="cards">
        <?php foreach ($rentals as $key) {
        ; ?>
        <div>
            <img src="/assets/img/kamehouse.jpg">
            <p>Price: <?php echo $key->price ?>€</p>
            <p>Type: <?php echo $key->type ?></p>
            <p>Surface: <?php echo $key->surface ?>m2</p>
            <p>Capacité: <?php echo $key->capacity ?> personnes</p>
            <p>Adresses: <?php echo $key->adresses->country . ' ' . $key->adresses->city ?></p>
            <p>Description: <?php echo $key->description ?></p>
            <?php foreach ($key->equipement as $items) : ?>
                <p> <?php echo $items->label ?></p>
            <?php endforeach; ?>
            <?php } ?>
        </div>

        <div class="formResa">
            <form method="post" action="/reservation" class="null">
                <label>Date d'arrivée</label>
                <input type="date" value="chek_in" name="chek_in">
                <label>Date de départ</dép></label>
                <input type="date" value="chek_out" name="chek_out">
                <input type="submit" id="reserve" value="Reservée">
            </form>
        </div>
    </div>
</div>
