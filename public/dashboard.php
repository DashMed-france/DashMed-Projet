<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>DashMed - Dashboard</title>
    <link rel="stylesheet" href="assets/css/themes/light.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/dash.css">
</head>
<body>

    <nav>
        <section class="logo">
            <p><span id="dash">Dash</span><span style="color: blue">Med</span></p>
        </section>

        <section class="tabs">
            <a href="#" id="active"><img src="assets/img/icons/dashboard.svg" alt=""></a>
            <a href="#"><img src="assets/img/icons/ecg.svg" alt=""></a>
            <a href="#"><img src="assets/img/icons/patient-record.svg" alt=""></a>
        </section>

        <section class="login">
            <a href="/login.php"><img src="assets/img/icons/logout.svg" alt=""></a>
        </section>
    </nav>

    <main class="container">
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