<?php

/**
 * Usa CurrencyWebservice per convertire importi in EUR
 * Gestisce importi in formato '£50.00', '$10.00', '€5.00'.
 */
class CurrencyConverter
{
    private $webservice;

    /**
     * Costruttore
     * @param CurrencyWebservice $webservice
     */
    public function __construct(CurrencyWebservice $webservice)
    {
        $this->webservice = $webservice;
    }

    /**
     * Converte un importo (es: '£50.00', '$10.00', '€5.00') in EUR
     * @param string $amount
     * @return float Importo convertito in EUR
     */
    public function convert($amount)
    {
        $amount = trim($amount); // rimuove spazi
        // Riconosci simbolo valuta
        if (preg_match('/^([£$€])\s*([0-9]+[.,]?[0-9]*)$/u', $amount, $matches)) {
            $symbol = $matches[1];
            $value = floatval(str_replace([','], ['.'], $matches[2]));
            switch ($symbol) {
                case '£': $currency = 'GBP'; break;
                case '$': $currency = 'USD'; break;
                case '€': $currency = 'EUR'; break;
                default: $currency = 'EUR'; break;
            }
            $rate = $this->webservice->getExchangeRate($currency);
            return round($value * $rate, 2);
        }
        // Se non riconosciuto, restituisci 0
        return 0.0;
    }
}