<?php
namespace Packages\Http;

/**
 * Request: Gestionnaire de formulaires et requêtes HTTP
 * Framework: Madeline
 */
class Request {
    private array $params;
    private array $errors = [];

    public function __construct() {
        $this->params = array_merge($_GET, $_POST);
    }

    /**
     * Récupère une valeur (POST ou GET)
     */
    public function input(string $key, $default = null) {
        return $this->params[$key] ?? $default;
    }

    /**
     * Récupère toutes les données ou un sous-ensemble
     */
    public function all(array $only = []): array {
        if (!empty($only)) {
            $result = [];
            foreach ($only as $key) {
                $result[$key] = $this->input($key);
            }
            return $result;
        }
        return $this->params;
    }

    /**
     * Validation basique (Wolof Syntax possible?)
     * @param array $rules ['nom' => 'required', 'email' => 'required|email']
     */
    public function validate(array $rules): bool {
        foreach ($rules as $field => $fieldRules) {
            $value = $this->input($field);
            $ruleList = explode('|', $fieldRules);

            foreach ($ruleList as $rule) {
                if ($rule === 'required' && empty($value)) {
                    $this->errors[$field] = "Le champ [{$field}] est obligatoire.";
                }
                if ($rule === 'email' && !empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field] = "L'adresse email est invalide.";
                }
            }
        }
        return empty($this->errors);
    }

    public function hasErrors(): bool {
        return !empty($this->errors);
    }

    public function getErrors(): array {
        return $this->errors;
    }
}
