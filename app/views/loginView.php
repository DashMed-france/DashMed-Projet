<?php
/**
 * DashMed — Login View
 *
 * Displays the login form allowing users to authenticate themselves on DashMed.
 * Includes CSRF protection, email/password fields, and links for registration
 * and password recovery.
 *
 * @package   DashMed\Modules\Views
 * @author    DashMed Team
 * @license   Proprietary
 */

namespace modules\views;

/**
 * Renders the login page for the DashMed platform.
 *
 * Responsibilities:
 *  - Display the login form with CSRF token
 *  - Provide input fields for email and password
 *  - Include buttons for form submission and navigation
 *  - Load dedicated stylesheets and JavaScript for form interactivity
 */
class loginView
{
    /**
     * Outputs the complete HTML for the login form.
     *
     * The form uses POST submission to the /?page=login route and includes:
     *  - Email and password input fields
     *  - A CSRF token for request validation
     *  - Navigation links for account creation and password recovery
     *
     * @return void
     */
    public function show(): void
    {
        $csrf = $_SESSION['_csrf'] ?? '';
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description"
                  content="Cette partie du Site ETU est dédiée aux différents cours des professeurs.">
            <title>DashMed - Se connecter</title>
            <link rel="stylesheet" href="assets/css/style.css">
            <link rel="stylesheet" href="assets/css/form.css">
            <link id="theme" rel="stylesheet" href="assets/css/themes/light.css">
            <link rel="icon" type="image/svg+xml" href="assets/img/logo.svg">
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
                    <a class="neg" href="/?page=homepage">Annuler</a>
                    <button class="pos" type="submit">Se connecter</button>
                </section>
                <section class="links">
                    <a href="/?page=signin">Je n'ai pas de compte</a>
                    <a href="/?page=password">Mot de passe oublié</a>
                </section>
            </section>
        </form>

        <script src="assets/js/login.js"></script>
        </body>
        </html>
        <?php
    }
}
