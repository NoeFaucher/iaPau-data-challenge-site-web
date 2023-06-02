-- table des utilisateurs

INSERT INTO Utilisateur (email, telephone, mdp, typeUtilisateur, nivEtude, nom, prenom, ecole, ville) VALUES
    ('user1@example.com','0682568741', '$2y$10$8WXSr/ew/4Axsmt6r1vuiunm5bBXsx/Lu/r/GNlTijdx8RwmRSsrm', 'normal', 'L1', 'Smith', 'John', 'University A', 'City A'),
    ('user2@example.com','0682568745', '$2y$10$4uBJHI5.1MeS9IvR.j6QsevXV24qjxwN6Ju10LW.Sm3VH9oKGKKqu', 'normal', 'L2', 'Johnson', 'Emily', 'University B', 'City B'),
    ('user3@example.com','0682565441', '$2y$10$Kk5N.OlCwrxobHiKr2my1OaHRETrTMwXMuf2N4EeOEEvXVmfICj7G', 'gestionnaire', 'M1', 'Brown', 'Michael', 'University C', 'City C'),
    ('user4@example.com','0682567841', '$2y$10$wg.PcU/3QagAFBRI9CBsX.pvHQzupr3yFKvlHwfg8/27FwrZq9ZuO', 'gestionnaire', 'L3', 'Davis', 'Sophia', 'University D', 'City D'),
    ('user5@example.com','0682567441', '$2y$10$hMGftNk7Yt4AqdtgIaloH.XOq4l/igDt3frAUg2qqDR99LYcCt46O', 'administrateur', 'D', 'Miller', 'Oliver', 'University E', 'City E'),
    ('user6@example.com','0682564545', '$2y$10$VCoaTFJZMUmA24VKp5LYt..NwxPwver9aaKJ/o7Gc/XEYFJFqnuNe', 'normal', 'M2', 'Wilson', 'Emma', 'University F', 'City F'),
    ('user7@example.com','0682564444', '$2y$10$XplaSBMvya1D3rSmg1wu7OjTkPt0Sdn2gcwqtfm7mvcB/LFOhvxay', 'normal', 'L1', 'Anderson', 'Sophie', 'University G', 'City G'),
    ('user8@example.com','0682563030', '$2y$10$zJ8X4DKX3tl88oo2RGCtyeBLREz70eD0YyYCxPhc15BmqXBcy8jbC', 'normal', 'L2', 'McArthur', 'Emma', 'University H', 'City H'),
    ('user9@example.com','0682561515', '$2y$10$cAcn0VDR35KZqvJPlhYVq.M93cEBxaG0Z0oWfnRGfFmHMWb3epJdK', 'gestionnaire', 'L3', 'Taylor', 'Noah', 'University I', 'City I'),
    ('user10@example.com','0682567878', '$2y$10$xOnZPQPavEpIGGzU6QeKzufqk/kiifFydfINtOwZrhnPTy8rTBe6.', 'normal', 'M1', 'Clark', 'Ava', 'University J', 'City J'),
    ('user11@example.com' ,'0682569898', '$2y$10$8DUY1oH13s4v/Q7Fxg6ZX.83Rq8JBy9Cx6V0EGN0AZJ4.hEfY7uVq', 'normal', 'M2', 'Moore', 'Liam', 'University K', 'City K'),
    ('user12@example.com' ,'0682566666', '$2y$10$YXNcPHLias0IR9DKsjrboeAs7wniH6B9SpgsWPSkcAubNp/VE.Mby', 'normal', 'L1', 'Lee', 'Mia', 'University L', 'City L');

-- table des data events
INSERT INTO DataEvent (typeDataEvent, dateDebut, dateFin, dateCreation, descript, entreprise, titre, donnees, consignes, conseils, idGestionnaire) VALUES
    ('DataChallenge', '2023-06-12 08:00:00', '2023-06-15 18:00:00', '2023-05-20 10:30:00', "Le challenge consiste à développer un modèle de machine learning utilisant Python pour résoudre un problème spécifique. Vous pouvez choisir parmi différents problèmes liés au machine learning, tels que la classification, la régression, le clustering, ou même le traitement du langage naturel. Votre objectif est de construire un modèle précis et performant en utilisant les compétences que vous avez acquises en Python et en apprentissage automatique.", 'Entreprise n°1', 'Data challenge n°1', "Utilisez des données pertinentes pour votre problème spécifique. Vous pouvez rechercher des ensembles de données publics sur des sites tels que Kaggle, UCI Machine Learning Repository ou utiliser des données spécifiques à votre domaine d'intérêt.", "Concernant le choix du problème, vous êtes invité à sélectionner une tâche spécifique dans le domaine de l'apprentissage automatique sur laquelle vous souhaitez vous concentrer. Il peut s'agir de la classification d'images, de la prédiction de prix, de la détection de spam, ou de toute autre tâche pertinente pour le machine learning. Une fois le problème défini, l'étape suivante consiste à collecter les données nécessaires. Vous pouvez explorer des sources publiques, telles que Kaggle ou l'UCI Machine Learning Repository, pour trouver des ensembles de données adaptés à votre problème. Si besoin, vous pouvez également collecter vos propres données, en veillant à ce qu'elles soient représentatives et pertinentes pour votre projet. Avant de commencer à construire votre modèle, il est essentiel de prétraiter les données. Cela implique des étapes telles que la gestion des valeurs manquantes, la normalisation des données numériques, le codage des variables catégorielles, et éventuellement la réduction de dimension ou le nettoyage des données bruitées. Le prétraitement garantira la qualité des données et préparera une base solide pour l'entraînement de votre modèle. Une fois vos données prétraitées, vous pouvez passer à la construction de votre modèle en utilisant Python. Vous pouvez exploiter des bibliothèques populaires telles que scikit-learn, TensorFlow ou PyTorch, qui offrent un large éventail d'algorithmes et de fonctionnalités pour l'apprentissage automatique. Vous pouvez expérimenter différents algorithmes, ajuster les hyperparamètres, et utiliser des techniques avancées pour améliorer les performances de votre modèle.", '"Explorez et familiarisez-vous avec les bibliothèques de machine learning populaires telles que scikit-learn, TensorFlow et PyTorch. Vous pouvez aussi expérimenter différents algorithmes de machine learning pour comprendre leurs forces et leurs faiblesses. Enfin, prêtez attention au prétraitement des données, car il peut avoir un impact significatif sur les performances de votre modèle."', 3),
    ('DataChallenge', '2023-06-05 10:30:00', '2023-06-16 16:45:00', '2023-05-21 09:15:00', "Le Challenge de Reconnaissance Faciale en ligne consiste à développer un système de reconnaissance faciale utilisant des techniques d'apprentissage automatique et de vision par ordinateur. Votre objectif est de créer un modèle précis et robuste capable de détecter et d'identifier les visages dans des images ou des flux vidéo en temps réel.", 'Atos', 'Reconnaissance faciale', 'Ceci sont les données du data challenge n°2, ceci sont les données du data challenge n°2, ceci sont les données du data challenge n°2, ceci sont les données du data challenge n°2', 'Ceci sont les consignes du data challenge n°2, ceci sont les consignes du data challenge n°2, ceci sont les consignes du data challenge n°2, ceci sont les consignes du data challenge n°2', 'Ceci sont les conseils du data challenge n°2, ceci sont les conseils du data challenge n°2, ceci sont les conseils du data challenge n°2, ceci sont les conseils du data challenge n°2', 4),
    ('DataBattle', '2023-06-01 13:00:00', '2023-06-10 20:30:00', '2023-05-20 11:45:00', 'Ceci est la description du data battle n°1, ceci est la description du data battle n°1, ceci est la description du data battle n°1, ceci est la description du data battle n°1, ceci est la description du data battle n°1', 'Entreprise n°1', 'Data battle n°1', 'Ceci sont les données du data battle n°1, ceci sont les données du data battle n°1, ceci sont les données du data battle n°1, ceci sont les données du data battle n°1', 'Ceci sont les consignes du data battle n°1, ceci sont les consignes du data battle n°1, ceci sont les consignes du data battle n°1, ceci sont les consignes du data battle n°1', 'Ceci sont les conseils du data battle n°1, ceci sont les conseils du data battle n°1, ceci sont les conseils du data battle n°1, ceci sont les conseils du data battle n°1', 3),
    ('DataBattle', '2023-06-15 09:30:00', '2023-06-25 17:00:00', '2023-05-23 14:20:00', 'Ceci est la description du data battle n°2, ceci est la description du data battle n°2, ceci est la description du data battle n°2, ceci est la description du data battle n°2, ceci est la description du data battle n°2', 'Entreprise n°2', 'Data battle n°2', 'Ceci sont les données du data battle n°2, ceci sont les données du data battle n°2, ceci sont les données du data battle n°2, ceci sont les données du data battle n°2', 'Ceci sont les consignes du data battle n°2, ceci sont les consignes du data battle n°2, ceci sont les consignes du data battle n°2, ceci sont les consignes du data battle n°2', 'Ceci sont les conseils du data battle n°2, ceci sont les conseils du data battle n°2, ceci sont les conseils du data battle n°2, ceci sont les conseils du data battle n°2', 4);

INSERT INTO Ressource (lien, dateAjout) VALUES
    ('http://example.com/resource1', '2023-05-21 10:00:00');

-- table des projets data
-- note : il y a bien qu'un seul projet data pour les data battles et plusieurs pour les data challenges
INSERT INTO ProjetData (idDataEvent, titreProjetData, descriptProjet, idImage) VALUES
    (1, 'Projet data n°7', 'Ceci est la description du projet data n°7, ceci est la description du projet data n°7, ceci est la description du projet data n°7, ceci est la description du projet data n°7, ceci est la description du projet data n°7', 1),
    (2, 'Projet data n°8', 'Ceci est la description du projet data n°8, ceci est la description du projet data n°8, ceci est la description du projet data n°8, ceci est la description du projet data n°8, ceci est la description du projet data n°8', 1),
    (3, 'Projet data n°9', 'Ceci est la description du projet data n°9, ceci est la description du projet data n°9, ceci est la description du projet data n°9, ceci est la description du projet data n°9, ceci est la description du projet data n°9', 1),
    (4, 'Projet data n°10', 'Ceci est la description du projet data n°10, ceci est la description du projet data n°10, ceci est la description du projet data n°10, ceci est la description du projet data n°10, ceci est la description du projet data n°10', 1),
    (1, 'Projet data n°11', 'Ceci est la description du projet data n°11, ceci est la description du projet data n°11, ceci est la description du projet data n°11, ceci est la description du projet data n°11, ceci est la description du projet data n°11', 1),
    (2, 'Projet data n°12', 'Ceci est la description du projet data n°12, ceci est la description du projet data n°12, ceci est la description du projet data n°12, ceci est la description du projet data n°12, ceci est la description du projet data n°12', 1),
    (1, 'Projet data n°13', 'Ceci est la description du projet data n°13, ceci est la description du projet data n°13, ceci est la description du projet data n°13, ceci est la description du projet data n°13, ceci est la description du projet data n°13', 1),
    (2, 'Projet data n°14', 'Ceci est la description du projet data n°14, ceci est la description du projet data n°14, ceci est la description du projet data n°14, ceci est la description du projet data n°14, ceci est la description du projet data n°14', 1),
    (1, 'Projet data n°15', 'Ceci est la description du projet data n°15, ceci est la description du projet data n°15, ceci est la description du projet data n°15, ceci est la description du projet data n°15, ceci est la description du projet data n°15', 1);

-- table des équipes
/* notes : 
- un même utilisateur peut être chef de plusieurs équipes à la fois
- tous les chefs d'équipe sont des étudiants ("typeUtilisateur" = "normal")
- un même utilisateur peut participer à plusieurs data events mais qu'à un projet data par data event à la fois
- une équipe ne peut être liée qu'à un seul projet data à la fois (pour le cas ci-dessus : l'utilisateur est dans différentes équipes)
*/
INSERT INTO Equipe (nomEquipe, idProjetData, idChefEquipe) VALUES
    ("Les Faucons Électriques", 1, 1),
    ("Les Vagues Mystiques", 2, 1),
    ("Les Tigres d'Argent", 3, 2);

-- table des rendus
-- note : pas d'attribut idProjetData car chaque équipe ne peut participer qu'à un projet data + Equipe et ProjetData liés
INSERT INTO Rendu (dateRendu, idEquipe, lienRendu, resultatJson)
VALUES
    ('2022-06-08', 1, "https://raw.githubusercontent.com/NoeFaucher/Simulation-Variable-Aleatoire/master/exo1.py", '{"nbLigne" : 49,"nbFonction" : 5,"nbLigneMinFonction" : 5,"nbLigneMaxFonction" : 12,"nbLigneMoyenFonction" : 8.2}'),
    ('2022-07-23', 1, "https://raw.githubusercontent.com/NoeFaucher/Simulation-Variable-Aleatoire/master/exo1.py", '{"nbLigne" : 40,"nbFonction" : 3,"nbLigneMinFonction" : 8,"nbLigneMaxFonction" : 10,"nbLigneMoyenFonction" : 9.2}');

-- UtilisateurAppartientEquipe
-- note : seules les cinq premières équipes sont constituées de "vraies" personnes, les autres possèdent seulement un chef d'équipe
INSERT INTO UtilisateurAppartientEquipe (idUtilisateur, idEquipe) VALUES
    
    -- équipe 1
    (1, 1), -- chef d'équipe
    (2, 1), 
    (3, 1),

    -- équipe 2
    (1, 2), -- chef d'équipe
    (6, 2), 
    (7, 2),
    (8, 2),

    -- équipe 3
    (2, 3), -- chef d'équipe
    (6, 3),
    (7, 3),
    (8, 3),
    (10, 3);

-- Contact
INSERT INTO Contact (idProjetData, nom, prenom, telephone, email)
VALUES
    (1, 'Nom 1', 'Prénom 1', '12 34 56 78 90', 'contact1@example.com'),
    (1, 'Nom 2', 'Prénom 2', '09 87 65 43 21', 'contact2@example.com'),
    (2, 'Nom 3', 'Prénom 3', '11 11 11 11 11', 'contact3@example.com'),
    (2, 'Nom 4', 'Prénom 4', '22 22 22 22 22', 'contact4@example.com'),
    (3, 'Nom 5', 'Prénom 5', '33 33 33 33 33', 'contact5@example.com'),
    (3, 'Nom 6', 'Prénom 6', '44 44 44 44 44', 'contact6@example.com');

-- table des questionnaires
-- note : les questionnaires ne doivent être liés qu'à des data battles
INSERT INTO Questionnaire (titre, idDataEvent, dateCreation) VALUES
    ('Questionnaire 1', 3, '2023-05-15 09:30:00'),
    ('Questionnaire 2', 4, '2023-05-18 14:45:00'),
    ('Questionnaire 3', 3, '2023-05-20 11:20:00'),
    ('Questionnaire 4', 3, '2023-05-22 16:10:00');

-- table des questions
INSERT INTO Question (intitule, idQuestionnaire) VALUES
    ('Question 1', 1),
    ('Question 2', 1),
    ('Question 3', 1),
    ('Question 4', 1),
    ('Question 1', 2),
    ('Question 2', 2),
    ('Question 3', 2),
    ('Question 4', 2),
    ('Question 5', 2),
    ('Question 1', 3),
    ('Question 2', 3),
    ('Question 3', 3),
    ('Question 4', 3),
    ('Question 5', 3),
    ('Question 1', 4),
    ('Question 2', 4),
    ('Question 3', 4),
    ('Question 4', 4);

-- table des réponses des équipes
INSERT INTO Reponse (note, reponse, idEquipe, idQuestion) VALUES
    -- seule équipe inscrite à un data battle : tigres d'argent => idEquipe = 3
    -- est inscrite au data battle 3 => Questionnaires 1, 3, et 4 => Questions 1 à 18 (sauf 5 à 9)
    -- on va supposer qu'elle n'a répondu qu'au questionnaire 3 => 
    -- notes aléatoires
    (1, "Réponse 1", 3, 10),
    (1, "Réponse 2", 3, 11),
    (1, "Réponse 3", 3, 12),
    (1, "Réponse 4", 3, 13),
    (1, "Réponse 5", 3, 14);
