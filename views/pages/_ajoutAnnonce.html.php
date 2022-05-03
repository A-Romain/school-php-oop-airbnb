<div>
    <form method="post">
        <h1>Ajout d'une de vos annonces</h1>
        <div>
            <label>Type</label>
            <input type="select" name="type">
        </div>
        <div>
            <label>Surface</label>
            <input type="number" min="10"  max="250" name="surface">
        </div>
        <div>
            <label>Capacité</label>
            <input type="number" min="1" max="16" name="capacity">
        </div>
        <div>
            <label>Pays</label>
            <input type="text" placeholder="pays" name="country">
        </div>
        <div>
            <label>Ville</label>
            <input type="text" placeholder="city" name="city">
        </div>
        <div>
            <label>Description</label>
            <input type="text" placeholder="description" name="description">
        </div>
        <div>
            <label>Equipements</label>
            <div>
                <label>Clim</label>
                <input type="checkbox" value="clim" name="equipments[]">
            </div>
            <div>
                <label>Machine a laver</label>
                <input type="checkbox" value="machinelave" name="equipments[]">
            </div>
            <div>
                <label>Grille pain</label>
                <input type="checkbox" value="grille_pain" name="equipments[]">
            </div>
            <div>
                <label>Balcon</label>
                <input type="checkbox" value="balcon" name="equipments[]">
            </div>
            <div>
                <label>Fours</label>
                <input type="checkbox" value="fours" name="equipments[]">
            </div>
            <div>
                <label>Télé</label>
                <input type="checkbox" value="tele" name="equipments[]">
            </div>
            <div>
                <label>Chambre fumeur</label>
                <input type="checkbox" value="fumeur" name="equipments[]">
            </div>
        </div>
        <div>
            <label>Price</label>
            <input type="number" min="50" max="500" name="price">
        </div>
        <input type="submit" id="ajout" value="Ajout">
    </form>
</div>