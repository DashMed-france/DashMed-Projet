<?php
declare(strict_types=1);
session_start();

/* ---- Réglages ---- */
define('APP_PATH', dirname(__DIR__) . '/app');
define('VIEW_PATH', APP_PATH . '/views');

// Base URL auto (si ton app est dans un sous-dossier)
$BASE_URL = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
if ($BASE_URL === '' || $BASE_URL === '\\') $BASE_URL = '/';

/* ---- Utilitaires ---- */
function slugifyPath(string $relPath): string {
    // ex: "Blog/Index.php" -> "blog/index"
    $p = str_replace('\\', '/', $relPath);
    $p = preg_replace('~\.php$~i', '', $p);
    $p = preg_replace('~/{2,}~', '/', $p);
    return strtolower(trim($p, '/'));
}

/**
 * Scanne app/views et construit une map "route -> fichier"
 * Règles:
 * - views/home.php              -> "/"  et "/home"
 * - views/login.php             -> "/login"
 * - views/dashboard/index.php   -> "/dashboard" et "/dashboard/index"
 * - views/admin/users.php       -> "/admin/users"
 */
function buildRouteMap(string $viewsDir): array {
    $routes = [];
    $it = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($viewsDir, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
    );
    foreach ($it as $file) {
        /** @var SplFileInfo $file */
        if (!$file->isFile() || !preg_match('~\.php$~i', $file->getFilename())) continue;

        $abs  = $file->getPathname();
        $rel  = substr($abs, strlen($viewsDir)); // "/foo/bar.php"
        $rel  = ltrim($rel, '/\\');
        $slug = slugifyPath($rel);              // "foo/bar" | "home" | "dashboard/index"

        // Route principale
        $route = '/' . $slug;                   // "/foo/bar"
        $routes[$route] = $abs;

        // Alias: ".../index" -> sans /index
        if (str_ends_with($slug, '/index')) {
            $routes['/' . substr($slug, 0, -strlen('/index'))] = $abs; // "/dashboard"
        }

        // Alias: "home.php" -> "/"
        if ($slug === 'home') {
            $routes['/'] = $abs;
        }
    }
    // pour confort: si on n'a pas "/" mais on a "index.php" à la racine -> alias "/"
    if (!isset($routes['/']) && isset($routes['/index'])) {
        $routes['/'] = $routes['/index'];
    }
    return $routes;
}

/* ---- Construit la table de routes à la volée ---- */
$ROUTES = buildRouteMap(VIEW_PATH);

/* ---- Résolution de l’URL ---- */
$reqPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
if ($BASE_URL !== '/' && str_starts_with($reqPath, $BASE_URL)) {
    $reqPath = substr($reqPath, strlen($BASE_URL));
}
$reqPath = '/' . ltrim($reqPath, '/');  // normalisé

// Compatibilité ?page=login (ex: sans .htaccess)
if (($reqPath === '/' || $reqPath === '') && !empty($_GET['page'])) {
    $page = strtolower(trim((string)$_GET['page'], '/ '));
    $page = preg_replace('~\.php$~i', '', $page);
    $reqPath = '/' . $page;
}

/* ---- Recherche du fichier à servir ---- */
$target = $ROUTES[$reqPath]
        ?? ($ROUTES[$reqPath . '/index'] ?? null) // ex: "/foo" -> "/foo/index"
        ?? null;

if (!$target || !is_file($target)) {
    http_response_code(404);
    echo "404 — Page non trouvée";
    exit;
}

/* ---- Rend la vue (plein HTML, pas de layout/partials) ---- */
$BASE = $BASE_URL; // dispo dans les vues pour les assets/liens
$BASE_URL = $BASE; // alias fréquent
require $target;
exit;
