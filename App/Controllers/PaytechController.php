<?php
namespace App\Controllers;

use Packages\Paytech\Paytech;
use App\Models\Document;

class PaytechController {
    public function init($doc_id) {
        $paytech = new Paytech();
        
        // Simulation document
        $response = $paytech->send(
            "Facture #$doc_id", 
            5000, 
            $doc_id, 
            "MDL-$doc_id"
        );

        if (isset($response['success']) && $response['success'] == 1) {
            header("Location: " . $response['redirect_url']);
            exit;
        }

        return "Erreur Paytech : " . ($response['error'] ?? 'Inconnue');
    }

    public function success() {
        return "Paiement réussi ! Votre facture a été mise à jour.";
    }

    public function cancel() {
        return "Paiement annulé.";
    }
}
