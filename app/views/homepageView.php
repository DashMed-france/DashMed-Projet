<?php
// app/views/homepageView.php

namespace modules\views;

class homepageView
{
    public function show(): void
    {
        ?>
        <!doctype html>
        <html lang="fr">
        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>DashMed — Gérez facilement vos patients</title>
            <link rel="stylesheet" href="assets/css/style.css">
            <link rel="stylesheet" href="assets/css/form.css">
            <link rel="stylesheet" href="assets/css/themes/light.css">
            <link rel="stylesheet" href="assets/css/home.css" />
        </head>
        <body>
        <div class="page-surface">
            <header class="nav-fixed">
                <nav class="nav-pill">
                    <div class="brand">
                        <img src="assets/img/icons/logo.png" alt="Logo DashMed" class="brand-logo">
                    </div>
                    <ul class="nav-links">
                        <li><a href="?page=home">Accueil</a></li>
                        <li><a href="#">A&nbsp;propos</a></li>
                        <li class="nav-time" id="clock">69:69</li>
                    </ul>
                    <div class="nav-actions">
                        <a class="btn btn-primary" href="/?page=login">Connexion</a>
                        <a class="btn btn-secondary" href="/?page=signin">S’inscrire</a>
                    </div>
                </nav>
            </header>
            <div class="paper">
                <main class="container">
                    <section class="hero">
                        <h1 class="title">
                            <span id="dash">Dash</span><span style="color: blue">Med</span>
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
            </div>
        </div>
        <script src="assets/js/home.js"></script>
        </body>
        </html>
        <?php
    }
}
