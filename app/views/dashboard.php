<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>DashMed - Dashboard</title>
    <link rel="stylesheet" href="../../public/assets/css/themes/light.css">
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <link rel="stylesheet" href="../../public/assets/css/dash.css">
</head>
<body>

<nav>
    <section class="logo">
        <p><span id="dash">Dash</span><span style="color: blue">Med</span></p>
    </section>

    <section class="tabs">
        <a href="#" id="active"><img src="../../public/assets/img/icons/dashboard.svg" alt=""></a>
        <a href="#"><img src="../../public/assets/img/icons/ecg.svg" alt=""></a>
        <a href="#"><img src="../../public/assets/img/icons/patient-record.svg" alt=""></a>
    </section>

    <section class="login">
        <a href="/login.php"><img src="../../public/assets/img/icons/logout.svg" alt=""></a>
    </section>
</nav>

<main class="container">

    <form class="searchbar" role="search" action="#" method="get">
            <span class="left-icon" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/>
                    <line x1="16.65" y1="16.65" x2="22" y2="22" stroke="currentColor" stroke-width="2"
                          stroke-linecap="round"/>
                </svg>
            </span>
        <input type="search" name="q" placeholder="Search..." aria-label="Rechercher"/>
        <div class="actions">
            <button type="button" class="action-btn" aria-label="Notifications">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22a2 2 0 0 0 2-2H10a2 2 0 0 0 2 2Zm6-6V11a6 6 0 1 0-12 0v5l-2 2v1h16v-1l-2-2Z"
                          stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
            </button>
            <div class="avatar" title="Profil" aria-label="Profil"><img src="" alt=""></div>
        </div>
    </form>

    <section class="cards-container">
        <article class="card">
            <h3>Fréquence cardiaque</h3>
            <p class="value">72 bpm</p>
        </article>

        <article class="card">
            <h3>Saturation O₂</h3>
            <p class="value">98 %</p>
        </article>

        <article class="card">
            <h3>Tension artérielle</h3>
            <p class="value">118/76 mmHg</p>
        </article>

        <article class="card">
            <h3>Température</h3>
            <p class="value">36,7 °C</p>
        </article>
    </section>
</main>
</body>
</html>