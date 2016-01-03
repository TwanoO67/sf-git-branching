# sf-git-branching
Interface web de gestion pour vos dépots GIT
( permet de déployer automatiquement avec GIT en PHP, sans utiliser la console ssh )

![Index screenshot](/web/images/screenshots/local-500x500-index.png?raw=true "Index")


[![SensioLabsInsight](https://insight.sensiolabs.com/projects/c4e5d688-c273-4791-8894-c5c2b4d9e408/big.png)](https://insight.sensiolabs.com/projects/c4e5d688-c273-4791-8894-c5c2b4d9e408)
[![Code Climate](https://codeclimate.com/github/TwanoO67/sf-git-branching/badges/gpa.svg)](https://codeclimate.com/github/TwanoO67/sf-git-branching)

# INSTALLATION

Clone du depot sur votre machine

- npm install
- bower install
- composer install

Copier app/config/parameters.yml.dist en parameters.yml

- php app/console doctrine:schema:create
- grunt serve

Commencer par remplir vos depot dans la partie admin (user/mdp -> admin/gitadmin)

Changer les identifiants de connexion dans le fichier app/config/security.yml

# TODOLIST

- Implémenter le pull automatiquement
- Checkout de tag et de branche
- Webhooks depuis github / gitlab
- Ajout de repo par git clone

# Plus d'action

déployer les assets
php app/console assets:install

génération de crud
php app/console generate:doctrine:crud --format=yml --with-write --overwrite

screenshot de l'appli
installer: http://phantomjs.org/download.html
configurer les screenshots dans: Gruntfile.js
(tester que phantomjs soit dans le path est arrive à générer des images)
lancer la commande: grunt autoshot


#Copyright et fork
source: https://github.com/zguillez/generator-symfonangular
