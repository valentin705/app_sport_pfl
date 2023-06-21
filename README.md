# app_sport_pfl
Projet fil rouge symfony en collaboration avec Zakkios

Installation
Clonez ce dépôt sur votre machine locale : 
git clone <URL_DU_DÉPÔT>

Installez les dépendances du projet avec Composer.
composer install

Configurez les paramètres de l'application en créant le fichier .env et en le personnalisant selon vos besoins.

Créez la base de données et exécutez les migrations.
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

(Optionnel) Chargez les données de test avec les fixtures.
php bin/console doctrine:fixtures:load
