<?php
use Core\Router;

use Packages\View\MadelineView;

// Routes par défaut - Bienvenue
Router::get('/', function() {
    return MadelineView::render('welcome');
});

// ==== ROUTES: AUTH SCAFFOLD ==== //
Router::get('/login', ['\App\Controllers\AuthController', 'login']);
Router::post('/login', ['\App\Controllers\AuthController', 'loginPOST']);
Router::get('/register', ['\App\Controllers\AuthController', 'register']);
Router::post('/register', ['\App\Controllers\AuthController', 'registerPOST']);
Router::get('/logout', ['\App\Controllers\AuthController', 'logout']);

// Profil & Sécurité
Router::get('/profile', ['\App\Controllers\AuthController', 'profile'], ['\App\Middlewares\AuthMiddleware']);
Router::post('/profile/update', ['\App\Controllers\AuthController', 'updateProfile'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/forgot-password', ['\App\Controllers\AuthController', 'forgotPassword']);
Router::post('/forgot-password', ['\App\Controllers\AuthController', 'forgotPasswordPOST']);

// Route Sécurisée par l'AuthMiddleware
Router::get('/dashboard', ['\App\Controllers\DashboardController', 'index'], ['\App\Middlewares\AuthMiddleware']);

// --- DOCUMENTATION & API ---
Router::get('/docs', ['\App\Controllers\DocsController', 'guide']);
Router::get('/api/docs/ui', ['\App\Controllers\DocsController', 'ui']);
Router::get('/api/docs', ['\App\Controllers\DocsController', 'index']);
// ========================================= //