DROP DATABASE IF EXISTS quiz_db;

CREATE DATABASE IF NOT EXISTS quiz_db;

use quiz_db;

CREATE TABLE kategorie(
    pk_id INT PRIMARY KEY,
    kategorie VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci,
    fk_pk_kategorie_id INT,
    constraint foreign key kategorie_kategorie(fk_pk_kategorie_id) references kategorie(pk_id) on delete cascade
);

CREATE TABLE schwierigkeitsgrad(
    pk_name VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci PRIMARY KEY
);

CREATE TABLE frage(
    pk_frage_id INT PRIMARY KEY,
    frage VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
    fk_pk_name VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci,
    fk_pk_kategorie INT,
    constraint foreign key frage_schwierigkeitsgrad(fk_pk_name) references schwierigkeitsgrad(pk_name) on delete cascade,
    constraint foreign key frage_kategorie(fk_pk_kategorie) references kategorie(pk_id) on delete cascade
);

CREATE TABLE antwort(
    pk_antwort_id INT PRIMARY KEY,
    antwort VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
    richtig boolean,
    fk_pk_frage_id INT,
    constraint foreign key antwort_frage(fk_pk_frage_id) references frage(pk_frage_id) on delete cascade
);


