<?php
namespace App\Middlewares;

/**
 * Middleware: Protège l'accès aux routes privées
 */
class AuthMiddleware {
    public function handle(): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['user_id'])) {
            // Utilisateur non connecté : on coupe la route et on redirige
            header('Location: /login');
            exit;
        }

        return true; // Continue vers le contrôleur
    }
}