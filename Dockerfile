FROM php:8.3-cli

CMD ["php", "-S", "0.0.0.0:8000", "-t", "/app"]