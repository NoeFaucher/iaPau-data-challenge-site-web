drop database if exists iaPau;

create database iaPau;

use iaPau;

-- Utilisateur
create table Utilisateur (
    idUtilisateur INTEGER primary key unique not null auto_increment,
    telephone VARCHAR(100),
    email VARCHAR(100),
    mdp VARCHAR(319),
    typeUtilisateur ENUM('gestionnaire','normal','administrateur'),
    nivEtude ENUM('L1','L2','L3','M1','M2','D'),
    nom VARCHAR(100),
    prenom VARCHAR(100),
    ecole VARCHAR(100),
    ville VARCHAR(100) 
);

create table DataEvent (
    idDataEvent INTEGER primary key unique not null auto_increment, 
    typeDataEvent ENUM('DataChallenge','DataBattle'),
    dateDebut DATETIME,
    dateFin DATETIME,
    dateCreation DATETIME,
    descript TEXT,
    entreprise VARCHAR(100),
    titre VARCHAR(100),
    donnees TEXT,
    consignes TEXT,
    conseils TEXT,
    idGestionnaire INTEGER,
    foreign key fk_Gestionnaire(idGestionnaire) references Utilisateur(idUtilisateur)
);

create table Ressource (
    idRessource INTEGER primary key unique not null auto_increment,
    lien VARCHAR(1000),
    dateAjout DATETIME
);

create table RessourceAppartientDataEvent (
    idDataEvent INTEGER,
    idRessource INTEGER,
    constraint pk_AppartientDataEvent primary key (idDataEvent,idRessource),
    foreign key fk_DataEvent(idDataEvent) references DataEvent(idDataEvent),
    foreign key fk_Ressource(idRessource) references Ressource(idRessource)
);

create table ProjetData (
    idProjetData INTEGER primary key unique not null auto_increment,
    idDataEvent INTEGER,
    titreProjetData TEXT,
    descriptProjet TEXT,
    idImage INTEGER,
    foreign key fk_image(idImage) references Ressource(idRessource),
    foreign key fk_DataEvent(idDataEvent) references DataEvent(idDataEvent)
);

create table Equipe (
    idEquipe INTEGER primary key unique not null auto_increment,
    nomEquipe VARCHAR(100),
    idProjetData INTEGER,
    idChefEquipe INTEGER,
    foreign key fk_ChefEquipe(idChefEquipe) references Utilisateur(idUtilisateur),
    foreign key fk_DataEvent(idProjetData) references ProjetData(idProjetData) on delete cascade
);

create table Rendu (
    idRendu INTEGER primary key unique not null auto_increment,
    dateRendu DATETIME,
    lienRendu TEXT,
    resultatJson TEXT,
    idEquipe INTEGER,
    foreign key fk_Equipe(idEquipe) references Equipe(idEquipe) on delete cascade
);

create table  UtilisateurAppartientEquipe (
    idUtilisateur INTEGER,
    idEquipe INTEGER,
    constraint pk_AppartientEquipe primary key (idUtilisateur,idEquipe),
    foreign key fk_Utilisateur(idUtilisateur) references Utilisateur(idUtilisateur),
    foreign key fk_Equipe(idEquipe) references Equipe(idEquipe) on delete cascade
);

create table RessourceAppartientProjetData (
    idProjetData INTEGER,
    idRessource INTEGER,
    constraint pk_AppartientProjetData primary key (idProjetData,idRessource),
    foreign key fk_DataEvent(idProjetData) references ProjetData(idProjetData),
    foreign key fk_Ressource(idRessource) references Ressource(idRessource)
);

create table Contact (
    idContact INTEGER primary key unique not null auto_increment,
    idProjetData INTEGER,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    telephone VARCHAR(20),
    email VARCHAR(100),
    foreign key fk_ProjetData(idProjetData) references ProjetData(idProjetData) on delete cascade
);

create table Questionnaire (
    idQuestionnaire INTEGER primary key unique not null auto_increment,
    descriptQuestionnaire TEXT,
    idDataEvent INTEGER,
    foreign key fk_DataEvent(idDataEvent) references DataEvent(idDataEvent)
);

create table Question (
    idQuestion INTEGER primary key unique not null auto_increment,
    intitule TEXT,
    idQuestionnaire INTEGER,
    foreign key fk_Questionnaire(idQuestionnaire) references Questionnaire(idQuestionnaire) on delete cascade
);

create table Reponse (
    idReponse INTEGER primary key unique not null auto_increment,
    note INTEGER,
    reponse TEXT,
    idEquipe INTEGER,
    idQuestion INTEGER,
    foreign key fk_Equipe(idEquipe) references Equipe(idEquipe) on delete cascade,
    foreign key fk_Question(idQuestion) references Question(idQuestion) on delete cascade
);

create table Message (
    idMessage INTEGER primary key unique not null auto_increment,
    dateEnvoi DATETIME,
    objet VARCHAR(100),
    contenu TEXT,
    idEnvoyeur INTEGER,
    foreign key fk_Envoyeur(idEnvoyeur) references Utilisateur(idUtilisateur) on delete cascade
);

create table MessageDestinataire (
    idMessage Integer,
    idDestinataire Integer,
    foreign key fk_Message(idMessage) references Message(idMessage) on delete cascade,
    foreign key fk_Destinataire(idDestinataire) references Utilisateur(idUtilisateur) on delete cascade,
    constraint pk_MessageDestinataire primary key (idMessage,idDestinataire)
);

