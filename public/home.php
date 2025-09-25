<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DashMed — Gérez facilement vos patients</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/themes/light.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/home.css" />
</head>
<body>
<!-- bande sombre autour (comme sur la capture) -->
<div class="page-surface">
    <!-- NAV FIXE EN HAUT (reste tout le long) -->
    <header class="nav-fixed">
        <nav class="nav-pill">
            <div class="brand">
                <img class="brand-mark" src="" alt="" aria-hidden="true">
                <div class="brand-box">
                    <div class="brand-mini">DashMed</div>
                </div>
            </div>

            <ul class="nav-links">
                <li><a class="is-active" href="#">Accueil</a></li>
                <li><a href="#">A&nbsp;propos</a></li>
                <li class="nav-time" id="clock">10:09</li>
            </ul>

            <div class="nav-actions">
                <a class="btn btn-primary" href="#">Connexion</a>
                <a class="btn btn-secondary" href="#">S’inscrire</a>
            </div>
        </nav>
    </header>

    <!-- FOND CLAIR + VAGUE HAUT (retournée) -->
    <div class="paper">
        <img src="wave.svg" alt="" class="wave wave-top" aria-hidden="true">

        <main class="container">
            <section class="hero">
                <h1 class="title">
                    <span class="dash">Dash</span><span class="med">Med</span>
                </h1>
                <p class="subtitle">Gérez facilement vos patients</p>
            </section>

            <section class="content">
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

        <!-- VAGUE BAS (à l’endroit) -->
        <img src="wave.svg" alt="" class="wave wave-bottom" aria-hidden="true">
    </div>
</div>

<script>
    // Horloge (optionnel)
    function updateClock(){
        const el = document.getElementById('clock');
        if (!el) return;
        const d = new Date();
        const h = String(d.getHours()).padStart(2,'0');
        const m = String(d.getMinutes()).padStart(2,'0');
        el.textContent = `${h}:${m}`;
    }
    updateClock();
    setInterval(updateClock, 15000);
</script>
</body>
</html>
