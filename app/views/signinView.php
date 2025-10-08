<?php
/**
 * DashMed — Sign-in View
 *
 * Displays the registration form allowing new users to create an account.
 * Includes CSRF protection, password confirmation fields, and validation error handling.
 *
 * @package   DashMed\Modules\Views
 * @author    DashMed Team
 * @license   Proprietary
 */
declare(strict_types=1);

namespace modules\views;

/**
 * Renders the sign-up (registration) page for new DashMed users.
 *
 * Responsibilities:
 *  - Display form fields for first name, last name, email, and password confirmation
 *  - Show error messages when validation fails
 *  - Maintain user input between failed submissions using session data
 *  - Include CSRF token hidden input for secure form submission
 */
class signinView
{
    /**
     * Outputs the HTML content of the registration form.
     *
     * The view uses values stored in the session to prefill inputs after validation errors,
     * displays any stored error messages, and includes a hidden CSRF token for security.
     *
     * @return void
     */
    public function show(): void
    {
        $csrf = $_SESSION['_csrf'] ?? '';

        $error = $_SESSION['error'] ?? '';
        unset($_SESSION['error']);

        $old = $_SESSION['old_signin'] ?? [];
        unset($_SESSION['old_signin']);
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="Cette partie du Site ETU est dédiée aux différents cours des professeurs.">
            <title>DashMed - Créer un compte</title>
            <link rel="stylesheet" href="assets/css/style.css">
            <link rel="stylesheet" href="assets/css/form.css">
            <link id="theme" rel="stylesheet" href="assets/css/themes/light.css">
        </head>
        <body>

        <?php if (!empty($error)): ?>
            <div class="form-errors" role="alert"
                 style="background:#fee;border:1px solid #f99;color:#900;padding:.75rem;border-radius:.5rem;margin:1rem 0;">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <form action="?page=signin" method="post" novalidate>
            <h1>Création d'un compte</h1>
            <section>
                <article>
                    <label for="last_name">Nom</label>
                    <input type="text" id="last_name" name="last_name" required
                           value="<?= htmlspecialchars($old['last_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </article>

                <article>
                    <label for="first_name">Prénom</label>
                    <input type="text" id="first_name" name="first_name" required
                           value="<?= htmlspecialchars($old['first_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </article>

                <article>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required autocomplete="email"
                           value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </article>

                <article>
                    <label for="password">Mot de passe</label>
                    <div class="password">
                        <input type="password" id="password" name="password" required autocomplete="new-password">
                        <button type="button" class="toggle" data-target="password">
                            <img src="assets/img/icons/eye-open.svg" alt="eye">
                        </button>
                    </div>
                </article>

                <article>
                    <label for="password_confirm">Confirmer le mot de passe</label>
                    <div class="password">
                        <input type="password" id="password_confirm" name="password_confirm" required autocomplete="new-password">
                        <button type="button" class="toggle" data-target="password_confirm">
                            <img src="assets/img/icons/eye-open.svg" alt="eye">
                        </button>
                    </div>
                </article>

                <?php if (!empty($csrf)): ?>
                    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8') ?>">
                <?php endif; ?>

                <section class="buttons">
                    <a class="neg" href="?page=homepage">Annuler</a>
                    <button class="pos" type="submit">Créer le compte</button>
                </section>
            </section>
        </form>

        <script src="assets/js/signin.js"></script>
        </body>
        </html>
        <?php
    }
}
