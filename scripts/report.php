<?php
require_once __DIR__ . '/../models/Customer.php';
require_once __DIR__ . '/../models/CurrencyWebservice.php';
require_once __DIR__ . '/../models/CurrencyConverter.php';

// Script CLI per generare un report delle transazioni di un customer
// Gestione errori: file CSV mancante o non leggibile

// Recupera l'id del customer da linea di comando
if ($argc < 2) {
    echo "Utilizzo: php scripts/report.php <customer_id>\n";
    exit(1);
}
$customerId = $argv[1];

$csvPath = __DIR__ . '/../data.csv';
if (!file_exists($csvPath) || !is_readable($csvPath)) {
    echo "Errore: file data.csv mancante o non leggibile.\n";
    exit(2);
}

$customer = new Customer($customerId, $csvPath);
$webservice = new CurrencyWebservice();
$converter = new CurrencyConverter($webservice);

$transactions = $customer->getTransactions();

if (empty($transactions)) {
    echo "Nessuna transazione trovata per il customer $customerId.\n";
    exit(0);
}

// Stampa report formattato
printf("Report transazioni per customer %s\n", $customerId);
printf("%-12s | %-10s | %-11s\n", 'Data', 'Valore', 'EUR');
printf("%-12s-+-%-10s-+-%-11s\n", str_repeat('-', 12), str_repeat('-', 10), str_repeat('-', 11));
foreach ($transactions as $t) {
    $eur = $converter->convert($t['value']);
    printf("%-12s | %-10s | €%8.2f\n", $t['date'], $t['value'], $eur);
}
