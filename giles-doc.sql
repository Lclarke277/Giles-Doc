CREATE DATABASE IF NOT EXISTS giles_docs;
USE giles_docs;

DROP TABLE IF EXISTS docs;

CREATE TABLE IF NOT EXISTS docs (
	document_number varchar(40) NOT NULL,
    revision int(2) NOT NULL,
    description text(500) NOT NULL,
    effective_date varchar(10) NOT NULL,
    primary key (document_number));
    
#INSERT INTO docs (document_number, revision, description, effective_date) VALUES ('DOC-001', '2', 'Description goes here!', '10-10-2010');   
    
SELECT * FROM docs;