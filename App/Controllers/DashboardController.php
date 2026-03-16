<?php
namespace App\Controllers;

use App\Models\User;
use Packages\View\MadelineView;

/**
 * Controller: Dashboard (Minimal & Core)
 */
class DashboardController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        // Basic core stats
        $userCount = count(User::fari());
        
        // System info
        $sysInfo = [
            'php_version' => PHP_VERSION,
            'memory_usage' => $this->formatBytes(memory_get_usage()),
            'server' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
            'os' => PHP_OS
        ];

        return MadelineView::render('auth/dashboard', [
            'name' => $_SESSION['user_name'] ?? 'Utilisateur',
            'userCount' => $userCount,
            'sysInfo' => $sysInfo,
            'lastLogin' => date('d/m/Y H:i')
        ]);
    }

    private function formatBytes($bytes, $precision = 2) {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
