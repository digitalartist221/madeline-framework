<?php

/**
 * Madeline Global Helpers
 */

if (!function_exists('asset')) {
    /**
     * Génère une URL pour un asset public
     * 
     * @param string $path Chemin de l'asset relatif à /public
     * @return string
     */
    function asset($path) {
        $baseUrl = \Core\Config::get('url', '');
        if (empty($baseUrl)) {
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
            $baseUrl = $protocol . '://' . $host;
        }
        
        $path = ltrim($path, '/');
        
        // Ajout d'un cache-busting basique en mode production (optionnel)
        $fullPath = __DIR__ . '/../public/' . $path;
        $version = '';
        if (file_exists($fullPath)) {
            $version = '?v=' . filemtime($fullPath);
        }
        
        return rtrim($baseUrl, '/') . '/' . $path . $version;
    }
}

if (!function_exists('url')) {
    /**
     * Génère une URL absolue pour une route
     * 
     * @param string $path
     * @return string
     */
    function url($path = '') {
        $baseUrl = \Core\Config::get('url', '');
        if (empty($baseUrl)) {
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
            $baseUrl = $protocol . '://' . $host;
        }
        
        return rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
    }
}

if (!function_exists('request')) {
    /**
     * Retourne l'instance unique de la requête HTTP
     * 
     * @return \Packages\Http\Request
     */
    function request() {
        static $instance = null;
        if ($instance === null) {
            $instance = new \Packages\Http\Request();
        }
        return $instance;
    }
}
