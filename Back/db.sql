CREATE DATABASE IF NOT EXISTS projet_web;

USE projet_web;

DROP TABLE IF EXISTS USERS;
DROP TABLE IF EXISTS COORDINATES;
DROP TABLE IF EXISTS FEATURES;
DROP TABLE IF EXISTS QUESTIONS;
DROP TABLE IF EXISTS RESPONSES;
DROP TABLE IF EXISTS MAPS;
DROP TABLE IF EXISTS COORDINATES;
DROP TABLE IF EXISTS TOPICS;
DROP TABLE IF EXISTS SCORES;

CREATE TABLE USERS (
    ID_USER     INT     AUTO_INCREMENT,
    FIRSTNAME   VARCHAR(30) NOT NULL,
    LASTNAME    VARCHAR(30) NOT NULL,
    PSEUDO      VARCHAR(30) NOT NULL,
    PASSWORD    VARCHAR(255) NOT NULL,
    ROLE        VARCHAR(10) NOT NULL,
    ACTIVE      TINYINT(1)  NOT NULL,
    CREATE_AT   DATETIME DEFAULT CURRENT_TIMESTAMP,
    UPDATE_AT   DATETIME ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (ID_USER),
    CONSTRAINT UC_USER UNIQUE (LASTNAME, FIRSTNAME, PSEUDO)
);

CREATE TABLE TOPICS (
    ID_TOPIC   INT     AUTO_INCREMENT,
    NAME        VARCHAR(200) UNIQUE,
    ENABLED      TINYINT(1) DEFAULT 1,
    PRIMARY KEY (ID_TOPIC)
);

CREATE TABLE SCORES (
  ID_SCORE  INT   AUTO_INCREMENT,
  USER_ID   INT   NOT NULL,
  TOPIC_ID  INT   NOT NULL,
  SCORE     INT   unsigned NOT NULL,
  PRIMARY KEY (ID_SCORE),
  FOREIGN KEY (USER_ID) REFERENCES USERS (ID_USER),
  FOREIGN KEY (TOPIC_ID) REFERENCES TOPICS (ID_TOPIC)
);

CREATE TABLE COORDINATES (
	ID_COORDINATE		INT 	AUTO_INCREMENT,
  LATITUDE        DOUBLE  NOT NULL,
  LONGITUDE       DOUBLE  NOT NULL,
  PRIMARY KEY	(ID_COORDINATE)
);

CREATE TABLE RESPONSES (
    ID_RESPONSE     INT     AUTO_INCREMENT,
  	COORDINATE_ID		INT NOT NULL,
  	MARGINERROR			DOUBLE	NOT NULL,
    PRIMARY KEY (ID_RESPONSE),
  	FOREIGN KEY (COORDINATE_ID) REFERENCES COORDINATES (ID_COORDINATE)
);

CREATE TABLE MAPS (
		ID_MAP		INT AUTO_INCREMENT,
  	COORDINATE_ID		INT NOT NULL,
  	ZOOMMAX		INT 		NOT NULL,
  	ZOOMMIN		INT     NOT NULL,
  	PRIMARY KEY (ID_MAP),
  	FOREIGN KEY (COORDINATE_ID) REFERENCES COORDINATES (ID_COORDINATE)
);

CREATE TABLE QUESTIONS (
    ID_QUESTION     INT     AUTO_INCREMENT,
    TITLE           VARCHAR(200) NOT NULL,
    TOPIC_ID        INT NOT NULL,
    RESPONSE_ID     INT NOT NULL,
    MAP_ID			INT NOT NULL,
    ENABLED      TINYINT(1) DEFAULT 1,
    PRIMARY KEY (ID_QUESTION),
  	CONSTRAINT UC_QUESTION UNIQUE (TITLE),
  	FOREIGN KEY (RESPONSE_ID) REFERENCES RESPONSES (ID_RESPONSE),
  	FOREIGN KEY (TOPIC_ID) REFERENCES TOPICS (ID_TOPIC),
  	FOREIGN KEY (MAP_ID) REFERENCES MAPS (ID_MAP)
);

CREATE TABLE FEATURES (
	  ID_FEATURE		INT AUTO_INCREMENT,
  	COORDINATE_ID		INT NOT NULL,
  	ID_QUESTION		INT NOT NULL,
  	PRIMARY KEY (ID_FEATURE),
  	FOREIGN KEY (ID_QUESTION) REFERENCES QUESTIONS (ID_QUESTION),
  	FOREIGN KEY (COORDINATE_ID) REFERENCES COORDINATES (ID_COORDINATE)
);