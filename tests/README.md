# Unit Tests

Questo progetto include alcuni script di test per verificare il corretto funzionamento delle classi principali.

## Setup PHPUnit

1. Assicurati di avere Composer installato.
2. Installa PHPUnit come dipendenza di sviluppo:
   ```sh
   composer require --dev phpunit/phpunit
   ```
3. Dopo l'installazione, puoi lanciare i test con:
   ```sh
   ./vendor/bin/phpunit tests
   ```
   oppure su Windows:
   ```sh
   vendor\bin\phpunit tests
   ```

## Test disponibili

### 1. Test lettura transazioni (`test_customer.php`)

**Cosa fa:**
- Verifica che la classe `Customer` legga correttamente le transazioni dal file CSV per un determinato customer id.

**Esecuzione:**
```
php test_customer.php
```

**Output atteso (esempio per customer 1):**
```
Array
(
    [0] => Array
        (
            [date] => 01/04/2015
            [value] => £50.00
        )
    [1] => Array
        (
            [date] => 02/04/2015
            [value] => £11.04
        )
    [2] => Array
        (
            [date] => 02/04/2015
            [value] => €1.00
        )
    [3] => Array
        (
            [date] => 03/04/2015
            [value] => $23.05
        )
)
```

---

### 2. Test conversione valuta (`test_conversion.php`)

**Cosa fa:**
- Verifica che la classe `CurrencyConverter` converta correttamente i valori in EUR.

**Esecuzione:**
```
php test_conversion.php
```

**Output atteso (esempio per customer 1):**
```
01/04/2015 | £50.00 => 57.50 EUR
02/04/2015 | £11.04 => 12.70 EUR
02/04/2015 | €1.00 => 1.00 EUR
03/04/2015 | $23.05 => 21.21 EUR
```

---

### 3. Test report completo (CLI)

**Cosa fa:**
- Verifica che lo script `scripts/report.php` generi un report formattato e corretto per un customer id.

**Esecuzione:**
```
php scripts/report.php 2
```

**Output atteso:**
```
Report transazioni per customer 2
Data         | Valore     | EUR      
-------------+------------+-----------
01/04/2015   | $66.10     |    60.81 €
02/04/2015   | €12.00     |    12.00 €
02/04/2015   | £6.50      |     7.48 €
04/04/2015   | €6.50      |     6.50 €
```

---

### 4. Test automatici con PHPUnit (`CurrencyConverterTest.php`)

**Cosa fa:**
- Esegue test automatici sulle conversioni di valuta.

**Esecuzione:**
```
./vendor/bin/phpunit tests/CurrencyConverterTest.php
```

**Output atteso:**
```
....                                                                4 / 4 (100%)

OK (4 tests, 4 assertions)
```

## Note
- Puoi aggiungere altri test nella cartella `tests/`.
- PHPUnit può essere integrato in CI/CD (GitHub Actions, GitLab CI, ecc.).