<?php
$currentPage = $_GET['page'] ?? 'dashboard';

function isActive(string $pageName, string $current): string {
    return $pageName === $current ? 'id="active"' : '';
}
?>

<nav>
    <section class="logo">
        <p><span id="dash">Dash</span><span style="color: blue">Med</span></p>
    </section>

    <section class="tabs">
        <a href="/?page=dashboard" <?= isActive('dashboard', $currentPage) ?>>
            <img src="assets/img/icons/dashboard.svg" alt="Dashboard">
        </a>
        <a href="/?page=monitoring" <?= isActive('monitoring', $currentPage) ?>>
            <img src="assets/img/icons/ecg.svg" alt="Surveillance ECG">
        </a>
        <a href="/?page=patients" <?= isActive('patients', $currentPage) ?>>
            <img src="assets/img/icons/patient-record.svg" alt="Dossier patient">
        </a>
    </section>

    <section class="login">
        <a href="/?page=logout">
            <img src="assets/img/icons/logout.svg" alt="Déconnexion">
        </a>
    </section>
</nav>
