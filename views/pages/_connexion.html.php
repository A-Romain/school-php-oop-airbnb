<div class="container_connexion">
    <form action="/connexion" method="post">
        <h1>Connexion</h1>
        <label>Email de l'utilisateur</label>
        <input type="text" placeholder="Entrer votre mail" name="email">
        <label>Mots de passe d'utilisateur</label>
        <input type="password" placeholder="Entrez votre mot de passe" name="password">
        <fieldset>
            <legend>Quels type d'utilisateur êtes-vous ?</legend>
            <div>
                <label>
                    <input type="radio" name="type">
                    Annonceur
                </label>
                <label>
                    <input type="radio" name="type">
                    Standard
                </label>
            </div>
        </fieldset>
        <input type="submit" value="Connexion">
        <a href="/inscription">S'inscrire</a>
    </form>
</div>
