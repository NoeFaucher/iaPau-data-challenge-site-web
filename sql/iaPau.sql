drop database if exists iaPau;

create database iaPau;

use iaPau;


-- Utilisateur
create table Utilisateur (
    idUtilisateur INTEGER primary key unique not null auto_increment, mdp VARCHAR(100),
    typeUtilisateur ENUM('gestionaire','normal','administrateur'),
    nivEtude ENUM('L1','L2','L3','M1','M2','D'),
    nom VARCHAR(100),
    prenom VARCHAR(100),
    ecole VARCHAR(100),
    ville VARCHAR(100) 
);

create table DataEvent (
    idDataEvent INTEGER primary key unique not null auto_increment, 
    typeDataEvent ENUM('DataChalenge','DataBattle'),
    dateDebut DATETIME, 
    dateFIN DATETIME,
    dateCreation DATETIME,
    descript TEXT,
    entreprise VARCHAR(100),
    titre VARCHAR(100),
    idGestionnaire INTEGER,
    foreign key fk_Gestionnaire(idGestionnaire) references Utilisateur(idUtilisateur)
);

create table Equipe (
    idEquipe INTEGER primary key unique not null auto_increment,
    nomEquipe VARCHAR(100),
    idDataEvent Integer,
    foreign key fk_DataEvent(idDataEvent) references DataEvent(idDataEvent) on delete cascade
);

create table  UtilisateurAppartientEquipe (
    idUtilisateur INTEGER,
    idEquipe INTEGER,
    constraint pk_AppartientEquipe primary key (idUtilisateur,idEquipe),
    foreign key fk_Utilisateur(idUtilisateur) references Utilisateur(idUtilisateur),
    foreign key fk_Equipe(idEquipe) references Equipe(idEquipe) on delete cascade
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
    descriptProjet TEXT,
    idImage INTEGER,


    foreign key fk_image(idImage) references Ressource(idRessource),
    foreign key fk_DataEvent(idDataEvent) references DataEvent(idDataEvent)
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
    foreign key fk_Questionnaire(idQuestionnaire) references Questionnaire(idQuestionnaire)
);

create table Reponse (
    idReponse INTEGER primary key unique not null auto_increment,
    reponse TEXT,


    idEquipe INTEGER,
    foreign key fk_Equipe(idEquipe) references Equipe(idEquipe),

    idQuestion INTEGER,
    foreign key fk_Question(idQuestion) references Question(idQuestion)
);



