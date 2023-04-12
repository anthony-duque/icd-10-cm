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

CREATE TABLE ICD_DB.dbo.CDC_ICD_CM_Dump (
	order_no int NOT NULL,
	code varchar(10) NOT NULL,
	header int NOT NULL,
	short_desc varchar(75) NOT NULL,
	long_desc varchar(100) NULL
);
EXEC ICD_DB.sys.sp_addextendedproperty 'MS_Description', N'A table where the values from icdxxcm-order-2023.txt is dumped.', 'schema', N'dbo', 'table', N'CDC_ICD_CM_Dump';
EXEC ICD_DB.sys.sp_addextendedproperty 'MS_Description', N'Would receive characters 1-5 from the record.', 'schema', N'dbo', 'table', N'CDC_ICD_CM_Dump', 'column', N'order_no';
GO;


CREATE TABLE ICD_DB.dbo.tbl_ICD_Lookup (
	order_no int NOT NULL,
	code varchar(10) NOT NULL,
	short_desc varchar(75) NOT NULL,
	long_desc varchar(100) NULL,
	usage_freq INT DEFAULT 0
);

/* Make code the primary key in tbl_ICD_Lookup */
ALTER TABLE ICD_DB.dbo.tbl_ICD_Lookup
ADD CONSTRAINT PK_tbl_ICD_Lookup_code PRIMARY KEY CLUSTERED (code);


INSERT INTO ICD_DB.dbo.tbl_ICD_Lookup
	(order_no, code, short_desc, long_desc)
SELECT order_no, code, short_desc, long_desc
FROM ICD_DB.dbo.CDC_ICD_CM_Dump
WHERE header = 1;


END