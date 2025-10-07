<?php
/**
 * DashMed — Header Component
 *
 * This file defines the top header section displayed across DashMed pages.
 * It may include the title of the current page, notifications, or user information.
 *
 * @package   DashMed\Views
 * @author    DashMed Team
 * @license   Proprietary
 */

$currentPage = $_GET['page'] ?? 'dashboard';

/**
 * Determines if a given page name matches the current page and returns an active ID string.
 *
 * @param string $pageName The name of the page to check.
 * @param string $current The current active page.
 * @return string Returns 'id="active"' if the page is active, otherwise an empty string.
 */
function isActive(string $pageName, string $current): string {
    return $pageName === $current ? 'id="active"' : '';
}
?>

<nav>
    <section class="logo">
        <p><span id="dash">Dash</span><span style="color: var(--primary-color)">Med</span></p>
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
