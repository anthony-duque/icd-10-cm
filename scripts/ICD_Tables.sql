USE master; 
GO;

IF (db_id('ICD_DB') IS NULL)
BEGIN
	
	CREATE DATABASE 'ICD_DB';
	USE ICD_DB;

	CREATE TABLE ICD_DB.dbo.tblStaff (
		id int IDENTITY(0,1) NOT NULL,
		userName varchar(12) NULL,
		firstName varchar(50) NULL,
		lastName varchar(30) NULL,
		roleCode varchar(5) NULL,
		facilityCode varchar(12) NOT NULL,
		active binary(100) DEFAULT 1 NULL,
		dateCreated smalldatetime DEFAULT GETDATE() NOT NULL
	);
	EXEC ICD_DB.sys.sp_addextendedproperty 'MS_Description', N'Stores employees working in every facility.  Each employee is associated with a facility code.', 'schema', N'dbo', 'table', N'tblStaff';
	EXEC ICD_DB.sys.sp_addextendedproperty 'MS_Description', N'Associates the staff with a facility.', 'schema', N'dbo', 'table', N'tblStaff', 'column', N'facilityCode';
	EXEC ICD_DB.sys.sp_addextendedproperty 'MS_Description', N'Indicates whether the staff is still working for the facility.', 'schema', N'dbo', 'table', N'tblStaff', 'column', N'active';

	CREATE TABLE ICD_DB.dbo.tblFacility (
		id int IDENTITY(0,1) NOT NULL,
		facilityCode varchar(12) NOT NULL,
		name varchar(50) NOT NULL,
		phone varchar(15) NULL,
		address varchar(100) NULL,
		active binary(1) DEFAULT 1 NULL,
		dateCreated smalldatetime DEFAULT GETDATE() NULL
	);
	EXEC ICD_DB.sys.sp_addextendedproperty 'MS_Description', N'A table containing each facility(company)', 'schema', N'dbo', 'table', N'tblFacility';
	EXEC ICD_DB.sys.sp_addextendedproperty 'MS_Description', N'The full name of the facilty.', 'schema', N'dbo', 'table', N'tblFacility', 'column', N'name';
	EXEC ICD_DB.sys.sp_addextendedproperty 'MS_Description', N'Flag that indicates whether this facility is still active or not.', 'schema', N'dbo', 'table', N'tblFacility', 'column', N'active';
	EXEC ICD_DB.sys.sp_addextendedproperty 'MS_Description', N'Date this facilty was entered in the database.', 'schema', N'dbo', 'table', N'tblFacility', 'column', N'dateCreated';

	CREATE TABLE ICD_DB.dbo.tblPatient (
		id int IDENTITY(0,1) NOT NULL,
		mrn varchar(50) NULL,
		firstName varchar(50) NULL,
		lastName varchar(50) NOT NULL,
		gender char(1) NULL,
		birthDate smalldatetime NOT NULL,
		dateCreated smalldatetime DEFAULT GETDATE() NULL
	);
	CREATE CLUSTERED INDEX tblPatient_mrn_IDX ON ICD_DB.dbo.tblPatient (mrn);
	EXEC ICD_DB.sys.sp_addextendedproperty 'MS_Description', N'Date this record was created', 'schema', N'dbo', 'table', N'tblPatient', 'column', N'dateCreated';

	GO;

	CREATE TABLE ICD_DB.dbo.tblFacilityPatient{
		id			INT AUTOINCREMENT PRIMARY KEY
		facilityID	INT NOT NULL,
		patientID	INT NOT NULL
	}
	GO;

	CREATE TABLE ICD_DB.dbo.tblStaffRole (
		id int IDENTITY(0,1) NOT NULL,
		roleCode varchar(5) NOT NULL,
		description varchar(25) NULL,
		dateCreated smalldatetime DEFAULT GETDATE() NULL
	);
	EXEC ICD_DB.sys.sp_addextendedproperty 'MS_Description', N'Date this position was created in the database.', 'schema', N'dbo', 'table', N'tblStaffRole', 'column', N'dateCreated';


	ALTER ICD_DB.dbo.tblFaciltyPatient 
	ADD CONSTRAINT FK_tblFacilityPatient_facilityID
	FOREIGN KEY (facilityID) REFERENCES tblFacility(id)
	GO;

	ALTER ICD_DB.dbo.tblFaciltyPatient 
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

DELETE FROM ICD_DB.dbo.tbl_ICD_Lookup;

INSERT INTO ICD_DB.dbo.tbl_ICD_Lookup 
	(order_no, code, short_desc, long_desc)
SELECT 
	order_no, 
	CONCAT(SUBSTRING(code, 1, 3), '.', SUBSTRING(code, 4, 10)),
	short_desc, 
	long_desc
FROM ICD_DB.dbo.CDC_ICD_CM_Dump
WHERE header = 1;

/* 
SELECT * FROM tbl_ICD_Lookup;
*/
END