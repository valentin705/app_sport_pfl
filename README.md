# app_sport_pfl
Projet fil rouge symfony en collaboration avec Zakkios

### 1. Clonez ce dépôt sur votre machine locale:
```
git clone https://github.com/valentin705/app_sport_pfl.git
```

### 2. Installez les dépendances du projet avec Composer:
```
composer install
```

### 3. Créer la connexion à la bdd le fichier .env.local

### 4. Créez la base de données et exécutez les migrations :
```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5. (Optionnel) Chargez les données de test avec les fixtures ou insérez le script d'initialisation pour les catégories
```
php bin/console doctrine:fixtures:load
```

### 6. Installer symfony cli

### 7. Exécutez le serveur symfony
```
symfony serve -d
```
