# sf-git-branching
Gestionnaire de dépot GIT, sous forme d'application web symfony2
( permet de déployer automatiquement avec GIT en PHP )


[![SensioLabsInsight](https://insight.sensiolabs.com/projects/c4e5d688-c273-4791-8894-c5c2b4d9e408/big.png)](https://insight.sensiolabs.com/projects/c4e5d688-c273-4791-8894-c5c2b4d9e408)
[![Code Climate](https://codeclimate.com/github/TwanoO67/sf-git-branching/badges/gpa.svg)](https://codeclimate.com/github/TwanoO67/sf-git-branching)

INSTALLATION

Copier app/config/parameters.yml.dist en parameters.yml


source: https://github.com/zguillez/generator-symfonangular
npm install
bower install
composer install

php app/console assets:install
php app/console doctrine:schema:create
grunt serve

génération de crud
php app/console generate:doctrine:crud --format=yml --with-write --overwrite

screenshot de l'appli
installer: http://phantomjs.org/download.html
configurer les screenshots dans: Gruntfile.js
(tester que phantomjs soit dans le path est arrive à générer des images)
lancer la commande: grunt autoshot
