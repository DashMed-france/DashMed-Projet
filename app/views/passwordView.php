<?php
/**
 * DashMed — Password Reset View
 *
 * Displays the interface for requesting and resetting user passwords.
 * This page handles two cases:
 *  - When no token is provided: asks for the user's email to send a reset code.
 *  - When a valid token is present: asks for the code and a new password.
 *
 * @package   DashMed\Modules\Views
 * @author    DashMed Team
 * @license   Proprietary
 */

/**
 * Renders the password reset page of the DashMed platform.
 *
 * Responsibilities:
 *  - Display the form to request a password reset email.
 *  - Handle the case where the token is provided and show the code/password form.
 *  - Include proper form field validation and client-side scripts.
 */
namespace modules\views;

class passwordView
{
    /**
     * Outputs the HTML content for the password reset page.
     *
     * Depending on the presence of a valid token in the URL, this method either:
     *  - Displays a form requesting the user's email to receive a reset code.
     *  - Displays a form to input the verification code and define a new password.
     *
     * @param array|null $msg  Optional associative array containing a message with keys:
     *                         - 'type' (success|error)
     *                         - 'text' (message content)
     * @return void
     */
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
            <meta name="description" content="Page pour la réinitialisation du mot de passe.">
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
                                <div class="line"></div>
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

                    <article class="buttons">
                        <a class="neg" href="/?page=login">Annuler</a>
                        <button class="pos" id="valider" type="submit" name="action" value="reset_password">Valider</button>
                    </article>
                <?php endif; ?>
            </section>
        </form>

        <script src="assets/js/password.js"></script>
        </body>
        </html>
        <?php
    }
}
