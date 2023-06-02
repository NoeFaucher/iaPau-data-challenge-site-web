# iaPau-data-challenge-site-web
Projet réalisé au cours du projet de fin d'année Ing1 Cytech par :

Léo-Paul Bigot, Noé Faucher, Sacha Grumelart, Marc-Antoine Vergnet, Hugo Hersant

Notre rapport est présent dans la racine `rapport.pdf`.

Pour pouvoir utiliser notre site sans problèmes :

- Se situer dans l'arborescence au niveau du fichier `index.php`.

- Modifier le fichier `php/bddData.php` en y remplissant vos informations de connexion à mysql-server.

- Se connecter à mysql et executer les deux commandes suivantes :
   
    ```source sql/iaPau.sql;```

    ```source sql/data-sample.sql;```

- Pour lancer le serveur java, exécutez cette commande :

    ```$ java -jar Serveur.jar```

pour le générer :

    
    $ cd serveur
    $ ant 
    $ ant dist
    # Serveur.jar sera dans le répertoire dist


- Quitter mysql et exécuter la commande suivante afin d'héberger localement le site :

    ```php -S localhost:8080```

- Si tout s'est bien passé, la base de donnée ainsi que le serveur php on été initialisé

Vous pouvez désormais accéder au site dans votre navigateur en rentrant l'url suivante : `localhost:8080`.


Pour vous connecter :

L'administrateur a pour identifiant :
    
- email : user5@example.com
- mdp : password5

Un utilisateur test a pour identifiant :
    
- email : user1@example.com
- mdp : password1

Un gestionnaire test a pour identifiant :
    
- email : user3@example.com
- mdp : password3