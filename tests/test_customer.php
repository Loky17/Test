<?php
require_once __DIR__ . '/models/Customer.php';

$customerId = 1; // Cambia questo valore per testare altri clienti
$customer = new Customer($customerId, __DIR__ . '/data.csv');

$transactions = $customer->getTransactions();

print_r($transactions);
