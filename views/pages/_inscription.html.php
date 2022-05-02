<div class="container_connexion">
    <form action="/inscription" method="post">
        <h1>Connexion</h1>
        <label>Email de l'utilisateur*</label>
        <input type="text" placeholder="Entrer votre mail" name="email" required>
        <label>Mot de passe d'utilisateur*</label>
        <input type="password" placeholder="Entrez votre mot de passe" name="password" required>
        <label>Vérifier le mot de passe*</label>
        <input type="password" placeholder="Entrez votre mot de passe" name="check-password" required>
        <fieldset>
            <legend>Quels type d'utilisateur êtes-vous ?*</legend>
            <div>
                <label>
                    <input type="radio" name="type" value="annonceur" required>
                    Annonceur
                </label>
                <label>
                    <input type="radio" name="type" value="standard" required>
                    Standard
                </label>
            </div>
        </fieldset>
        <input type="submit" value="Connexion">
        <a href="/connexion">Déjà inscrit ?</a>
    </form>
</div>
