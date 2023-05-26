-- Insert sample data into Utilisateur table
INSERT INTO Utilisateur (email, mdp, typeUtilisateur, nivEtude, nom, prenom, ecole, ville)
VALUES
    ('admin@a.a' , 'password1', 'normal', 'M1', 'John', 'Doe', 'University of Example', 'City A'),
    ('admin@a.a' , 'password1', 'normal', 'M1', 'Sam', 'Oussa', 'University of Example', 'City A'),
    ('admin@a.a' , 'password1', 'normal', 'M1', 'Mike', 'Hawk', 'University of Example', 'City A'),
    ('admin@a.a' , 'password1', 'normal', 'M1', 'Nick', 'Dam', 'University of Example', 'City A'),
    ('admin@a.a' , 'password1', 'normal', 'M1', 'Fredo', 'Cerise', 'University of Example', 'City A'),
    ('admin@a.a' , 'password1', 'normal', 'M1', 'Tom', 'Hanks', 'University of Example', 'City A'),
    ('admin@a.a' , 'password1', 'gestionnaire', 'M1', 'Magic', 'System', 'University of Example', 'City A'),
    ('a@a.a', '$2y$10$fZcyBrAKr2bCUmMsviCZteTYI6aVIKm1C5jzeGS70XOZFze8ETjBG', 'gestionnaire', 'L3', 'Jane', 'Smith', 'College of Sample', 'City B'),
    ('b@b.b','password3', 'administrateur', 'D', 'Admin', 'User', 'Admin School', 'City C');

-- Insert sample data into DataEvent table
INSERT INTO DataEvent (typeDataEvent, dateDebut, dateFIN, dateCreation, descript, entreprise, titre, idGestionnaire)
VALUES
    ('DataChallenge', '2023-06-01 09:00:00', '2023-06-05 18:00:00', '2023-05-01 14:30:00', 'Description 1', 'Company A', 'Challenge IA', 7),
    ('DataBattle', '2023-07-10 10:00:00', '2023-07-15 17:00:00', '2023-06-10 16:45:00', 'Description 2', 'Company B', 'Battle learning', 8);

-- Insert sample data into Equipe table
INSERT INTO Equipe (nomEquipe, idDataEvent, idChefEquipe)
VALUES
    ('Fast', 1,2),
    ('Sleep', 2,4),
    ('Dream', 2,5);

-- Insert sample data into UtilisateurAppartientEquipe table
INSERT INTO UtilisateurAppartientEquipe (idUtilisateur, idEquipe)
VALUES
    (1, 2),
    (2, 1),
    (3, 2),
    (4, 2),
    (5, 3),
    (6, 3);

-- Insert sample data into Ressource table
INSERT INTO Ressource (lien, dateAjout)
VALUES
    ('http://example.com/resource1', '2023-05-05 10:30:00'),
    ('http://example.com/resource2', '2023-05-10 14:15:00');

-- Insert sample data into RessourceAppartientDataEvent table
INSERT INTO RessourceAppartientDataEvent (idDataEvent, idRessource)
VALUES
    (1, 1),
    (2, 2);

-- Insert sample data into ProjetData table
INSERT INTO ProjetData (idDataEvent, descriptProjet, idImage)
VALUES
    (1, 'Project 1 Description', 1),
    (2, 'Project 2 Description', 2);

-- Insert sample data into RessourceAppartientProjetData table
INSERT INTO RessourceAppartientProjetData (idProjetData, idRessource)
VALUES
    (1, 2),
    (2, 1);

-- Insert sample data into Contact table
INSERT INTO Contact (idProjetData, nom, prenom, telephone, email)
VALUES
    (1, 'Contact 1 Lastname', 'Contact 1 Firstname', '1234567890', 'contact1@example.com'),
    (2, 'Contact 2 Lastname', 'Contact 2 Firstname', '9876543210', 'contact2@example.com');

-- Insert sample data into Questionnaire table
INSERT INTO Questionnaire (descriptQuestionnaire, idDataEvent)
VALUES
    ('Questionnaire 1 Description', 1),
    ('Questionnaire 2 Description', 2);

-- Insert sample data into Question table
INSERT INTO Question (intitule, idQuestionnaire)
VALUES
    ('Question 1', 1),
    ('Question 2', 1),
    ('Question 3', 2);

-- Insert sample data into Reponse table
INSERT INTO Reponse (note, reponse, idEquipe, idQuestion)
VALUES
    (4, 'Answer 1', 1, 1),
    (3, 'Answer 2', 1, 2),
    (5, 'Answer 3', 2, 3);

-- Insert sample data into Message table
INSERT INTO Message (dateEnvoi, objet, contenu, idEnvoyeur)
VALUES
    ('2023-05-15 11:30:00', 'Message 1', 'Content of message 1: dakndaindajdjadknkandkadnakdnakndkand', 1),
    ('2023-05-20 09:15:00', 'Message 2', 'Content of message 2 : dadadaddadas', 2);

-- Insert sample data into MessageDestinataire table
INSERT INTO MessageDestinataire (idMessage, idDestinataire)
VALUES
    (1, 2),
    (1, 3),
    (2, 1),
    (2, 3);
