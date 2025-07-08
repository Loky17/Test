<?php

/**
 * Classe che rappresenta un customer e permette di ottenere le sue transazioni dal file CSV.
 */
class Customer
{
    private $id;
    private $csvFile;

    /**
     * Costruttore
     * @param int $id ID del customer
     * @param string $csvFile Percorso al file CSV
     */
    public function __construct($id, $csvFile = 'data.csv')
    {
        $this->id = $id;
        $this->csvFile = $csvFile;
    }

    /**
     * Restituisce le transazioni del customer come array associativo
     * Ogni transazione: ['date' => ..., 'value' => ...]
     * @return array
     */
    public function getTransactions()
    {
        $transactions = [];
        if (($file = fopen($this->csvFile, 'r')) !== false) {
            $header = fgetcsv($file, 0, ';', '"', '\\'); // enclosure e escape
            while (($row = fgetcsv($file, 0, ';', '"', '\\')) !== false) {
                if ($row[0] == $this->id) {
                    // Rimuovi eventuali virgolette dai valori
                    $date = trim($row[1], '"');
                    $value = trim($row[2], '"');
                    $transactions[] = [
                        'date' => $date,
                        'value' => $value
                    ];
                }
            }
            fclose($file);
        }
        return $transactions;
    }
}
