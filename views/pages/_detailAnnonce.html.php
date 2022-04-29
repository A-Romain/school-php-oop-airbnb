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
            <form method="post" action="" class="null">
                <label>Date d'arrivée</label>
                <div class="days">
                    <label>Jours</label>
                    <input type="number" min="01" max="31" class="chek_in_day" name="check_day">
                </div>
                <div>
                    <label>Mois</label>
                    <input type="number" min="01" max="12" class="chek_in_month" name="check_month">
                </div>
                <div>
                    <label>Année</label>
                    <input type="number" min="00" max="2077" class="chek_in_years" name="chek_years">
                </div>
                <label>Date de départ</dép></label>
                <div class="days">
                    <label>Jours</label>
                    <input type="number" min="01" max="31" class="chek_out_day" name="check_day">
                </div>
                <div>
                    <label>Mois</label>
                    <input type="number" min="01" max="12" class="chek_out_month" name="check_month">
                </div>
                <div>
                    <label>Année</label>
                    <input type="number" min="00" max="2077" class="chek_out_years" name="chek_years">
                </div>
                <input type="submit" id="reserve" value="Reservée">
            </form>
        </div>
    </div>
</div>
