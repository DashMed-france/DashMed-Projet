<?php
namespace modules\views;

class loginView
{
    public function show(): void
    {
        $csrf = $_SESSION['_csrf'] ?? '';
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="Cette partie du Site ETU est dédiée aux différents cours des professeurs.">
            <title>DashMed - Se connecter</title>
            <link rel="stylesheet" href="assets/css/style.css">
            <link rel="stylesheet" href="assets/css/form.css">
            <link id="theme" rel="stylesheet" href="assets/css/themes/light.css">
        </head>
        <body>
        <form action="/?page=login" method="post" novalidate>
            <h1>Se connecter</h1>
            <section>
                <article>
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" autocomplete="email" required>
                </article>
                <article>
                    <label for="password">Mot de passe</label>
                    <div class="password">
                        <input type="password" id="password" name="password" autocomplete="current-password" required>
                        <button type="button" class="toggle-password" aria-label="Afficher/Masquer le mot de passe">
                            <img src="assets/img/icons/eye-open.svg" alt="eye">
                        </button>
                    </div>
                </article>

                <?php if (!empty($csrf)): ?>
                    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8') ?>">
                <?php endif; ?>

                <section class="buttons">
                    <a class="neg" href="/home">Annuler</a>
                    <button class="pos" type="submit">Se connecter</button>
                </section>
                <section class="links">
                    <a href="/?page=signin">Je n'ai pas de compte</a>
                    <a href="/?page=password">Mot de passe oublié</a>
                </section>
            </section>
        </form>

        <script>
            (function () {
                const btn = document.querySelector('.toggle-password');
                const input = document.getElementById('password');
                if (btn && input) {
                    btn.addEventListener('click', () => {
                        const isPwd = input.type === 'password';
                        input.type = isPwd ? 'text' : 'password';
                        const img = btn.querySelector('img');
                        if (img) {
                            img.src = isPwd ? 'assets/img/icons/eye-closed.svg' : 'assets/img/icons/eye-open.svg';
                            img.alt = isPwd ? 'hide' : 'eye';
                        }
                    });
                }
            })();
        </script>
        </body>
        </html>
        <?php
    }
}
