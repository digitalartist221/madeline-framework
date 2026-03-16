<?php
namespace App\Config;

/**
 * Configuration Principale de l'Application Madeline
 *
 * Toutes les variables d'environnement, accès base de données,
 * et réglages globaux se trouvent ici.
 */
class AppConfig {
    
    public static function get() {
        return [
            /*
            |--------------------------------------------------------------------------
            | Nom de l'application
            |--------------------------------------------------------------------------
            */
            'name' => 'Maye',
            'description' => 'Gestionnaire administratif',

            /*
            |--------------------------------------------------------------------------
            | Environnement et Debug
            |--------------------------------------------------------------------------
            | Valeurs: 'local', 'production'
            */
            'env' => 'local',
            'debug' => true,

            /*
            |--------------------------------------------------------------------------
            | URL de base
            |--------------------------------------------------------------------------
            */
            'url' => 'http://localhost:8000',

            /*
            |--------------------------------------------------------------------------
            | Gestion du Cache des Vues (Automatique Intelligente)
            |--------------------------------------------------------------------------
            | view_cache_lifetime: Durée en secondes avant vérification/recompilation
            | - En mode 'local', le cache est toujours invalidé (recompilé en direct)
            | - Si = 0, il ne se recompile jamais sauf si le fichier source a changé
            | Exemple: 3600 = vérifie/recompile le cache source au bout d'une heure max
            */
            'view_cache_lifetime' => 3600,

            /*
            |--------------------------------------------------------------------------
            | Configuration de la Base de Données
            |--------------------------------------------------------------------------
            | Laissez db_name vide pour déclencher le SetupController interactif.
            | Remplacement automatique lors du setup si name est vide.
            */
            'database' => [
                'host' => 'localhost',
                'name' => 'madeline_db',
                'user' => 'root',
                'pass' => '',
                'charset' => 'utf8mb4'
            ],

            /*
            |--------------------------------------------------------------------------
            | Configuration Mail (SMTP)
            |--------------------------------------------------------------------------
            */
            'mail' => [
                'from_email' => 'noreply@madeline.local',
                'from_name' => 'Madeline',
                'host' => 'sandbox.smtp.mailtrap.io',
                'port' => '2525',
                'user' => '9cd2e4844e1210',
                'pass' => '1050693059b1c1',
            ],

            /*
            |--------------------------------------------------------------------------
            | Middlewares Globaux
            |--------------------------------------------------------------------------
            | Ces middlewares seront exécutés à CHAQUE requête.
            |--------------------------------------------------------------------------
            */
            'middlewares' => [
                \App\Middlewares\SecurityHeadersMiddleware::class,
                \App\Middlewares\CsrfMiddleware::class,
            ]
        ];
    }
}
