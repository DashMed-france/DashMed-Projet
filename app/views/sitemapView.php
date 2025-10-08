<?php
/**
 * DashMed — Site Map View
 *
 * Displays the website's sitemap for better navigation and SEO optimization.
 *
 * @package   DashMed\Modules\Views
 * @author    DashMed Team
 * @license   Proprietary
 */
namespace modules\views;

/**
 * Renders the website map page.
 *
 * Responsibilities:
 *  - Display a website map for SEO purposes and easier navigation
 */
class sitemapView
{
    /**
     * Outputs the HTML content for the site plan page.
     *
     * @return void
     */
    public function show(): void
    {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>DashMed - Plan du site</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="Retrouvez toutes les pages de notre site ici.">
            <link rel="stylesheet" href="assets/css/style.css">
            <link rel="stylesheet" href="assets/css/themes/light.css">
            <link rel="stylesheet" href="assets/css/home.css">
        </head>
        </head>
        <header class="nav-fixed">
            <nav class="nav-pill">
                <section>
                    <article>
                        <div class="brand">
                            <img src="assets/img/icons/logo.png" alt="Logo DashMed" class="brand-logo">
                        </div>
                        <button class="brand mobile" onclick="toggleDropdownMenu()">
                            <img src="assets/img/icons/logo.png" alt="Logo DashMed" class="brand-logo">
                        </button>
                    </article>
                    <article class="nav-links" id="links">
                        <a href="?page=homepage">Accueil</a>
                        <a href="#">A&nbsp;propos</a>
                    </article>
                </section>
                <div class="nav-time" id="clock">00:00</div>
                <section class="nav-actions">
                    <a class="btn btn-primary" href="/?page=login">Connexion</a>
                    <a class="btn btn-secondary" href="/?page=signin">S’inscrire</a>
                </section>
            </nav>
        </header>
        <body>
            <main class="container">
                <section>
                    <h1 class="title"> Plan du site DashMed </h1>
                    <ul class="content">
                        <li><a href="/?page=homepage">Accueil</a></li>
                        <li><a href="/?page=signin">Création de compte</a></li>
                        <li><a href="/?page=login">Se connecter</a></li>
                        <li><a href="/?page=password">Mot de passe oublié</a></li>
                        <li><a href="/?page=login">Dashboard</a>
                            <ul>
                                <li><a href="/?page=profile">Profile</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
            </main>
            <footer>
                <img class="wave" src="assets/img/fond.svg" alt="wave">
                <section>
                    <section class="footer">
                        <article>
                            <p><a href="/?page=legalnotice" class="btn btn-primary">Mentions légales</a></p>
                        </article>
                        <article>
                            <p>© DashMed — <span id="year"></span> · Tous droits réservés</p>
                        </article>
                        <article>
                            <p><a href="/?page=sitemap" class="btn btn-primary">Plan du site</a></p>
                        </article>
                    </section>
                </section>
            </footer>
            <script src="assets/js/home.js"></script>
        </body>
        </html>
        <?php
    }
}