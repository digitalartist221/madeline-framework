<?php
namespace Core;

class App {
    public function run() {
        // Obtenir l'URL (compatible Apache et PHP built-in server)
        $url = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        
        // Charger la configuration globale du framework
        Config::load();

        // Nettoyage automatique du cache (Périodique)
        Cache::autoClear();

        // Support du mode .htaccess
        if (isset($_GET['url']) && !empty($_GET['url'])) {
            $url = '/' . ltrim($_GET['url'], '/');
        }

        $url = rtrim($url, '/');
        if (empty($url)) {
            $url = '/';
        }

        // Configuration de base ou DB
        $isConfigured = self::isConfigured();
        
        // Gestion du bypass (Ignorer le setup)
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (isset($_GET['skip_setup'])) {
            $_SESSION['m_skip_setup'] = true;
        }
        $isSkipped = $_SESSION['m_skip_setup'] ?? false;

        $isSetupUrl = (trim($url, '/') === 'setup');

        if (!$isConfigured && !$isSetupUrl && !$isSkipped) {
            // Pas de config du tout -> Assistant d'installation
            header('Location: /setup');
            exit;
        }

        // Charger les routes définies par l'utilisateur (si le fichier existe)
        $routesFile = __DIR__ . '/../routes.php';
        if (file_exists($routesFile)) {
            require_once $routesFile;
        }

        // Lancement du Routeur
        $response = Router::dispatch($url);
        
        // Si le routeur renvoie une chaîne (comme une vue compilée), on l'affiche
        if (is_string($response)) {
            echo $response;
        }
    }

    public static function isConfigured() {
        // Le framework est considéré comme configuré si l'un de ces fichiers existe
        return class_exists('\\App\\Config\\AppConfig') || 
               file_exists(__DIR__ . '/../App/Config/AppConfig.php') ||
               file_exists(__DIR__ . '/../config.php');
    }
}
