<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>DashMed — Gérez facilement vos patients</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/form.css">
  <link rel="stylesheet" href="assets/css/themes/light.css">
  <link rel="stylesheet" href="assets/css/home.css" />
  
</head>
<body>
  <div class="page-surface">
    <!-- NAV FIXE -->
    <header class="nav-fixed">
      <nav class="nav-pill">
        <!-- Logo + texte DashMed en dessous -->
        <div class="brand">
            <img src="assets/img/icons/logo.png" alt="Logo DashMed" class="brand-logo">
            <div class="brand-mini">DashMed</div>
        </div>

        <!-- Liens -->
        <ul class="nav-links">
          <li><a href="#">Accueil</a></li>
          <li><a href="#">A&nbsp;propos</a></li>
          <li class="nav-time" id="clock">10:09</li>
        </ul>

        <!-- Boutons -->
        <div class="nav-actions">
          <a class="btn btn-primary" href="#">Connexion</a>
          <a class="btn btn-secondary" href="#">S’inscrire</a>
        </div>
      </nav>
    </header>

    <!-- CONTENU avec vague -->
    <div class="paper">
      <img src="assets/img/icons/fond.svg" alt="" class="fond fond-top" aria-hidden="true">

      <main class="container">
        <section class="hero">
          <!-- Titre centré -->
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

      <img src="assets/img/icons/fond.svg" alt="" class="fond fond-bottom" aria-hidden="true">
    </div>
  </div>
  <script src="assets/js/home.js"></script>
</body>
</html>
