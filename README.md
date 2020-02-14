# MyBestTache2


# Pré-requis: 
 
 Php version 7.2.4 minimum
 Composer version 1.4.1 minimum
 /////////https://getcomposer.org           	 Si pas encore téléchargé
 
 Symfony

--------------------------------------------------------------------------
# Pour vérifier les versions :
	- php -v
	- composer -V 


--------------------------------------------------------------------------


# Symfony project:
	Afin de créer un projet (squelette mvc) : composer create-project symfony/website-skeleton *nom du projet 
	// Dans notre cas, le projet est déjà crée //

--------------------------------------------------------------------------

# Run Server:
 ////////////////////sur localhost:8000
	$ composer require server —dev 
	$ php bin/console server:run  //lancement du serveur local


--------------------------------------------------------------------------

# Bootstrap:
	J’utilise un template de base bootstrap avec un lien externe (bootswatch)
	Si problème d’affichage : composer require twbs/bootstrap / npm install bootstrap@3 

--------------------------------------------------------------------------


# Database : 
*Pour créer sa propre BD (Avec Mamp/Wamp/Lamp + phpmyAdmin )  //https://docs.phpmyadmin.net/fr/latest/setup.html

	.env ->  Réglage de user, root,psswd 
		- php bin/console doctrine:database:create
		- php bin/console make:entity


			--------------------------

*Pour faire la migration après la création ou si la création est déjà disponible (Notre cas) 
	-php bin/console make:migration 
	-php bin/console doctrine:migrations:migrate
	
			--------------------------

*Et enfin créer des fixture pour avoir des fausses données dans les tables: 
	-installation : 
		$  composer ormes-mixtures —dev
		$  php bin/console make:fixtures
			(nom: TacheFixtures)
		$  php bin/console doctrine:fixtures:load
		
			--------------------------

