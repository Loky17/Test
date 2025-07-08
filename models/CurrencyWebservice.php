<?php

/**
 * Dummy web service returning random or fixed exchange rates
 * Simula un servizio di cambio valuta restituendo tassi fissi verso EUR.
 */
class CurrencyWebservice
{
    /**
     * Restituisce un tasso di cambio fittizio verso EUR
     * @param string $currency (es: 'GBP', 'USD', 'EUR')
     * @return float Tasso di cambio verso EUR
     */
    public function getExchangeRate($currency)
    {
        // Tassi fissi per semplicità
        switch (strtoupper($currency)) {
            case 'GBP':
                return 1.15; // 1 GBP = 1.15 EUR
            case 'USD':
                return 0.92; // 1 USD = 0.92 EUR
            case 'EUR':
                return 1.0;  // 1 EUR = 1 EUR
            default:
                return 1.0; // fallback
        }
    }
}