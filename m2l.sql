#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Fonction
#------------------------------------------------------------

CREATE TABLE Fonction(
        idFonct Int  Auto_increment  NOT NULL ,
        libelle Varchar (255) NOT NULL
	,CONSTRAINT Fonction_PK PRIMARY KEY (idFonct)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Formation
#------------------------------------------------------------

CREATE TABLE Formation(
        idForma                  Int  Auto_increment  NOT NULL ,
        intitule                 Text NOT NULL ,
        descriptif               Text NOT NULL ,
        duree                    Int NOT NULL ,
        dateOuvertureInscription Date NOT NULL ,
        dateClotureInscription   Date NOT NULL ,
        effectifMax              Varchar (250) NOT NULL
	,CONSTRAINT Formation_PK PRIMARY KEY (idForma)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Ligue
#------------------------------------------------------------

CREATE TABLE Ligue(
        idLigue    Int  Auto_increment  NOT NULL ,
        nomLigue   Varchar (255) NOT NULL ,
        site       Varchar (255) NOT NULL ,
        descriptif Text NOT NULL
	,CONSTRAINT Ligue_PK PRIMARY KEY (idLigue)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: departement
#------------------------------------------------------------

CREATE TABLE departement(
        idDepartement   Int  Auto_increment  NOT NULL ,
        codeDepartement Int NOT NULL
	,CONSTRAINT departement_PK PRIMARY KEY (idDepartement)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commune
#------------------------------------------------------------

CREATE TABLE commune(
        idCommune     Int  Auto_increment  NOT NULL ,
        codePostal    Integer NOT NULL ,
        nomCommune    Text NOT NULL ,
        idDepartement Int NOT NULL
	,CONSTRAINT commune_PK PRIMARY KEY (idCommune)

	,CONSTRAINT commune_departement_FK FOREIGN KEY (idDepartement) REFERENCES departement(idDepartement)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Club
#------------------------------------------------------------

CREATE TABLE Club(
        idClub      Int  Auto_increment  NOT NULL ,
        nomClub     Varchar (255) NOT NULL ,
        adresseClub Varchar (255) NOT NULL ,
        idLigue     Int NOT NULL ,
        idCommune   Int NOT NULL
	,CONSTRAINT Club_PK PRIMARY KEY (idClub)

	,CONSTRAINT Club_Ligue_FK FOREIGN KEY (idLigue) REFERENCES Ligue(idLigue)
	,CONSTRAINT Club_commune0_FK FOREIGN KEY (idCommune) REFERENCES commune(idCommune)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Utilisateur
#------------------------------------------------------------

CREATE TABLE Utilisateur(
        idUser   Int  Auto_increment  NOT NULL ,
        nom      Varchar (255) NOT NULL ,
        prenom   Varchar (255) NOT NULL ,
        login    Varchar (255) NOT NULL ,
        mdp      Varchar (255) NOT NULL ,
        statut   Varchar (255) NOT NULL ,
        typeUser Varchar (255) NOT NULL ,
        idFonct  Int NOT NULL ,
        idLigue  Int ,
        idClub   Int
	,CONSTRAINT Utilisateur_PK PRIMARY KEY (idUser)

	,CONSTRAINT Utilisateur_Fonction_FK FOREIGN KEY (idFonct) REFERENCES Fonction(idFonct)
	,CONSTRAINT Utilisateur_Ligue0_FK FOREIGN KEY (idLigue) REFERENCES Ligue(idLigue)
	,CONSTRAINT Utilisateur_Club1_FK FOREIGN KEY (idClub) REFERENCES Club(idClub)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Contrat
#------------------------------------------------------------

CREATE TABLE Contrat(
        idContrat   Int  Auto_increment  NOT NULL ,
        dateDebut   Date NOT NULL ,
        dateFin     Date NOT NULL ,
        typeContrat Varchar (50) NOT NULL ,
        nbHeures    Varchar (50) NOT NULL ,
        idUser      Int NOT NULL
	,CONSTRAINT Contrat_PK PRIMARY KEY (idContrat)

	,CONSTRAINT Contrat_Utilisateur_FK FOREIGN KEY (idUser) REFERENCES Utilisateur(idUser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Buletin
#------------------------------------------------------------

CREATE TABLE Buletin(
        idBuletin  Int  Auto_increment  NOT NULL ,
        mois       Int NOT NULL ,
        annee      Int NOT NULL ,
        buletinPDF Varchar (255) NOT NULL ,
        idContrat  Int NOT NULL
	,CONSTRAINT Buletin_PK PRIMARY KEY (idBuletin)

	,CONSTRAINT Buletin_Contrat_FK FOREIGN KEY (idContrat) REFERENCES Contrat(idContrat)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Effectue
#------------------------------------------------------------

CREATE TABLE Effectue(
        idForma         Int NOT NULL ,
        idUser          Int NOT NULL ,
        EtatInscription Text NOT NULL ,
        DateInscription Text NOT NULL
	,CONSTRAINT Effectue_PK PRIMARY KEY (idForma,idUser)

	,CONSTRAINT Effectue_Formation_FK FOREIGN KEY (idForma) REFERENCES Formation(idForma)
	,CONSTRAINT Effectue_Utilisateur0_FK FOREIGN KEY (idUser) REFERENCES Utilisateur(idUser)
)ENGINE=InnoDB;

