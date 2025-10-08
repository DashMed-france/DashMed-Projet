<?php
/**
 * DashMed — Homepage View
 *
 * Displays the public landing page of DashMed before authentication.
 * It introduces the platform, its goals, and provides navigation to login and sign-up pages.
 *
 * @package   DashMed\Modules\Views
 * @author    DashMed Team
 * @license   Proprietary
 */
// app/views/homepageView.php

namespace modules\views;

/**
 * Renders the main homepage of DashMed.
 *
 * Responsibilities:
 *  - Display the brand and navigation bar (Accueil, À propos)
 *  - Present introduction text about the DashMed mission
 *  - Offer access to login and sign-up routes
 *  - Render footer with legal mentions and copyright
 *
 * @see /assets/js/home.js
 */
class homepageView
{
    /**
     * Outputs the HTML content for the homepage.
     *
     * This method renders the structure of the public landing page, including
     * the header navigation, hero section, main content, and footer.
     *
     * @return void
     */
    public function show(): void
    {
        ?>
        <!doctype html>
        <html lang="fr">
        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>DashMed — Accueil</title>
            <link rel="stylesheet" href="assets/css/style.css">
            <link rel="stylesheet" href="assets/css/themes/light.css">
            <link rel="stylesheet" href="assets/css/home.css" />
        </head>
        <body>
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
        <main class="container">
            <section class="hero">
                <h1 class="title">
                    <span id="dash">Dash</span><span style="color: var(--primary-color)">Med</span>
                </h1>
                <p class="subtitle">Gérez facilement vos patients</p>
            </section>
            <section>
                <p>
                    Derrière chaque traitement, il y a une relation entre un patient et son médecin. DashMed a été créé
                    pour renforcer ce lien essentiel, en offrant un espace unique où l’information circule de façon claire
                    et sécurisée. L’idée est simple : permettre aux soignants de se concentrer sur leurs patients plutôt
                    que sur la gestion administrative, et offrir aux patients une meilleure compréhension et un meilleur
                    suivi de leur parcours de soins.
                </p>
                <p>
                    Avec DashMed, chaque consultation, chaque prescription et chaque rappel trouve sa place dans un
                    tableau de bord intuitif. La démarche repose sur la confiance et la transparence : protéger les
                    données de santé tout en fluidifiant les échanges. Notre ambition est de simplifier le quotidien
                    médical, et de rendre le suivi thérapeutique plus accessible pour tous.
                </p>
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
