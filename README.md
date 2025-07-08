## Descrizione

Questo progetto è una CLI in PHP che genera un report delle transazioni di un cliente, leggendo i dati da un file CSV e convertendo gli importi in EUR tramite un webservice fittizio.

## Requisiti
- PHP >= 8.1
- (Opzionale) Docker

## Installazione e avvio

### 1. Clona il repository

```sh
git clone <url-del-tuo-repo>
cd <nome-cartella-progetto>
```

### 2. Avvio **senza Docker**

Assicurati di avere PHP installato. Esegui:

```sh
php scripts/report.php <customer_id>
```
Esempio:
```sh
php scripts/report.php 1
```

### 3. Avvio **con Docker**

1. Costruisci l'immagine:
   ```sh
   docker build -t report-customer .
   ```
2. Esegui il report per un customer (es. id 2):
   ```sh
   docker run --rm report-customer 2
   ```

## Esempio di output

```
Report transazioni per customer 1
Data         | Valore     | EUR      
-------------+------------+-----------
01/04/2015   | £50.00     |    57.50 €
02/04/2015   | £11.04     |    12.70 €
02/04/2015   | €1.00      |     1.00 €
03/04/2015   | $23.05     |    21.21 €
```

## Test

- Per testare la lettura delle transazioni:
  ```sh
  php tests/test_customer.php
  ```
- Per testare la conversione:
  ```sh
  php tests/test_conversion.php
  ```
- Per test automatici con PHPUnit:
  ```sh
  ./vendor/bin/phpunit tests/CurrencyConverterTest.php
  ```

## Note
- Il webservice di cambio valuta è fittizio e restituisce tassi fissi.
- Il file CSV simula una base dati dinamica.
- Il codice è strutturato in modo OOP e facilmente estendibile.

## Estensioni possibili
- API RESTful
- Supporto a nuove valute
- Logging avanzato