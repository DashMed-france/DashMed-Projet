<?php
/**
 * DashMed — Vue de la page d’accueil
 *
 * Affiche la page publique de DashMed avant authentification.
 * Présente la plateforme, ses objectifs, et propose la navigation vers
 * les pages de connexion et d’inscription.
 *
 * @package   DashMed\Modules\Views
 * @author    Équipe DashMed
 * @license   Propriétaire
 */

namespace modules\views;

/**
 * Affiche la page d’accueil principale de DashMed.
 *
 * Responsabilités :
 *  - Afficher la marque et la barre de navigation (Accueil, À propos)
 *  - Présenter le texte d’introduction sur la mission de DashMed
 *  - Proposer l’accès aux pages de connexion et d’inscription
 *  - Afficher le pied de page avec les mentions légales et le copyright
 *
 * @see /assets/js/home.js
 */
class homepageView
{
    /**
     * Affiche le contenu HTML de la page d’accueil.
     *
     * Cette méthode génère la structure de la page publique, incluant
     * la navigation du header, la section d’accueil (hero), le contenu principal
     * et le pied de page.
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
        <title>DashMed — Plateforme de suivi médical</title>
        <meta name="description" content="DashMed est une plateforme qui simplifie le suivi médical entre médecins et patients.">
        <meta name="keywords" content="dashmed, suivi médical, santé, patient, médecin, plateforme santé">
        <link rel="icon" type="image/svg+xml" href="assets/img/logo.svg">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/themes/light.css">
        <link rel="stylesheet" href="assets/css/home.css">
    </head>
        <body>
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
            <svg width="100%" height="calc(auto-2px)" viewBox="0 0 1920 241" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="wave" d="M1920 208.188L1880 191.782C1840 175.375 1760 142.563 1680 131.592C1600 121.03 1520 131.284 1440 109.751C1360 88.2179 1280 32.8472 1200 11.3142C1120 -10.2189 1040 0.0349719 960 33.1548C880 65.6595 800 121.03 720 137.129C640 153.842 560 131.284 480 137.129C400 142.563 320 175.375 240 169.941C160 164.096 79.9999 121.03 39.9999 98.7794L-5.72205e-05 76.9387V241H39.9999C79.9999 241 160 241 240 241C320 241 400 241 480 241C560 241 640 241 720 241C800 241 880 241 960 241C1040 241 1120 241 1200 241C1280 241 1360 241 1440 241C1520 241 1600 241 1680 241C1760 241 1840 241 1880 241H1920V208.188Z" fill="#275AFE"/>
            </svg>
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
