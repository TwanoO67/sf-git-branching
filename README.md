# sf-git-branching
Gestionnaire de dépot GIT, sous forme d'application web symfony2
( permet de déployer automatiquement avec GIT en PHP )


[![SensioLabsInsight](https://insight.sensiolabs.com/projects/c4e5d688-c273-4791-8894-c5c2b4d9e408/big.png)](https://insight.sensiolabs.com/projects/c4e5d688-c273-4791-8894-c5c2b4d9e408)

INSTALLATION

Copier app/config/parameters.yml.dist en parameters.yml


npm install
composer update

php app/console assets:install
php app/console doctrine:schema:create
grunt serve --force

génération de crud
php app/console generate:doctrine:crud --format=yml --with-write --overwrite
