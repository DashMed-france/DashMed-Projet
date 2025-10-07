<?php
/**
 * DashMed — Sign-in/Registration Controller
 *
 * This file defines the controller responsible for rendering the sign-in/registration
 * view and handling form submissions to create a new user account.
 *
 * @package   DashMed\Modules\Controllers
 * @author    DashMed Team
 * @license   Proprietary
 * @link      /?page=signin
 */
declare(strict_types=1);

namespace modules\controllers;

use modules\models\signinModel;
use modules\views\signinView;

require_once __DIR__ . '/../../assets/includes/database.php';


/**
 * Handles the sign-in (registration) flow.
 *
 * Responsibilities:
 *  - Start a session (if not already started)
 *  - Provide the GET endpoint to display the sign-in form
 *  - Provide the POST endpoint to validate input and create a user
 *  - Redirect authenticated users to the dashboard
 *
 * @see \modules\models\signinModel
 * @see \modules\views\signinView
 */
class SigninController
{
    /**
     * Business logic/model for sign-in/registration operations.
     *
     * @var signinModel
     */
    private signinModel $model;

    /**
     * Controller constructor.
     *
     * Starts the session if needed, retrieves a shared PDO instance via the
     * Database helper, and instantiates the sign-in model.
     */
    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $pdo = \Database::getInstance();
        $this->model = new signinModel($pdo);
    }

    /**
     * HTTP GET handler.
     *
     * If a user session already exists, redirects to the dashboard. Otherwise,
     * ensures a CSRF token is available and renders the sign-in view.
     *
     * @return void
     */
    public function get(): void
    {
        if ($this->isUserLoggedIn()) {
            header('Location: /?page=dashboard');
            exit;
        }
        if (empty($_SESSION['_csrf'])) {
            $_SESSION['_csrf'] = bin2hex(random_bytes(16));
        }
        (new signinView())->show();
    }

    /**
     * HTTP POST handler.
     *
     * Validates submitted form fields (names, email, password & confirmation),
     * enforces basic password policy, checks email uniqueness, and delegates
     * account creation to the model. On success, seeds the session and redirects
     * the user; on failure, stores an error message and preserves old input.
     *
     * Uses header-based redirects and session flash data to communicate
     * validation outcomes.
     *
     * @return void
     */
    public function post(): void
    {
        error_log('[SigninController] POST /signin hit');

        if (isset($_SESSION['_csrf'], $_POST['_csrf']) && !hash_equals($_SESSION['_csrf'], (string)$_POST['_csrf'])) {
            $_SESSION['error'] = "Requête invalide. Réessaye.";
            header('Location: /?page=signin'); exit;
        }

        $last   = trim($_POST['last_name'] ?? '');
        $first  = trim($_POST['first_name'] ?? '');
        $email  = trim($_POST['email'] ?? '');
        $pass   = (string)($_POST['password'] ?? '');
        $pass2  = (string)($_POST['password_confirm'] ?? '');

        $keepOld = function () use ($last, $first, $email) {
            $_SESSION['old_signin'] = [
                'last_name'  => $last,
                'first_name' => $first,
                'email'      => $email,
            ];
        };

        if ($last === '' || $first === '' || $email === '' || $pass === '' || $pass2 === '') {
            $_SESSION['error'] = "Tous les champs sont requis.";
            $keepOld(); header('Location: /?page=signin'); exit;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Email invalide.";
            $keepOld(); header('Location: /?page=signin'); exit;
        }
        if ($pass !== $pass2) {
            $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
            $keepOld(); header('Location: /?page=signin'); exit;
        }
        if (strlen($pass) < 8) {
            $_SESSION['error'] = "Le mot de passe doit contenir au moins 8 caractères.";
            $keepOld(); header('Location: /?page=signin'); exit;
        }

        if ($this->model->getByEmail($email)) {
            $_SESSION['error'] = "Un compte existe déjà avec cet email.";
            $keepOld(); header('Location: /?page=signin'); exit;
        }

        try {
            $userId = $this->model->create([
                'first_name'   => $first,
                'last_name'    => $last,
                'email'        => $email,
                'password'     => $pass,
                'profession'   => null,
                'admin_status' => 0,
            ]);
        } catch (\Throwable $e) {
            error_log('[SigninController] SQL error: '.$e->getMessage());
            $_SESSION['error'] = "Impossible de créer le compte (email déjà utilisé ?)";
            $keepOld(); header('Location: /?page=signin'); exit;
        }

        $_SESSION['user_id']      = (int)$userId;
        $_SESSION['email']        = $email;
        $_SESSION['first_name']   = $first;
        $_SESSION['last_name']    = $last;
        $_SESSION['profession']   = null;
        $_SESSION['admin_status'] = 0;
        $_SESSION['username']     = $email;

        header('Location: /?page=homepage');
        exit;
    }

    /**
     * Indicates whether a user is considered logged in for the current session.
     *
     * @return bool True if a user email exists in the session; false otherwise.
     */
    private function isUserLoggedIn(): bool
    {
        return isset($_SESSION['email']);
    }
}
