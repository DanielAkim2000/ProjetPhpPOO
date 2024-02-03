CREATE DATABASE KgbDatabase;

USE KgbDatabase;

/*Creation des tables pour la Kgb DATABASE*/
CREATE TABLE PAYS(
    pays_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE STATUTS(
    statut_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    statut VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE TYPEMISSION(
    type_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE HUMAIN(
    humain_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    lastname VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL
);

CREATE TABLE ADMINISTRATEURS(
    administration_id INT NOT NULL PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    dateofcreation DATE NOT NULL
);

CREATE TABLE HUMAINOFKGB(
    humainkgb_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    birthday DATE NOT NULL,
    nationality_id INT NOT NULL,
    Foreign Key (nationality_id) REFERENCES pays(pays_id),
    Foreign Key (humainkgb_id) REFERENCES HUMAIN(humain_id)
);

CREATE TABLE AGENTS(
    agent_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    codeofidentification INT NOT NULL UNIQUE,
    Foreign Key (agent_id) REFERENCES HUMAINOFKGB(humainkgb_id)
);

CREATE TABLE CIBLES(
    cible_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    codename VARCHAR(255) UNIQUE,
    Foreign Key (cible_id) REFERENCES HUMAINOFKGB(humainkgb_id)
);

CREATE TABLE CONTACTS(
    contact_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    codename VARCHAR(255) UNIQUE,
    Foreign Key (contact_id) REFERENCES HUMAINOFKGB(humainkgb_id)
);

CREATE TABLE SPECIALITYS(
    speciality_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nameofspeciality VARCHAR(255)
);

CREATE TABLE PLANQUES(
    planque_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(255) NOT NULL UNIQUE,
    type VARCHAR(255) UNIQUE,
    pays_id INT NOT NULL,
    Foreign Key (pays_id) REFERENCES PAYS(pays_id)
);

CREATE TABLE MISSIONS(
    mission_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    codename VARCHAR(255) NOT NULL,
    pays_id INT NOT NULL,
    type_id INT NOT NULL,
    statut_id INT NOT NULL,
    speciality_id INT NOT NULL,
    startdate DATE NOT NULL,
    enddate DATE NOT NULL,
    Foreign Key (pays_id) REFERENCES PAYS(pays_id),
    Foreign Key (statut_id) REFERENCES STATUTS(statut_id),
    Foreign Key (speciality_id) REFERENCES SPECIALITYS(speciality_id),
    Foreign Key (type_id) REFERENCES TYPEMISSION(type_id)
);

/* Creation des tables associatives */
CREATE TABLE SPECIALITYOFAGENTS(
    agent INT NOT NULL,
    speciality INT NOT NULL,
    PRIMARY KEY(agent,speciality),
    Foreign Key (agent) REFERENCES AGENTS(agent_id),
    Foreign Key (speciality) REFERENCES SPECIALITYS(speciality_id)
);

CREATE TABLE AGENTSOFMISSIONS(
    agent INT NOT NULL,
    mission INT NOT NULL,
    PRIMARY KEY(agent,mission),
    Foreign Key (agent) REFERENCES AGENTS(agent_id),
    Foreign Key (mission) REFERENCES MISSIONS(mission_id)
);

CREATE TABLE PLANQUEOFMISSIONS(
    planque INT NOT NULL,
    mission INT NOT NULL,
    PRIMARY KEY(planque,mission),
    Foreign Key (planque) REFERENCES PLANQUES(planque_id),
    Foreign Key (mission) REFERENCES MISSIONS(mission_id)
);

CREATE TABLE CONTACTOFMISSIONS(
    contact INT NOT NULL,
    mission INT NOT NULL,
    PRIMARY KEY(contact,mission),
    Foreign Key (contact) REFERENCES CONTACTS(contact_id),
    Foreign Key (mission) REFERENCES MISSIONS(mission_id)
);

CREATE TABLE CIBLEOFMISSIONS(
    cible INT NOT NULL,
    mission INT NOT NULL,
    PRIMARY KEY(cible,mission),
    Foreign Key (cible) REFERENCES CIBLES(cible_id),
    Foreign Key (mission) REFERENCES MISSIONS(mission_id)
);

/*Insertion dans les tables de base*/

INSERT INTO PAYS(name) VALUES('Afghanistan'), ('Albania'), ('Algeria'), ('Andorra'), ('Angola'),
('Antigua and Barbuda'), ('Argentina'), ('Armenia'), ('Australia'), ('Austria'),
('Azerbaijan'), ('Bahamas'), ('Bahrain'), ('Bangladesh'), ('Barbados'),
('Belarus'), ('Belgium'), ('Belize'), ('Benin'), ('Bhutan'),
('Bolivia'), ('Bosnia and Herzegovina'), ('Botswana'), ('Brazil'), ('Brunei'),
('Bulgaria'), ('Burkina Faso'), ('Burundi'), ('Cabo Verde'), ('Cambodia'),
('Cameroon'), ('Canada'), ('Central African Republic'), ('Chad'), ('Chile'),
('China'), ('Colombia'), ('Comoros'), ('Congo'), ('Costa Rica'),
('Croatia'), ('Cuba'), ('Cyprus'), ('Czechia'), ('Denmark'),
('Djibouti'), ('Dominica'), ('Dominican Republic'), ('East Timor'), ('Ecuador'),
('Egypt'), ('El Salvador'), ('Equatorial Guinea'), ('Eritrea'), ('Estonia'),
('Eswatini'), ('Ethiopia'), ('Fiji'), ('Finland'), ('France'), ('Gabon'), ('Gambia'), ('Georgia'), ('Germany'), ('Ghana'),
('Greece'), ('Grenada'), ('Guatemala'), ('Guinea'), ('Guinea-Bissau'),
('Guyana'), ('Haiti'), ('Honduras'), ('Hungary'), ('Iceland'),
('India'), ('Indonesia'), ('Iran'), ('Iraq'), ('Ireland'),
('Israel'), ('Italy'), ('Jamaica'), ('Japan'), ('Jordan'),
('Kazakhstan'), ('Kenya'), ('Kiribati'), ('Korea, North'), ('Korea, South'),
('Kosovo'), ('Kuwait'), ('Kyrgyzstan'), ('Laos'), ('Latvia'),
('Lebanon'), ('Lesotho'), ('Liberia'), ('Libya'), ('Liechtenstein'),
('Lithuania'), ('Luxembourg'), ('Madagascar'), ('Malawi'), ('Malaysia'),
('Maldives'), ('Mali'), ('Malta'), ('Marshall Islands'), ('Mauritania'),
('Mauritius'), ('Mexico'), ('Micronesia'), ('Moldova'), ('Monaco'), ('Mongolia'),
('Montenegro'), ('Morocco'), ('Mozambique'), ('Myanmar (Burma)'), ('Namibia'),
('Nauru'), ('Nepal'), ('Netherlands'), ('New Zealand'), ('Nicaragua'),
('Niger'), ('Nigeria'), ('North Macedonia'), ('Norway'), ('Oman'),
('Pakistan'), ('Palau'), ('Palestine'), ('Panama'), ('Papua New Guinea'),
('Paraguay'), ('Peru'), ('Philippines'), ('Poland'), ('Portugal'),
('Qatar'), ('Romania'), ('Russia'), ('Rwanda'), ('Saint Kitts and Nevis'),
('Saint Lucia'), ('Saint Vincent and the Grenadines'), ('Samoa'), ('San Marino'),
('Sao Tome and Principe'), ('Saudi Arabia'), ('Senegal'), ('Serbia'), ('Seychelles'),
('Sierra Leone'), ('Singapore'), ('Slovakia'), ('Slovenia'), ('Solomon Islands'),
('Somalia'), ('South Africa'), ('South Sudan'), ('Spain'), ('Sri Lanka'),
('Sudan'), ('Suriname'), ('Sweden'), ('Switzerland'), ('Syria'), ('Taiwan'),
('Tajikistan'), ('Tanzania'), ('Thailand'), ('Timor-Leste'), ('Togo'),
('Tonga'), ('Trinidad and Tobago'), ('Tunisia'), ('Turkey'), ('Turkmenistan'),
('Tuvalu'), ('Uganda'), ('Ukraine'), ('United Arab Emirates'), ('United Kingdom'),
('United States'), ('Uruguay'), ('Uzbekistan'), ('Vanuatu'), ('Vatican City'),
('Venezuela'), ('Vietnam'), ('Yemen'), ('Zambia'), ('Zimbabwe');