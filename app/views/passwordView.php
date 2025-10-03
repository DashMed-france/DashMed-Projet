<?php

namespace modules\views;

class passwordView
{
    public function show(?array $msg = null): void
    {
        $token = $_GET['token'] ?? '';
        $hasToken = (bool)preg_match('/^[a-f0-9]{32}$/', $token);
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="mot de passe" content="Page pour la réinitialisation du mot de passe.">
            <title>DashMed - Réinitialisation mot de passe</title>
            <link rel="stylesheet" href="assets/css/style.css">
            <link rel="stylesheet" href="assets/css/form.css">
            <link rel="stylesheet" href="assets/css/themes/light.css">
        </head>
        <body>

        <form method="post" action="/?page=password">
            <h1>Réinitialisation de votre mot de passe</h1>

            <?php if ($msg): ?>
                <p class="<?= htmlspecialchars($msg['type']) ?>">
                    <?= htmlspecialchars($msg['text']) ?>
                </p>
            <?php endif; ?>

            <section>
                <?php if (!$hasToken): ?>
                    <article>
                        <label for="email">Veuillez entrer votre email</label>
                        <input type="email" id="email" name="email" autocomplete="email" required>
                    </article>
                    <article>
                        <button class="pos" type="submit" name="action" value="send_code">Recevoir le code</button>
                    </article>
                <?php else: ?>
                    <input type="hidden" name="token" value="<?= htmlspecialchars($token, ENT_QUOTES) ?>">

                    <article>
                        <label for="code">Veuillez entrer le code reçu par e-mail</label>
                        <div id="codeForm">
                            <div class="code-container">
                                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" class="code-digit" required>
                                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" class="code-digit" required>
                                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" class="code-digit" required>
                                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" class="code-digit" required>
                                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" class="code-digit" required>
                                <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" class="code-digit" required>
                                <input type="hidden" id="code" name="code">
                            </div>
                        </div>
                    </article>

                    <article>
                        <label for="password">Nouveau mot de passe</label>
                        <input type="password" id="password" name="password" minlength="8" required>
                    </article>

                    <article>
                        <button class="pos" id="valider" type="submit" name="action" value="reset_password">Valider</button>
                    </article>
                <?php endif; ?>

                <section>
                    <a class="neg" href="/?page=signin">Annuler</a>
                </section>
            </section>
        </form>

        <script>
            (function () {
                const digits = Array.from(document.querySelectorAll('.code-digit'));
                const hidden = document.getElementById('code');
                if (digits.length && hidden) {
                    digits.forEach((inp, idx) => {
                        inp.addEventListener('input', () => {
                            inp.value = inp.value.replace(/[^0-9]/g, '').slice(0,1);
                            if (inp.value && idx < digits.length - 1) digits[idx+1].focus();
                            hidden.value = digits.map(d => d.value || '').join('');
                        });
                        inp.addEventListener('keydown', (e) => {
                            if (e.key === 'Backspace' && !inp.value && idx > 0) {
                                digits[idx-1].focus();
                            }
                        });
                    });
                }
            })();
        </script>

        <script src="assets/js/password.js"></script>
        </body>
        </html>
        <?php
    }
}
