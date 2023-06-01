# iaPau-data-challenge-site-web
Projet réalisé au cours du projet de fin d'année Ing1 Cytech

Léo-Paul Bigot, Noé Faucher, Sacha Grumelart, Marc-Antoine Vergnet, Hugo Hersant

Pour pouvoir utiliser notre site sans problèmes :

- Se situer dans l'arborescence au niveau du fichier `index.php`.

- Modifier le fichier `php/bddData.php` en y remplissant vos informations de connexion à mysql-server.

- Se connecter à mysql et exectuer les deux commandes suivantes :
   
    ```source sql/iaPau.sql;```

    ```source sql/data-sample.sql;```

- Pour lancer le serveur java, exécutez cette commande :

    ```java -jar Serveur.jar```

- Quitter mysql et exécuter la commande suivante afin d'héberger localement le site :

    ```php -S localhost:8080```

- Si tout s'est bien passé, la base de donnée ainsi que le serveur php on été initialisé

Vous pouvez désormais accéder au site dans votre navigateur en rentrant l'url suivante : `localhost:8080`