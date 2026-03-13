<?php
namespace App\Controllers;

use App\Models\Document;
use App\Models\Depense;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Contrat;
use Packages\View\MadelineView;

/**
 * Controller: Tableau de Bord Financier (Odoo Style)
 */
class DashboardController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $userName = $_SESSION['user_name'] ?? 'Utilisateur';

        // Chargement des données
        $docs = Document::fari();
        $contrats = Contrat::fari();
        $dep_rows = Depense::fari();
        $clients = Client::fari();

        $revenus = 0;
        $revenus_attente = 0;

        // Calcul des Revenus Stricts (Factures)
        foreach($docs as $d) {
            if($d->statut === 'paye') {
                $revenus += $d->total_ttc;
            } else if($d->statut === 'valide' || $d->statut === 'envoye') {
                $revenus_attente += $d->total_ttc;
            }
        }

        // Calcul des Revenus Stricts (Contrats)
        foreach($contrats as $c) {
            if($c->statut === 'signe') {
                $revenus += ($c->total_ttc ?? 0);
            } else if($c->statut === 'valide' || $c->statut === 'envoye') {
                $revenus_attente += ($c->total_ttc ?? 0);
            }
        }

        // Calcul des Dépenses (Uniquement réelles, pas de brouillon si métier)
        $depenses = 0;
        foreach($dep_rows as $dp) {
            $depenses += $dp->montant;
        }

        // Bilan Cash-flow
        $bilan = $revenus - $depenses;

        // Stats Globales
        $countClients = count($clients);
        $countProducts = count(Produit::fari());
        
        $countSent = 0;
        $countRead = 0;
        $clientValue = []; // Pour Top Clients

        foreach($docs as $d) {
            if ($d->sent_at) $countSent++;
            if ($d->is_read) $countRead++;
            // Aggregate client value
            $cid = $d->client_id;
            if (!isset($clientValue[$cid])) $clientValue[$cid] = 0;
            if ($d->statut === 'paye') $clientValue[$cid] += $d->total_ttc;
        }

        foreach($contrats as $c) {
            if ($c->sent_at) $countSent++;
            if ($c->is_read) $countRead++;
            $cid = $c->client_id;
            if (!isset($clientValue[$cid])) $clientValue[$cid] = 0;
            if ($c->statut === 'signe') $clientValue[$cid] += ($c->total_ttc ?? 0);
        }

        // Sort Top Clients
        arsort($clientValue);
        $topClients = [];
        $i = 0;
        foreach ($clientValue as $id => $val) {
            if ($i >= 3) break;
            $cObj = array_values(array_filter($clients, fn($cl) => (string)$cl->id === (string)$id))[0] ?? null;
            if ($cObj) {
                $topClients[] = ['name' => $cObj->nom, 'value' => $val];
                $i++;
            }
        }

        // Données Graphe
        $chartData = [
            'labels' => ['Encaissements', 'Dépenses', 'Solde'],
            'values' => [$revenus, $depenses, max(0, $bilan)]
        ];

        // Évolution
        $monthlyRevenues = array_fill(1, 12, 0);
        foreach($docs as $d) {
            if(in_array($d->statut, ['paye', 'valide', 'envoye'])) {
                $month = (int)date('m', strtotime($d->date_emission));
                $monthlyRevenues[$month] += $d->total_ttc;
            }
        }

        $revenueEvolution = [
            'labels' => ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
            'values' => array_values($monthlyRevenues)
        ];

        return MadelineView::render('auth/dashboard', [
            'name' => $userName,
            'revenus' => $revenus,
            'revenus_attente' => $revenus_attente,
            'depenses' => $depenses,
            'bilan' => $bilan,
            'countClients' => $countClients,
            'countProducts' => $countProducts,
            'countDocs' => count($docs) + count($contrats),
            'countSent' => $countSent,
            'countRead' => $countRead,
            'chartData' => $chartData,
            'revenueEvolution' => $revenueEvolution,
            'recentDocs' => array_slice($docs, 0, 8),
            'topClients' => $topClients
        ]);
    }
}