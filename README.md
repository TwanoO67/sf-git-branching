# sf-git-branching
Gestionnaire de repo GIT, sous forme de bundle symfony2


INSTALLATION

npm install
composer update

php app/console assets:install
php app/console doctrine:schema:update --env=test --force
grunt serve --force

génération de crud
php app/console generate:doctrine:crud --format=yml --with-write --overwrite
