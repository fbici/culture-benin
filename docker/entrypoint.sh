#!/bin/bash
set -e

# Exécuter le script de déploiement
/var/www/html/deploy.sh

# Démarrer Apache en premier plan
exec apache2-foreground