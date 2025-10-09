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
 * Renders the profile page for authenticated DashMed users.
 *
 * Responsibilities:
 *  - Display a website map for SEO purposes and easier navigation
 */
class legalnoticeView
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
            <title>DashMed - Mentions légales</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="Ici vous verrez nos mentions légales.">
            <link rel="stylesheet" href="assets/css/style.css">
            <link rel="stylesheet" href="assets/css/themes/light.css">
            <link rel="stylesheet" href="assets/css/home.css">
            <link rel="icon" type="image/svg+xml" href="assets/img/logo.svg">
        </head>
        <header class="nav-fixed">
            <nav class="nav-pill">
                <section>
                    <article>
                        <div class="brand">
                            <img src="assets/img/logo.svg" alt="Logo DashMed" class="brand-logo">
                        </div>
                        <button class="brand mobile" onclick="toggleDropdownMenu()">
                            <img src="assets/img/logo.svg" alt="Logo DashMed" class="brand-logo">
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
            <main class="container mentions-legales">
                <section>
                    <h2>1. Édition du site</h2>
                    <p>
                        Conformément aux dispositions de la loi n° 2004-575 du 21 juin 2004 pour la confiance
                        en l'économie numérique, il est précisé aux utilisateurs du site
                        <strong>DashMed</strong> l'identité des différents intervenants dans le cadre de sa
                        réalisation et de son suivi.
                    </p>
                    <p>
                        Le présent site, accessible à l’URL
                        <a href="https://dashmed.alwaysdata.net" target="_blank">https://dashmed.alwaysdata.net</a>,
                        est édité par :
                    </p>
                    <p>
                        <strong>Jules RIBBE</strong>, résidant à <strong>13080</strong>, de nationalité
                        <strong>Française</strong>, né le <strong>07/12/2005</strong>.
                    </p>
                </section>

                <section>
                    <h2>2. Hébergement</h2>
                    <p>
                        Le site est hébergé par la société <strong>Alwaysdata</strong>,
                        située au <strong>91 Rue du Faubourg Saint-Honoré, 75008 Paris</strong>.
                    </p>
                    <p>
                        Contact : <a href="tel:+33184162340">+33 1 84 16 23 40</a> —
                        <a href="https://www.alwaysdata.com" target="_blank">www.alwaysdata.com</a>
                    </p>
                </section>

                <section>
                    <h2>3. Directeur de la publication</h2>
                    <p>
                        Le directeur de la publication du site est <strong>Jules RIBBE</strong>.
                    </p>
                </section>

                <section>
                    <h2>4. Nous contacter</h2>
                    <ul>
                        <li>Email : <a href="mailto:jules.ribbe@etu.univ-amu.fr">jules.ribbe@etu.univ-amu.fr</a></li>
                        <li>Email : <a href="mailto:maxence.torchin@etu.univ-amu.fr">maxence.torchin@etu.univ-amu.fr</a></li>
                        <li>Email : <a href="mailto:eloise.giusiano@etu.univ-amu.fr">eloise.giusiano@etu.univ-amu.fr</a></li>
                        <li>Email : <a href="mailto:karmen.ratiananahary@etu.univ-amu.fr">karmen.ratiananahary@etu.univ-amu.fr</a></li>
                        <li>Email : <a href="mailto:idris.mekidiche@etu.univ-amu.fr">idris.mekidiche@etu.univ-amu.fr</a></li>
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
        <?php
    }
}