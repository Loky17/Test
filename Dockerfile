# Dockerfile per CLI report transazioni customer
FROM php:8.2-cli

WORKDIR /app

COPY . /app

# Comando di default: mostra help se non passi argomenti
ENTRYPOINT ["php", "scripts/report.php"]
CMD ["1"]
