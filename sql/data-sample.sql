-- table des utilisateurs
INSERT INTO Utilisateur (email, mdp, typeUtilisateur, nivEtude, nom, prenom, ecole, ville) VALUES
    ('user1@example.com', '$2y$10$8WXSr/ew/4Axsmt6r1vuiunm5bBXsx/Lu/r/GNlTijdx8RwmRSsrm', 'normal', 'L1', 'Smith', 'John', 'University A', 'City A'),
    ('user2@example.com', '$2y$10$4uBJHI5.1MeS9IvR.j6QsevXV24qjxwN6Ju10LW.Sm3VH9oKGKKqu', 'normal', 'L2', 'Johnson', 'Emily', 'University B', 'City B'),
    ('user3@example.com', '$2y$10$Kk5N.OlCwrxobHiKr2my1OaHRETrTMwXMuf2N4EeOEEvXVmfICj7G', 'gestionnaire', 'M1', 'Brown', 'Michael', 'University C', 'City C'),
    ('user4@example.com', '$2y$10$wg.PcU/3QagAFBRI9CBsX.pvHQzupr3yFKvlHwfg8/27FwrZq9ZuO', 'gestionnaire', 'L3', 'Davis', 'Sophia', 'University D', 'City D'),
    ('user5@example.com', '$2y$10$hMGftNk7Yt4AqdtgIaloH.XOq4l/igDt3frAUg2qqDR99LYcCt46O', 'administrateur', 'D', 'Miller', 'Oliver', 'University E', 'City E'),
    ('user6@example.com', '$2y$10$VCoaTFJZMUmA24VKp5LYt..NwxPwver9aaKJ/o7Gc/XEYFJFqnuNe', 'normal', 'M2', 'Wilson', 'Emma', 'University F', 'City F'),
    ('user7@example.com', 'password7', 'normal', 'L1', 'Anderson', 'Sophie', 'University G', 'City G'),
    ('user8@example.com', 'password8', 'normal', 'L2', 'McArthur', 'Emma', 'University H', 'City H'),
    ('user9@example.com', 'password9', 'gestionnaire', 'L3', 'Taylor', 'Noah', 'University I', 'City I'),
    ('user10@example.com', 'password10', 'normal', 'M1', 'Clark', 'Ava', 'University J', 'City J'),
    ('user11@example.com', 'password11', 'normal', 'M2', 'Moore', 'Liam', 'University K', 'City K'),
    ('user12@example.com', 'password12', 'normal', 'L1', 'Lee', 'Mia', 'University L', 'City L'),
    ('user13@example.com', 'password13', 'normal', 'L2', 'Lewis', 'Benjamin', 'University M', 'City M'),
    ('user14@example.com', 'password14', 'normal', 'L3', 'Baker', 'Ella', 'University N', 'City N'),
    ('user15@example.com', 'password15', 'gestionnaire', 'M1', 'Garcia', 'Jacob', 'University O', 'City O'),
    ('user16@example.com', 'password16', 'gestionnaire', 'M2', 'Gonzalez', 'Sophia', 'University P', 'City P'),
    ('user17@example.com', 'password17', 'normal', 'L1', 'Perez', 'Emily', 'University Q', 'City Q'),
    ('user18@example.com', 'password18', 'normal', 'L2', 'Rodriguez', 'Daniel', 'University R', 'City R'),
    ('user19@example.com', 'password19', 'normal', 'L3', 'Smith', 'Michael', 'University S', 'City S'),
    ('user20@example.com', 'password20', 'normal', 'M1', 'Johnson', 'Olivia', 'University T', 'City T'),
    ('user21@example.com', 'password21', 'normal', 'M2', 'Williams', 'William', 'University U', 'City U'),
    ('user22@example.com', 'password22', 'gestionnaire', 'L1', 'Brown', 'Ava', 'University V', 'City V'),
    ('user23@example.com', 'password23', 'normal', 'M1', 'Johnson', 'Olivia', 'University X', 'City X'),
    ('user24@example.com', 'password24', 'normal', 'L2', 'Smith', 'James', 'University Y', 'City Y'),
    ('user25@example.com', 'password25', 'normal', 'M2', 'Taylor', 'Sophia', 'University Z', 'City Z'),
    ('user26@example.com', 'password26', 'normal', 'L1', 'Anderson', 'Oliver', 'University W', 'City W'),
    ('user27@example.com', 'password27', 'normal', 'M1', 'Martinez', 'Emma', 'University U', 'City U'),
    ('user28@example.com', 'password28', 'normal', 'L2', 'Harris', 'Liam', 'University V', 'City V'),
    ('user29@example.com', 'password29', 'normal', 'M2', 'Walker', 'Mia', 'University X', 'City X'),
    ('user30@example.com', 'password30', 'normal', 'L1', 'Clark', 'Ava', 'University Y', 'City Y'),
    ('user31@example.com', 'password31', 'normal', 'M1', 'Garcia', 'Noah', 'University Z', 'City Z'),
    ('user32@example.com', 'password32', 'normal', 'L2', 'Lewis', 'Isabella', 'University W', 'City W'),
    ('user33@example.com', 'password33', 'normal', 'M2', 'Rodriguez', 'Sophia', 'University U', 'City U'),
    ('user34@example.com', 'password34', 'normal', 'L1', 'Adams', 'Elijah', 'University V', 'City V'),
    ('user35@example.com', 'password35', 'normal', 'M1', 'Lee', 'Olivia', 'University X', 'City X'),
    ('user36@example.com', 'password36', 'normal', 'L2', 'Baker', 'Mason', 'University Y', 'City Y'),
    ('user37@example.com', 'password37', 'normal', 'M2', 'Wright', 'Ava', 'University Z', 'City Z');

-- table des data events
INSERT INTO DataEvent (typeDataEvent, dateDebut, dateFIN, dateCreation, descript, entreprise, titre, donnees, consignes, conseils, idGestionnaire) VALUES
    ('DataChallenge', '2023-06-01', '2023-06-10', '2023-05-20', 'Ceci est la description du data challenge n°1, ceci est la description du data challenge n°1, ceci est la description du data challenge n°1, ceci est la description du data challenge n°1, ceci est la description du data challenge n°1', 'Entreprise n°1', 'Data challenge n°1', 'Ceci sont les données du data challenge n°1, ceci sont les données du data challenge n°1, ceci sont les données du data challenge n°1, ceci sont les données du data challenge n°1', 'Ceci sont les consignes du data challenge n°1, ceci sont les consignes du data challenge n°1, ceci sont les consignes du data challenge n°1, ceci sont les consignes du data challenge n°1', 'Ceci sont les conseils du data challenge n°1, ceci sont les conseils du data challenge n°1, ceci sont les conseils du data challenge n°1, ceci sont les conseils du data challenge n°1', 3),
    ('DataChallenge', '2023-06-05', '2023-06-15', '2023-05-21', 'Ceci est la description du data challenge n°2, ceci est la description du data challenge n°2, ceci est la description du data challenge n°2, ceci est la description du data challenge n°2, ceci est la description du data challenge n°2', 'Entreprise n°2', 'Data challenge n°2', 'Ceci sont les données du data challenge n°2, ceci sont les données du data challenge n°2, ceci sont les données du data challenge n°2, ceci sont les données du data challenge n°2', 'Ceci sont les consignes du data challenge n°2, ceci sont les consignes du data challenge n°2, ceci sont les consignes du data challenge n°2, ceci sont les consignes du data challenge n°2', 'Ceci sont les conseils du data challenge n°2, ceci sont les conseils du data challenge n°2, ceci sont les conseils du data challenge n°2, ceci sont les conseils du data challenge n°2', 4),
    ('DataChallenge', '2023-06-10', '2023-06-20', '2023-05-22', 'Ceci est la description du data challenge n°3, ceci est la description du data challenge n°3, ceci est la description du data challenge n°3, ceci est la description du data challenge n°3, ceci est la description du data challenge n°3', 'Entreprise n°3', 'Data challenge n°3', 'Ceci sont les données du data challenge n°3, ceci sont les données du data challenge n°3, ceci sont les données du data challenge n°3, ceci sont les données du data challenge n°3', 'Ceci sont les consignes du data challenge n°3, ceci sont les consignes du data challenge n°3, ceci sont les consignes du data challenge n°3, ceci sont les consignes du data challenge n°3', 'Ceci sont les conseils du data challenge n°3, ceci sont les conseils du data challenge n°3, ceci sont les conseils du data challenge n°3, ceci sont les conseils du data challenge n°3', 9),
    ('DataChallenge', '2023-06-15', '2023-06-25', '2023-05-23', 'Ceci est la description du data challenge n°4, ceci est la description du data challenge n°4, ceci est la description du data challenge n°4, ceci est la description du data challenge n°4, ceci est la description du data challenge n°4', 'Entreprise n°4', 'Data challenge n°4', 'Ceci sont les données du data challenge n°4, ceci sont les données du data challenge n°4, ceci sont les données du data challenge n°4, ceci sont les données du data challenge n°4', 'Ceci sont les consignes du data challenge n°4, ceci sont les consignes du data challenge n°4, ceci sont les consignes du data challenge n°4, ceci sont les consignes du data challenge n°4', 'Ceci sont les conseils du data challenge n°4, ceci sont les conseils du data challenge n°4, ceci sont les conseils du data challenge n°4, ceci sont les conseils du data challenge n°4', 15),
    ('DataChallenge', '2023-06-20', '2023-06-30', '2023-05-24', 'Ceci est la description du data challenge n°5, ceci est la description du data challenge n°5, ceci est la description du data challenge n°5, ceci est la description du data challenge n°5, ceci est la description du data challenge n°5', 'Entreprise n°5', 'Data challenge n°5', 'Ceci sont les données du data challenge n°5, ceci sont les données du data challenge n°5, ceci sont les données du data challenge n°5, ceci sont les données du data challenge n°5', 'Ceci sont les consignes du data challenge n°5, ceci sont les consignes du data challenge n°5, ceci sont les consignes du data challenge n°5, ceci sont les consignes du data challenge n°5', 'Ceci sont les conseils du data challenge n°5, ceci sont les conseils du data challenge n°5, ceci sont les conseils du data challenge n°5, ceci sont les conseils du data challenge n°5', 16),
    ('DataChallenge', '2023-06-25', '2023-07-05', '2023-05-25', 'Ceci est la description du data challenge n°6, ceci est la description du data challenge n°6, ceci est la description du data challenge n°6, ceci est la description du data challenge n°6, ceci est la description du data challenge n°6', 'Entreprise n°6', 'Data challenge n°6', 'Ceci sont les données du data challenge n°6, ceci sont les données du data challenge n°6, ceci sont les données du data challenge n°6, ceci sont les données du data challenge n°6', 'Ceci sont les consignes du data challenge n°6, ceci sont les consignes du data challenge n°6, ceci sont les consignes du data challenge n°6, ceci sont les consignes du data challenge n°6', 'Ceci sont les conseils du data challenge n°6, ceci sont les conseils du data challenge n°6, ceci sont les conseils du data challenge n°6, ceci sont les conseils du data challenge n°6', 22),
    ('DataBattle', '2023-06-01', '2023-06-10', '2023-05-20', 'Ceci est la description du data battle n°1, ceci est la description du data battle n°1, ceci est la description du data battle n°1, ceci est la description du data battle n°1, ceci est la description du data battle n°1', 'Entreprise n°1', 'Data battle n°1', 'Ceci sont les données du data battle n°1, ceci sont les données du data battle n°1, ceci sont les données du data battle n°1, ceci sont les données du data battle n°1', 'Ceci sont les consignes du data battle n°1, ceci sont les consignes du data battle n°1, ceci sont les consignes du data battle n°1, ceci sont les consignes du data battle n°1', 'Ceci sont les conseils du data battle n°1, ceci sont les conseils du data battle n°1, ceci sont les conseils du data battle n°1, ceci sont les conseils du data battle n°1', 3),
    ('DataBattle', '2023-06-15', '2023-06-25', '2023-05-23', 'Ceci est la description du data battle n°2, ceci est la description du data battle n°2, ceci est la description du data battle n°2, ceci est la description du data battle n°2, ceci est la description du data battle n°2', 'Entreprise n°2', 'Data battle n°2', 'Ceci sont les données du data battle n°2, ceci sont les données du data battle n°2, ceci sont les données du data battle n°2, ceci sont les données du data battle n°2', 'Ceci sont les consignes du data battle n°2, ceci sont les consignes du data battle n°2, ceci sont les consignes du data battle n°2, ceci sont les consignes du data battle n°2', 'Ceci sont les conseils du data battle n°2, ceci sont les conseils du data battle n°2, ceci sont les conseils du data battle n°2, ceci sont les conseils du data battle n°2', 4),
    ('DataBattle', '2023-06-20', '2023-06-30', '2023-05-24', 'Ceci est la description du data battle n°3, ceci est la description du data battle n°3, ceci est la description du data battle n°3, ceci est la description du data battle n°3, ceci est la description du data battle n°3', 'Entreprise n°3', 'Data battle n°3', 'Ceci sont les données du data battle n°3, ceci sont les données du data battle n°3, ceci sont les données du data battle n°3, ceci sont les données du data battle n°3', 'Ceci sont les consignes du data battle n°3, ceci sont les consignes du data battle n°3, ceci sont les consignes du data battle n°3, ceci sont les consignes du data battle n°3', 'Ceci sont les conseils du data battle n°3, ceci sont les conseils du data battle n°3, ceci sont les conseils du data battle n°3, ceci sont les conseils du data battle n°3', 9),
    ('DataBattle', '2023-07-05', '2023-07-15', '2023-05-27', 'Ceci est la description du data battle n°4, ceci est la description du data battle n°4, ceci est la description du data battle n°4, ceci est la description du data battle n°4, ceci est la description du data battle n°4', 'Entreprise n°4', 'Data battle n°4', 'Ceci sont les données du data battle n°4, ceci sont les données du data battle n°4, ceci sont les données du data battle n°4, ceci sont les données du data battle n°4', 'Ceci sont les consignes du data battle n°4, ceci sont les consignes du data battle n°4, ceci sont les consignes du data battle n°4, ceci sont les consignes du data battle n°4', 'Ceci sont les conseils du data battle n°4, ceci sont les conseils du data battle n°4, ceci sont les conseils du data battle n°4, ceci sont les conseils du data battle n°4', 15),
    ('DataBattle', '2023-07-10', '2023-07-20', '2023-05-29', 'Ceci est la description du data battle n°5, ceci est la description du data battle n°5, ceci est la description du data battle n°5, ceci est la description du data battle n°5, ceci est la description du data battle n°5', 'Entreprise n°5', 'Data battle n°5', 'Ceci sont les données du data battle n°5, ceci sont les données du data battle n°5, ceci sont les données du data battle n°5, ceci sont les données du data battle n°5', 'Ceci sont les consignes du data battle n°5, ceci sont les consignes du data battle n°5, ceci sont les consignes du data battle n°5, ceci sont les consignes du data battle n°5', 'Ceci sont les conseils du data battle n°5, ceci sont les conseils du data battle n°5, ceci sont les conseils du data battle n°5, ceci sont les conseils du data battle n°5', 16),
    ('DataBattle', '2023-07-15', '2023-07-25', '2023-05-31', 'Ceci est la description du data battle n°6, ceci est la description du data battle n°6, ceci est la description du data battle n°6, ceci est la description du data battle n°6, ceci est la description du data battle n°6', 'Entreprise n°6', 'Data battle n°6', 'Ceci sont les données du data battle n°6, ceci sont les données du data battle n°6, ceci sont les données du data battle n°6, ceci sont les données du data battle n°6', 'Ceci sont les consignes du data battle n°6, ceci sont les consignes du data battle n°6, ceci sont les consignes du data battle n°6, ceci sont les consignes du data battle n°6', 'Ceci sont les conseils du data battle n°6, ceci sont les conseils du data battle n°6, ceci sont les conseils du data battle n°6, ceci sont les conseils du data battle n°6', 22);

-- table des ressources
INSERT INTO Ressource (lien, dateAjout) VALUES
    ('http://example.com/resource1', '2023-05-21 10:00:00'),
    ('http://example.com/resource2', '2023-05-22 12:00:00'),
    ('http://example.com/resource3', '2023-05-23 14:00:00'),
    ('http://example.com/resource4', '2023-05-24 16:00:00'),
    ('http://example.com/resource5', '2023-05-25 18:00:00'),
    ('http://example.com/resource6', '2023-05-26 20:00:00'),
    ('http://example.com/resource7', '2023-05-27 10:00:00'),
    ('http://example.com/resource8', '2023-05-28 12:00:00'),
    ('http://example.com/resource9', '2023-05-29 14:00:00'),
    ('http://example.com/resource10', '2023-05-30 16:00:00'),
    ('http://example.com/resource11', '2023-05-31 18:00:00'),
    ('http://example.com/resource12', '2023-06-01 20:00:00'),
    ('http://example.com/resource13', '2023-06-02 10:00:00'),
    ('http://example.com/resource14', '2023-06-03 12:00:00'),
    ('http://example.com/resource15', '2023-06-04 14:00:00'),
    ('http://example.com/resource16', '2023-06-05 16:00:00'),
    ('http://example.com/resource17', '2023-06-06 18:00:00'),
    ('http://example.com/resource18', '2023-06-07 20:00:00'),
    ('http://example.com/resource19', '2023-06-08 10:00:00'),
    ('http://example.com/resource20', '2023-06-09 12:00:00');

-- RessourceAppartientDataEvent
INSERT INTO RessourceAppartientDataEvent (idDataEvent, idRessource) VALUES
    (1, 1),
    (1, 2),
    (2, 3),
    (2, 4),
    (3, 5),
    (3, 6);

-- table des projets data
-- note : il y a bien qu'un seul projet data pour les data battles et plusieurs pour les data challenges
INSERT INTO ProjetData (idDataEvent, titreProjetData, descriptProjet, idImage) VALUES
    (7, 'Projet data n°1', 'Ceci est la description du projet data n°1, ceci est la description du projet data n°1, ceci est la description du projet data n°1, ceci est la description du projet data n°1, ceci est la description du projet data n°1', 5),
    (8, 'Projet data n°2', 'Ceci est la description du projet data n°2, ceci est la description du projet data n°2, ceci est la description du projet data n°2, ceci est la description du projet data n°2, ceci est la description du projet data n°2', 12),
    (9, 'Projet data n°3', 'Ceci est la description du projet data n°3, ceci est la description du projet data n°3, ceci est la description du projet data n°3, ceci est la description du projet data n°3, ceci est la description du projet data n°3', 8),
    (10, 'Projet data n°4', 'Ceci est la description du projet data n°4, ceci est la description du projet data n°4, ceci est la description du projet data n°4, ceci est la description du projet data n°4, ceci est la description du projet data n°4', 15),
    (11, 'Projet data n°5', 'Ceci est la description du projet data n°5, ceci est la description du projet data n°5, ceci est la description du projet data n°5, ceci est la description du projet data n°5, ceci est la description du projet data n°5', 2),
    (12, 'Projet data n°6', 'Ceci est la description du projet data n°6, ceci est la description du projet data n°6, ceci est la description du projet data n°6, ceci est la description du projet data n°6, ceci est la description du projet data n°6', 11),
    (1, 'Projet data n°7', 'Ceci est la description du projet data n°7, ceci est la description du projet data n°7, ceci est la description du projet data n°7, ceci est la description du projet data n°7, ceci est la description du projet data n°7', 17),
    (2, 'Projet data n°8', 'Ceci est la description du projet data n°8, ceci est la description du projet data n°8, ceci est la description du projet data n°8, ceci est la description du projet data n°8, ceci est la description du projet data n°8', 3),
    (3, 'Projet data n°9', 'Ceci est la description du projet data n°9, ceci est la description du projet data n°9, ceci est la description du projet data n°9, ceci est la description du projet data n°9, ceci est la description du projet data n°9', 6),
    (4, 'Projet data n°10', 'Ceci est la description du projet data n°10, ceci est la description du projet data n°10, ceci est la description du projet data n°10, ceci est la description du projet data n°10, ceci est la description du projet data n°10', 14),
    (5, 'Projet data n°11', 'Ceci est la description du projet data n°11, ceci est la description du projet data n°11, ceci est la description du projet data n°11, ceci est la description du projet data n°11, ceci est la description du projet data n°11', 9),
    (6, 'Projet data n°12', 'Ceci est la description du projet data n°12, ceci est la description du projet data n°12, ceci est la description du projet data n°12, ceci est la description du projet data n°12, ceci est la description du projet data n°12', 1),
    (1, 'Projet data n°13', 'Ceci est la description du projet data n°13, ceci est la description du projet data n°13, ceci est la description du projet data n°13, ceci est la description du projet data n°13, ceci est la description du projet data n°13', 7),
    (2, 'Projet data n°14', 'Ceci est la description du projet data n°14, ceci est la description du projet data n°14, ceci est la description du projet data n°14, ceci est la description du projet data n°14, ceci est la description du projet data n°14', 18),
    (3, 'Projet data n°15', 'Ceci est la description du projet data n°15, ceci est la description du projet data n°15, ceci est la description du projet data n°15, ceci est la description du projet data n°15, ceci est la description du projet data n°15', 4),
    (4, 'Projet data n°16', 'Ceci est la description du projet data n°16, ceci est la description du projet data n°16, ceci est la description du projet data n°16, ceci est la description du projet data n°16, ceci est la description du projet data n°16', 13),
    (5, 'Projet data n°17', 'Ceci est la description du projet data n°17, ceci est la description du projet data n°17, ceci est la description du projet data n°17, ceci est la description du projet data n°17, ceci est la description du projet data n°17', 19),
    (6, 'Projet data n°18', 'Ceci est la description du projet data n°18, ceci est la description du projet data n°18, ceci est la description du projet data n°18, ceci est la description du projet data n°18, ceci est la description du projet data n°18', 10),
    (1, 'Projet data n°19', 'Ceci est la description du projet data n°19, ceci est la description du projet data n°19, ceci est la description du projet data n°19, ceci est la description du projet data n°19, ceci est la description du projet data n°19', 16),
    (2, 'Projet data n°20', 'Ceci est la description du projet data n°20, ceci est la description du projet data n°20, ceci est la description du projet data n°20, ceci est la description du projet data n°20, ceci est la description du projet data n°20', 5),
    (1, 'Projet data n°21', 'Ceci est la description du projet data n°21, ceci est la description du projet data n°21, ceci est la description du projet data n°21, ceci est la description du projet data n°21, ceci est la description du projet data n°21', 8),
    (1, 'Projet data n°22', 'Ceci est la description du projet data n°22, ceci est la description du projet data n°22, ceci est la description du projet data n°22, ceci est la description du projet data n°22, ceci est la description du projet data n°22', 12);

-- table des équipes
/* notes : 
- un même utilisateur peut être chef de plusieurs équipes à la fois
- tous les chefs d'équipe sont des étudiants ("typeUtilisateur" = "normal")
- un même utilisateur peut participer à plusieurs data events mais qu'à un projet data par data event à la fois
- une équipe ne peut être liée qu'à un seul projet data à la fois (pour le cas ci-dessus : l'utilisateur est dans différentes équipes)
*/
INSERT INTO Equipe (nomEquipe, idProjetData, idChefEquipe) VALUES
    ("Les Faucons Électriques", 1, 1),
    ("Les Vagues Mystiques", 7, 1),
    ("Les Tigres d'Argent", 13, 11),
    ("Les Éclairs Lunaires", 13, 20),
    ("Les Guerriers de l'Aube", 19, 8),
    ("Les Tempêtes Célestes", 19, 17),
    ("Les Griffons d'Or", 19, 13),
    ("Les Ombres Éternelles", 21, 10),
    ("Les Dragons de Saphir", 21, 6),
    ("Les Étoiles Filantes", 20, 13),
    ("Les Phénix Enflammés", 8, 14),
    ("Les Gardiens de l'Équilibre", 14, 2),
    ("Les Cavaliers de l'Horizon", 20, 7),
    ("Les Loups Solitaires", 9, 11),
    ("Les Éperviers de Cristal", 15, 18),
    ("Les Fées des Bois", 10, 14),
    ("Les Léopards des Neiges", 16, 13),
    ("Les Étincelles Magiques", 11, 12),
    ("Les Héros de Minuit", 17, 19),
    ("Les Nymphes d'Améthyste", 12, 21);


-- table des rendus
-- note : pas d'attribut idProjetData car chaque équipe ne peut participer qu'à un projet data + Equipe et ProjetData liés
INSERT INTO Rendu (dateRendu, idEquipe,lienRendu,resultatJson)
VALUES
    ('2022-06-08', 7,"https://raw.githubusercontent.com/NoeFaucher/Simulation-Variable-Aleatoire/master/exo1.py", '{"nbLigne" : 49,"nbFonction" : 5,"nbLigneMinFonction" : 5,"nbLigneMaxFonction" : 12,"nbLigneMoyenFonction" : 8.2}'),
    ('2022-07-23', 7,"https://raw.githubusercontent.com/NoeFaucher/Simulation-Variable-Aleatoire/master/exo1.py", '{"nbLigne" : 40,"nbFonction" : 3,"nbLigneMinFonction" : 8,"nbLigneMaxFonction" : 10,"nbLigneMoyenFonction" : 9.2}'),
    ('2022-08-18', 3,"https://raw.githubusercontent.com/NoeFaucher/Simulation-Variable-Aleatoire/master/exo1.py", '{"nbLigne" : 49,"nbFonction" : 5,"nbLigneMinFonction" : 5,"nbLigneMaxFonction" : 2,"nbLigneMoyenFonction" : 10.2}'),
    ('2022-09-12', 7,"https://raw.githubusercontent.com/NoeFaucher/Simulation-Variable-Aleatoire/master/exo1.py", '{"nbLigne" : 70,"nbFonction" : 10,"nbLigneMinFonction" : 9,"nbLigneMaxFonction" : 18,"nbLigneMoyenFonction" : 14.2}'),
    ('2022-10-08', 5,"https://raw.githubusercontent.com/NoeFaucher/Simulation-Variable-Aleatoire/master/exo1.py", '{"nbLigne" : 49,"nbFonction" : 5,"nbLigneMinFonction" : 5,"nbLigneMaxFonction" : 2,"nbLigneMoyenFonction" : 4.2}'),
    ('2022-11-22', 6,"https://raw.githubusercontent.com/NoeFaucher/Simulation-Variable-Aleatoire/master/exo1.py", '{"nbLigne" : 49,"nbFonction" : 5,"nbLigneMinFonction" : 5,"nbLigneMaxFonction" : 2,"nbLigneMoyenFonction" : 4.2}');

-- UtilisateurAppartientEquipe
-- note : seules les cinq premières équipes sont constituées de "vraies" personnes, les autres possèdent seulement un chef d'équipe
INSERT INTO UtilisateurAppartientEquipe (idUtilisateur, idEquipe) VALUES
    
    -- équipe 1
    (7, 1), -- chef d'équipe
    (23, 1), 
    (24, 1),
    (25, 1),
    (26, 1),

    -- équipe 2
    (1, 2), -- chef d'équipe
    (27, 2), 
    (28, 2),
    (29, 2),
    (30, 2),
    (31, 2),
    (32, 2),
    (33, 2),

    -- équipe 3
    (11, 3), -- chef d'équipe
    (34, 3),
    (35, 3),
    (36, 3),
    (37, 3);

-- RessourceAppartientProjetData
INSERT INTO RessourceAppartientProjetData (idProjetData, idRessource)
VALUES
    (1, 1),
    (1, 2),
    (2, 3),
    (2, 4),
    (3, 5),
    (3, 6);

-- Contact
INSERT INTO Contact (idProjetData, nom, prenom, telephone, email)
VALUES
    (1, 'Contact 1', 'Person 1', '1234567890', 'contact1@example.com'),
    (1, 'Contact 2', 'Person 2', '0987654321', 'contact2@example.com'),
    (2, 'Contact 3', 'Person 3', '1111111111', 'contact3@example.com'),
    (2, 'Contact 4', 'Person 4', '2222222222', 'contact4@example.com'),
    (3, 'Contact 5', 'Person 5', '3333333333', 'contact5@example.com'),
    (3, 'Contact 6', 'Person 6', '4444444444', 'contact6@example.com');

-- table des questionnaires
-- note : les questionnaires ne doivent être liés qu'à des data battles
INSERT INTO Questionnaire (descriptQuestionnaire, idDataEvent) VALUES
    ('Questionnaire 1', 7),
    ('Questionnaire 2', 8),
    ('Questionnaire 3', 9),
    ('Questionnaire 4', 10),
    ('Questionnaire 5', 11),
    ('Questionnaire 6', 12);

-- table des questions
INSERT INTO Question (intitule, idQuestionnaire) VALUES
    ('[idDataEvent = 7] Question 1', 1),
    ('[idDataEvent = 7] Question 2', 1),
    ('[idDataEvent = 7] Question 3', 1),
    ('[idDataEvent = 7] Question 4', 1),
    ('[idDataEvent = 8] Question 1', 2),
    ('[idDataEvent = 8] Question 2', 2),
    ('[idDataEvent = 8] Question 3', 2),
    ('[idDataEvent = 8] Question 4', 2),
    ('[idDataEvent = 8] Question 5', 2),
    ('[idDataEvent = 9] Question 1', 3),
    ('[idDataEvent = 9] Question 2', 3),
    ('[idDataEvent = 9] Question 3', 3),
    ('[idDataEvent = 9] Question 4', 3),
    ('[idDataEvent = 9] Question 5', 3),
    ('[idDataEvent = 10] Question 1', 4),
    ('[idDataEvent = 10] Question 2', 4),
    ('[idDataEvent = 10] Question 3', 4),
    ('[idDataEvent = 10] Question 4', 4),
    ('[idDataEvent = 11] Question 1', 5),
    ('[idDataEvent = 11] Question 2', 5),
    ('[idDataEvent = 11] Question 3', 5),
    ('[idDataEvent = 11] Question 4', 5),
    ('[idDataEvent = 11] Question 5', 5),
    ('[idDataEvent = 12] Question 1', 6),
    ('[idDataEvent = 12] Question 2', 6),
    ('[idDataEvent = 12] Question 3', 6),
    ('[idDataEvent = 12] Question 4', 6),
    ('[idDataEvent = 12] Question 5', 6);

-- table des réponses des équipes
INSERT INTO Reponse (note, reponse, idEquipe, idQuestion) VALUES

    -- projet data 1 <=> data event 7 => questionnaire 1 => questions 1, 2, 3, 4
    (1, '[équipe 1] Réponse 1', 1, 1),
    (0, '[équipe 1] Réponse 2', 1, 2),
    (1, '[équipe 1] Réponse 3', 1, 3),
    (1, '[équipe 1] Réponse 4', 1, 4),
    
    (0, '[équipe 8] Réponse 1', 8, 1),
    (1, '[équipe 8] Réponse 2', 8, 2),
    (0, '[équipe 8] Réponse 3', 8, 3),
    (1, '[équipe 8] Réponse 4', 8, 4),

    -- projet data 2 <=> data event 8 => questionnaire 2 => questions 5, 6, 7, 8, 9
    (1, '[équipe 2] Réponse 5', 2, 5),
    (0, '[équipe 2] Réponse 6', 2, 6),
    (1, '[équipe 2] Réponse 7', 2, 7),
    (1, '[équipe 2] Réponse 8', 2, 8),
    (0, '[équipe 2] Réponse 9', 2, 9),

    -- projet data 3 <=> data event 9 => questionnaire 3 => questions 10, 11, 12, 13, 14
    -- on va supposer que cette équipe n'a pas encore répondu
    /*
    (1, '[équipe 3] Réponse 10', 3, 10),
    (0, '[équipe 3] Réponse 11', 3, 11),
    (1, '[équipe 3] Réponse 12', 3, 12),
    (1, '[équipe 3] Réponse 13', 3, 13),
    (0, '[équipe 3] Réponse 14', 3, 14),
    */

    -- projet data 4 <=> data event 10 => questionnaire 4 => questions 15, 16, 17, 18
    (0, '[équipe 4] Réponse 15', 4, 15),
    (1, '[équipe 4] Réponse 16', 4, 16),
    (0, '[équipe 4] Réponse 17', 4, 17),
    (1, '[équipe 4] Réponse 18', 4, 18),
    
    (1, '[équipe 7] Réponse 15', 7, 15),
    (0, '[équipe 7] Réponse 16', 7, 16),
    (1, '[équipe 7] Réponse 17', 7, 17),
    (1, '[équipe 7] Réponse 18', 7, 18),

    -- projet data 5 <=> data event 11 => questionnaire 5 => questions 19, 20, 21, 22, 23
    -- on va supposer que cette équipe n'a pas encore répondu
    /*
    (1, '[équipe 5] Réponse 19', 5, 19),
    (0, '[équipe 5] Réponse 20', 5, 20),
    (1, '[équipe 5] Réponse 21', 5, 21),
    (1, '[équipe 5] Réponse 22', 5, 22),
    (0, '[équipe 5] Réponse 23', 5, 23),
    */

    -- projet data 6 <=> data event 12 => questionnaire 6 => questions 24, 25, 26, 27, 28
    (0, '[équipe 6] Réponse 24', 6, 24),
    (1, '[équipe 6] Réponse 25', 6, 25),
    (0, '[équipe 6] Réponse 26', 6, 26),
    (1, '[équipe 6] Réponse 27', 6, 27),
    (0, '[équipe 6] Réponse 28', 6, 28),

    (1, '[équipe 13] Réponse 24', 13, 24),
    (0, '[équipe 13] Réponse 25', 13, 25),
    (1, '[équipe 13] Réponse 26', 13, 26),
    (1, '[équipe 13] Réponse 27', 13, 27),
    (0, '[équipe 13] Réponse 28', 13, 28);

-- Message
INSERT INTO Message (dateEnvoi, objet, contenu, idEnvoyeur)
VALUES
    ('2023-05-25 09:00:00', 'Message 1', 'Message content 1', 1),
    ('2023-05-25 10:00:00', 'Message 2', 'Message content 2', 2),
    ('2023-05-25 11:00:00', 'Message 3', 'Message content 3', 3),
    ('2023-05-25 12:00:00', 'Message 4', 'Message content 4', 4);

