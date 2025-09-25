<?php?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="mot de passe" content="Page pour le réinitialisation du mot de passe.">
        <title>DashMed - Réinitialisation mot de passe</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/form.css">
        <link rel="stylesheet" href="assets/css/themes/light.css">
    </head>
    <body>

    <form action="">
        <h1>Réinitialisation de votre mot de passe</h1>
        <section>
            <article>
                <label for="">Veuillez entrer votre email</label>
                <input type="text">
            </article>
            <article>
                <button class="pos" type="button">Recevoir le code</button>
                <label for="">Veuillez entrer le code</label>
                <div id="codeForm">
                    <div class="code-container">
                        <input type="text" maxlength="1" pattern="[0-9]" required>
                        <input type="text" maxlength="1" pattern="[0-9]" required>
                        <input type="text" maxlength="1" pattern="[0-9]" required>
                        <input type="text" maxlength="1" pattern="[0-9]" required>
                        <input type="text" maxlength="1" pattern="[0-9]" required>
                        <input type="text" maxlength="1" pattern="[0-9]" required>
                    </div>
                    <br>
                    <button class="pos" id="valider">Valider</button>
                </div>
            </article>
            <section>
                <a class="neg">Annuler</a>
            </section>
        </section>
    </form>
    <script src="assets/js/password.js"></script>
    </body>
<?php
