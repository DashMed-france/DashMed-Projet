<?php
namespace modules\views;

class profileView
{
    public function show(?array $user, array $specialties = [], ?array $msg = null): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $_SESSION['csrf_profile'] = bin2hex(random_bytes(16));

        $h = static function ($v): string {
            return htmlspecialchars((string)($v ?? ''), ENT_QUOTES, 'UTF-8');
        };
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>DashMed - Mon profil</title>
            <link rel="stylesheet" href="assets/css/themes/light.css">
            <link rel="stylesheet" href="assets/css/style.css">
            <link rel="stylesheet" href="assets/css/dash.css">
        </head>
        <body>
        <?php include 'components/sidebar.php'; ?>

        <main class="container">
            <h1>Mon profil</h1>

            <?php if (is_array($msg) && isset($msg['text'])): ?>
                <div class="alert <?= $h($msg['type'] ?? 'info') ?>">
                    <?= $h($msg['text']) ?>
                </div>
            <?php endif; ?>

            <!-- FORMULAIRE MISE À JOUR PROFIL -->
            <form action="/?page=profile" method="post" class="profile-form">
                <input type="hidden" name="csrf" value="<?= $h($_SESSION['csrf_profile'] ?? '') ?>">

                <section>
                    <label for="first_name">Prénom</label>
                    <input type="text" id="first_name" name="first_name" required
                           value="<?= $h($user['first_name'] ?? '') ?>">
                </section>

                <section>
                    <label for="last_name">Nom</label>
                    <input type="text" id="last_name" name="last_name" required
                           value="<?= $h($user['last_name'] ?? '') ?>">
                </section>

                <section>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" disabled
                           value="<?= $h($user['email'] ?? '') ?>">
                </section>

                <section>
                    <label for="profession_id">Spécialité médicale</label>
                    <select id="profession_id" name="profession_id">
                        <option value="">-- Sélectionnez votre spécialité --</option>
                        <?php
                        $current = $user['profession_id'] ?? null;
                        foreach ($specialties as $s) {
                            $id = (int)($s['id'] ?? 0);
                            $name = $s['name'] ?? '';
                            $sel = ($current !== null && (int)$current === $id) ? 'selected' : '';
                            echo '<option value="'.$id.'" '.$sel.'>'.$h($name).'</option>';
                        }
                        ?>
                    </select>
                    <?php if (!empty($user['profession_name'])): ?>
                        <small>Actuelle : <?= $h($user['profession_name']) ?></small>
                    <?php endif; ?>
                </section>

                <section>
                    <button type="submit" class="pos">Enregistrer les modifications</button>
                </section>
            </form>

            <form action="/?page=profile" method="post" class="danger-zone"
                  onsubmit="return confirm('⚠️ Cette action est irréversible. Confirmer la suppression de votre compte ?');">
                <input type="hidden" name="csrf" value="<?= $h($_SESSION['csrf_profile'] ?? '') ?>">
                <input type="hidden" name="action" value="delete_account">
                <button type="submit" class="btn-danger">Supprimer mon compte</button>
                <small class="danger-help">Cette action supprimera définitivement votre compte.</small>
            </form>
        </main>
        </body>
        </html>
        <?php
    }
}
