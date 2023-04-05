USE master; 
GO;

IF (db_id('ICD_DB') IS NULL)
BEGIN
	
	CREATE DATABASE 'ICD_DB';
	USE ICD_DB;
	GO;

	CREATE TABLE tblFacility{
		facilityID 	INT AUTOINCREMENT NOT NULL PRIMARY KEY,
		name		VARCHAR(50),
		dateCreated	SMALLDATETIME
	};
	GO;

	CREATE TABLE tblPatient{
		id 			INT NOT NULL,
		firstName	VARCHAR(30),
		lastName	VARCHAR(30),
		gender		CHAR,
		birthDate	SMALLDATETIME,
		mrn			VARCHAR(30),
		dateCreated	SMALLDATETIME
	}
	GO;

	CREATE TABLE tblFacilityPatient{
		id			INT AUTOINCREMENT PRIRMARY KEY
		facilityID	INT NOT NULL,
		patientID	INT NOT NULL
	}
	GO;

	ALTER tblFaciltyPatient 
	ADD CONSTRAINT FK_tblFacilityPatient_facilityID
	FOREIGN KEY (facilityID) REFERENCES tblFacility(id)
	GO;

	ALTER tblFaciltyPatient 
	ADD CONSTRAINT FK_tblFacilityPatient_patientID
	FOREIGN KEY (patientID) REFERENCES tblPatient(id)
	GO;
END