-- Utilisateur
INSERT INTO Utilisateur (email, mdp, typeUtilisateur, nivEtude, nom, prenom, ecole, ville)
VALUES
    ('user1@example.com', 'password1', 'normal', 'L1', 'Smith', 'John', 'University A', 'City A'),
    ('user2@example.com', 'password2', 'normal', 'L2', 'Johnson', 'Emily', 'University B', 'City B'),
    ('user3@example.com', 'password3', 'gestionnaire', 'M1', 'Brown', 'Michael', 'University C', 'City C'),
    ('user4@example.com', 'password4', 'gestionnaire', 'L3', 'Davis', 'Sophia', 'University D', 'City D'),
    ('user5@example.com', 'password5', 'administrateur', 'D', 'Miller', 'Oliver', 'University E', 'City E'),
    ('user6@example.com', 'password6', 'normal', 'M2', 'Wilson', 'Emma', 'University F', 'City F');

-- DataEvent
INSERT INTO DataEvent (typeDataEvent, dateDebut, dateFIN, dateCreation, descript, entreprise, titre, idGestionnaire)
VALUES
    ('DataChallenge', '2023-06-01', '2023-06-10', '2023-05-20', 'Data challenge description 1', 'Company A', 'Data Challenge 1', 3),
    ('DataBattle', '2023-07-15', '2023-07-25', '2023-06-01', 'Data battle description 1', 'Company B', 'Data Battle 1', 4),
    ('DataChallenge', '2023-08-10', '2023-08-20', '2023-07-25', 'Data challenge description 2', 'Company C', 'Data Challenge 2', 3),
    ('DataBattle', '2023-09-05', '2023-09-15', '2023-08-20', 'Data battle description 2', 'Company D', 'Data Battle 2', 4),
    ('DataChallenge', '2023-10-01', '2023-10-10', '2023-09-15', 'Data challenge description 3', 'Company E', 'Data Challenge 3', 3),
    ('DataBattle', '2023-11-15', '2023-11-25', '2023-10-01', 'Data battle description 3', 'Company F', 'Data Battle 3', 4);
-- Ressource
INSERT INTO Ressource (lien, dateAjout)
VALUES
    ('http://example.com/resource1', '2023-05-21 10:00:00'),
    ('http://example.com/resource2', '2023-05-22 12:00:00'),
    ('http://example.com/resource3', '2023-05-23 14:00:00'),
    ('http://example.com/resource4', '2023-05-24 16:00:00'),
    ('http://example.com/resource5', '2023-05-25 18:00:00'),
    ('http://example.com/resource6', '2023-05-26 20:00:00');

-- RessourceAppartientDataEvent
INSERT INTO RessourceAppartientDataEvent (idDataEvent, idRessource)
VALUES
    (1, 1),
    (1, 2),
    (2, 3),
    (2, 4),
    (3, 5),
    (3, 6);

-- ProjetData
INSERT INTO ProjetData (idDataEvent, titreProjetData, descriptProjet, idImage)
VALUES
    (1, 'Project Data 1', 'Project data description 1', 1),
    (2, 'Project Data 2', 'Project data description 2', 2),
    (3, 'Project Data 3', 'Project data description 3', 3),
    (4, 'Project Data 4', 'Project data description 4', 4),
    (5, 'Project Data 5', 'Project data description 5', 5),
    (6, 'Project Data 6', 'Project data description 6', 6);
    
-- Equipe
INSERT INTO Equipe (nomEquipe, idProjetData, idChefEquipe)
VALUES
    ('Team 1', 1, 1),
    ('Team 2', 2, 2),
    ('Team 3', 3, 1),
    ('Team 4', 4, 2),
    ('Team 5', 5, 1),
    ('Team 6', 6, 2);

-- Rendu
INSERT INTO Rendu (dateRendu, idEquipe)
VALUES
    ('2023-06-08', 1),
    ('2023-07-23', 2),
    ('2023-08-18', 3),
    ('2023-09-12', 4),
    ('2023-10-08', 5),
    ('2023-11-22', 6);

-- UtilisateurAppartientEquipe
INSERT INTO UtilisateurAppartientEquipe (idUtilisateur, idEquipe)
VALUES
    (1, 1),
    (2, 1),
    (3, 2),
    (4, 2),
    (5, 3),
    (6, 3);


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

-- Questionnaire
INSERT INTO Questionnaire (descriptQuestionnaire, idDataEvent)
VALUES
    ('Questionnaire 1', 1),
    ('Questionnaire 2', 2),
    ('Questionnaire 3', 3),
    ('Questionnaire 4', 4),
    ('Questionnaire 5', 5),
    ('Questionnaire 6', 6);

-- Question
INSERT INTO Question (intitule, idQuestionnaire)
VALUES
    ('Question 1', 1),
    ('Question 2', 1),
    ('Question 3', 2),
    ('Question 4', 2),
    ('Question 5', 3),
    ('Question 6', 3);

-- Reponse
INSERT INTO Reponse (note, reponse, idEquipe, idQuestion)
VALUES
    (4, 'Answer 1', 1, 1),
    (3, 'Answer 2', 1, 2),
    (5, 'Answer 3', 2, 3),
    (2, 'Answer 4', 2, 4),
    (4, 'Answer 5', 3, 5),
    (1, 'Answer 6', 3, 6);

-- Message
INSERT INTO Message (dateEnvoi, objet, contenu, idEnvoyeur)
VALUES
    ('2023-05-25 09:00:00', 'Message 1', 'Message content 1', 1),
    ('2023-05-25 10:00:00', 'Message 2', 'Message content 2', 2),
    ('2023-05-25 11:00:00', 'Message 3', 'Message content 3', 3),
    ('2023-05-25 12:00:00', 'Message 4', 'Message content 4', 4),
    ('2023-05-25 13:00:00', 'Message 5', 'Message content 5', 5),
    ('2023-05-25 14:00:00', 'Message 6', 'Message content 6', 6);

-- MessageDestinataire
INSERT INTO MessageDestinataire (idMessage, idDestinataire)
VALUES
    (1, 2),
    (1, 3),
    (2, 3),
    (2, 4),
    (3, 4),
    (3, 5);

