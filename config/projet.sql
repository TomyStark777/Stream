-- carte biblio ---

CREATE TABLE Carte_biblio(
    num_biblio INT PRIMARY KEY,
    date_imprim DATE NOT NULL,
    paiement INT NOT NULL
);

--- cration de la table gestionnaire abonnée ---
CREATE TABLE abonnee(
    nom VARCHAR(50) PRIMARY KEY,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    nom_pays VARCHAR(50) NOT NULL,
    tel INT NOT NULL
);

--- creation de la fiche adhesion ---
CREATE TABLE Fiche_Adhesion (
    id_fich INT PRIMARY KEY,
    libell_fich VARCHAR(50) NOT NULL
);

--- bibliothecaire ---
CREATE TABLE Bibliothecaire(
    matricul_biblio INT PRIMARY KEY,
    nom_biblio VARCHAR(50) NOT NULL,
    prenom_biblio VARCHAR(50) NOT NULL,
    sexe_biblio VARCHAR(20) NOT NULL
);

--- EMPRUNTEUR ---
CREATE TABLE Emprunteur(
    id_emprunt INT PRIMARY KEY,
    nom_emprunt VARCHAR(50) NOT NULL,
    prenom_emprunt VARCHAR(50) NOT NULL,
    sexe_emprunt VARCHAR(20) NOT NULL,
    adresse_emprunt VARCHAR(50) NOT NULL,
    tel_emprunteur VARCHAR(20) NOT NULL,
    matricul_biblio INT NOT NULL,
    id_fich INT NOT NULL,
    num_biblio INT NOT NULL,
    nom VARCHAR(50) NOT NULL
    
);

--- Auteur ---
CREATE TABLE Auteur(
    id_auteur INT PRIMARY KEY,
    nom_auteur VARCHAR(50) NOT NULL,
    prenom_auteur VARCHAR(50) NOT NULL,
    date_naiss_auteur DATE NOT NULL,
    nationalite_auteur VARCHAR(50)
);

--- Categorie ---
CREATE TABLE Categorie(
    id_categorie INT PRIMARY KEY,
    libelle_categorie VARCHAR(20)
);

--- livre ---
CREATE TABLE Livre (
    id_livre INT PRIMARY KEY,
    titre_livre VARCHAR(255) NOT NULL,
    annee INT NOT NULL,
    isbn BIGINT NOT NULL,
    langue_livre VARCHAR(20) NOT NULL,
    id_auteur INT NOT NULL,
    description TEXT NOT NULL,
    id_categorie INT NOT NULL,
	download_url VARCHAR(255),
	image_url VARCHAR(255)
);
 

-- Emprunt ---
CREATE TABLE Emprunt(
    id_livre INT NOT NULL,
    id_emprunt INT NOT NULL,
    date_debut DATE NOT NULL,
    date_retour DATE NOT NULL,
    date_rendu DATE NOT NULL
);

--- Concerne ---
CREATE TABLE Concerne(
    id_livre INT NOT NULL,
    id_consul INT NOT NULL
);

--- Consultation ---
CREATE TABLE Consultation(
    id_consul INT PRIMARY KEY,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL
);

--- Service ---
CREATE TABLE Services(
    id_servi INT PRIMARY KEY,
    num_servi INT NOT NULL,
    libelle_servi VARCHAR(20)
);

--- Orienter ---
CREATE TABLE Orienter(
    id_emprunt INT NOT NULL,
    id_servi INT NOT NULL  
);

-- Indexes 
CREATE INDEX idx_livre_id_auteur ON livre (id_auteur); 
CREATE INDEX idx_livre_id_categorie ON livre (id_categorie); 
CREATE INDEX idx_livre_titre_livre ON livre (titre_livre); 
CREATE INDEX idx_emprunt_id_livre ON emprunt (id_livre); 
CREATE INDEX idx_emprunteur_id_fiche ON emprunteur (id_fich);

-- Relations
ALTER TABLE Emprunteur
ADD CONSTRAINT fk_votre_table_bibliothecaire
FOREIGN KEY (matricul_biblio) REFERENCES bibliothecaire(matricul_biblio);

ALTER TABLE Emprunteur
ADD CONSTRAINT fk_votre_table_fiche_adhesion
FOREIGN KEY (id_fich) REFERENCES fiche_adhesion(id_fich);

ALTER TABLE Emprunteur
ADD CONSTRAINT fk_votre_table_carte_biblio
FOREIGN KEY (num_biblio) REFERENCES carte_biblio(num_biblio);

ALTER TABLE Emprunteur
ADD CONSTRAINT fk_votre_table_ionnaire_abonnee
FOREIGN KEY (nom) REFERENCES abonnee(nom);

ALTER TABLE concerne
ADD CONSTRAINT fk_concerne_livre
FOREIGN KEY (id_livre) REFERENCES livre(id_livre);

ALTER TABLE concerne
ADD CONSTRAINT fk_concerne_consultation
FOREIGN KEY (id_consul) REFERENCES consultation(id_consul);

ALTER TABLE Emprunt
ADD CONSTRAINT fk_emprunt_livre
FOREIGN KEY (id_livre) REFERENCES livre(id_livre);

ALTER TABLE Emprunt
ADD CONSTRAINT fk_emprunt_emprunteur
FOREIGN KEY (id_emprunt) REFERENCES Emprunteur(id_emprunt);

ALTER TABLE orienter
ADD CONSTRAINT fk_orienter_emprunteur
FOREIGN KEY (id_emprunt) REFERENCES emprunteur(id_emprunt);

ALTER TABLE orienter
ADD CONSTRAINT fk_orienter_services
FOREIGN KEY (id_servi) REFERENCES services(id_servi);


-- Insertions
-- Insertions dans la table Carte_biblio
INSERT INTO carte_biblio (num_biblio, date_imprim, paiement) VALUES
(1, '2025-01-01', 50),
(2, '2025-01-02', 75),
(3, '2025-01-03', 60),
(4, '2025-01-04', 55),
(5, '2025-01-05', 65);

-- Insertions dans la table abonnee
INSERT INTO abonnee (nom, prenom, email, password, nom_pays, tel) VALUES
('Durand', 'Alice', 'alicedurand@gmail.com', '123456', 'France', 123456789),
('Martin', 'Bob', 'martin@gmail.com', '123456', 'France', 987654321),
('Dupont', 'Chloe', 'chloedupont@gmail.com', '123456', 'France', 234567890),
('Petit', 'David', 'petitdavid@gmail.com', '123456', 'France', 345678901),
('Lefevre', 'Emma', 'lefevreemma45@gmail.com', '123456', 'France', 456789012);

-- Insertions dans la table Fiche_Adhesion
INSERT INTO fiche_adhesion (id_fich, libell_fich) VALUES
(1, 'Fiche A'),
(2, 'Fiche B'),
(3, 'Fiche C'),
(4, 'Fiche D'),
(5, 'Fiche E');

-- Insertions dans la table Bibliothecaire
INSERT INTO bibliothecaire (matricul_biblio, nom_biblio, prenom_biblio, sexe_biblio) VALUES
(1, 'Dupont', 'Jean', 'Homme'),
(2, 'Lemoine', 'Marie', 'Femme'),
(3, 'Moreau', 'Luc', 'Homme'),
(4, 'Roux', 'Julie', 'Femme'),
(5, 'Simon', 'Pierre', 'Homme');

-- Insertions dans la table Emprunteur
INSERT INTO emprunteur (id_emprunt, nom_emprunt, prenom_emprunt, sexe_emprunt, adresse_emprunt, tel_emprunteur, matricul_biblio, id_fich, num_biblio, nom) VALUES
(1, 'Smith', 'John', 'Homme', '789 Rue Exemple', '123456789', 1, 1, 1, 'Durand'),
(2, 'Doe', 'Jane', 'Femme', '101 Rue Exemple', '987654321', 2, 2, 2, 'Martin'),
(3, 'Brown', 'Charlie', 'Homme', '202 Rue Exemple', '345678901', 3, 3, 3, 'Dupont'),
(4, 'White', 'Alice', 'Femme', '303 Rue Exemple', '456789012', 4, 4, 4, 'Petit'),
(5, 'Black', 'Eve', 'Femme', '404 Rue Exemple', '567890123', 5, 5, 5, 'Lefevre');

INSERT INTO auteur (id_auteur, nom_auteur, prenom_auteur, date_naiss_auteur, nationalite_auteur) VALUES
(1, 'Beauchemin', 'Jean-François', '1950-04-05', 'Française'),  -- Auteur de "Le Jour des Corneilles"
(2, 'Darras', 'Marc', '1968-11-30', 'Française'),  -- Auteur de "L''Horizon"
(3, 'Slimani', 'Leïla', '1981-10-03', 'Franco-Marocaine'),  -- Auteur de "Chanson Douce"
(4, 'Atwood', 'Margaret', '1939-11-18', 'Canadienne'),  -- Auteur de "Les Testaments"
(5, 'Grubb', 'Davis', '1919-07-23', 'Américaine'),  -- Auteur de "La Nuit du Chasseur"
(6, 'Foenkinos', 'David', '1974-10-28', 'Française'),  -- Auteur de "En Attendant Bojangles"
(7, 'Foenkinos', 'David', '1974-10-28', 'Française'),  -- Auteur de "Le Mystère Henri Pick"
(8, 'Dicker', 'Joël', '1985-06-16', 'Suisse'),  -- Auteur de "L''Énigme de la Chambre 622"
(9, 'Musso', 'Guillaume', '1974-06-06', 'Française'),  -- Auteur de "La Vie Secrète des Écrivains"
(10, 'Perrin', 'Victoria', '1987-03-15', 'Française'),  -- Auteur de "Le Bal des Folles"
(11, 'Combres', 'Éric', '1972-02-05', 'Française'),  -- Auteur de "L''Archipel du Chien"
(12, 'Mauger', 'Bernard', '1956-05-24', 'Française'),  -- Auteur de "Leurs Enfants après Eux"
(13, 'Alvarez', 'Max', '1949-11-12', 'Franco-Argentin'),  -- Auteur de "Les Déracinés"
(14, 'Parry', 'John', '1973-08-20', 'Franco-Britannique'),  -- Auteur de "La Tresse"
(15, 'Ruggiero', 'Anna', '1965-05-10', 'Franco-Italienne'),  -- Auteur de "L''Homme qui ment"
(16, 'Radiguet', 'Raymond', '1903-06-18', 'Française'),  -- Auteur de "Changer l''eau des fleurs"
(17, 'Filippi', 'Vincent', '1969-02-07', 'Française'),  -- Auteur de "La Disparition de Stéphanie Mailer"
(18, 'Bernard', 'Michel', '1942-03-09', 'Française'),  -- Auteur de "Le Saut de Tibère"
(19, 'Tullio', 'Simone', '1963-11-14', 'Italienne'),  -- Auteur de "Leurs Enfants après Eux"
(20, 'Lançon', 'Philippe', '1963-05-04', 'Française'),  -- Auteur de "Le Lambeau"
(21, 'Martel', 'Yann', '1963-06-25', 'Canadienne'),  -- Auteur de "Le Serment des Limousins"
(22, 'Dumas', 'Alexandre', '1802-07-24', 'Française'),  -- Auteur de "Un Monde à Portée de Main"
(23, 'De Vigan', 'Delphine', '1966-03-01', 'Française'),  -- Auteur de "Les Rêveurs"
(24, 'Modiano', 'Patrick', '1945-07-30', 'Française'),  -- Auteur de "Souvenirs Dormants"
(25, 'Lemaitre', 'Pierre', '1951-04-19', 'Française'),  -- Auteur de "Couleurs de l''incendie"
(26, 'Albo', 'Xavier', '1925-11-21', 'Bolivienne'),  -- Auteur de "La Consolation"
(27, 'Phelizon', 'Jean-Louis', '1946-09-15', 'Française'),  -- Auteur de "Les Derniers Jours de Rabbit Hayes"
(28, 'Tournier', 'Michel', '1924-12-19', 'Française'),  -- Auteur de "La Fontaine"
(29, 'Ferrante', 'Elena', '1943-10-20', 'Italienne'),  -- Auteur de "L''Amie Prodigieuse"
(30, 'Dicker', 'Joël', '1985-06-16', 'Suisse'),  -- Auteur de "Le Livre des Baltimore"
(31, 'Faye', 'Gaël', '1982-08-06', 'Française'),  -- Auteur de "La Plus Secrète Mémoire des Hommes"
(32, 'Cohen', 'Albert', '1895-08-16', 'Française'),  -- Auteur de "Le Livre de ma mère"
(33, 'Gounelle', 'Laurent', '1966-08-10', 'Française'),  -- Auteur de "L''Homme qui voulait être heureux"
(34, 'Nguyen', 'Viet Thanh', '1971-03-13', 'Vietnamienne-Américaine'),  -- Auteur de "Le Sympathisant"
(35, 'Guenassia', 'Jean-Michel', '1950-01-22', 'Française'),  -- Auteur de "Le Club des incorrigibles optimistes"
(36, 'Grumberg', 'Jean-Claude', '1939-07-26', 'Française'),  -- Auteur de "Un secret"
(37, 'Dicker', 'Joël', '1985-06-16', 'Suisse'),  -- Auteur de "La Vérité sur l''Affaire Harry Quebert"
(38, 'Despentes', 'Virginie', '1969-06-13', 'Française');  -- Auteur de "Vernon Subutex"




-- Insertions dans la table Categorie
INSERT INTO categorie (id_categorie, libelle_categorie) VALUES
(1, 'Drame'),
(2, 'Action'),
(3, 'Thriller'),
(4, 'Horreur'),
(5, 'Fantastique'),
(6, 'Fantaisie'),
(7, 'Comédie'),
(8, 'Tranche de vie'),
(9, 'Historique');

INSERT INTO livre (id_livre, titre_livre, annee, isbn, langue_livre, id_auteur, id_categorie, download_url, image_url, description) VALUES
(1, 'Le Jour des Corneilles', 2023, 9781234567897, 'Français', 1, 8, 'https://example.com/download1', '../image/le-jour-des-corneilles.jpg', 'Une belle histoire sur la relation entre un garçon et son père dans une forêt mystérieuse. Le garçon, élevé loin de la civilisation, découvre progressivement les vérités sur son passé et le monde extérieur.'),
(2, 'L''Horizon', 2022, 9781234567898, 'Français', 2, 1, 'https://example.com/download2', '../image/l-horizon.jpg', 'Un roman explorant les perspectives humaines et les frontières du possible. À travers des récits entrecroisés, il examine les rêves, les peurs, et les défis contemporains des individus.'),
(3, 'Chanson Douce', 2025, 9780451524935, 'Français', 3, 4, 'https://example.com/download3', '../image/chanson-douce.jpg', 'Une histoire poignante sur une nounou et ses employeurs. Le roman dévoile progressivement les tensions et les secrets de cette famille, aboutissant à une tragédie inévitable.'),
(4, 'Les Testaments', 2024, 9780142437247, 'Français', 4, 4, 'https://example.com/download4', '../image/les-testaments.jpg', 'La suite attendue du roman dystopique "La Servante écarlate". Cette œuvre explore les luttes et les alliances des personnages dans leur quête de liberté et de justice contre un régime tyrannique.'),
(5, 'La Nuit du Chasseur', 2023, 9780199232765, 'Français', 5, 4, 'https://example.com/download5', '../image/la-nuit-du-chasseur.jpg', 'Un thriller captivant sur un prêtre charismatique et sinistre. Le personnage principal, en proie à ses propres démons, mène ses fidèles dans une quête de pouvoir et de vengeance.'),
(6, 'En Attendant Bojangles', 2024, 9780743273565, 'Français', 6, 1, 'https://example.com/download6', '../image/en-attendant-bojangles.jpg', 'Un roman touchant sur l''amour, la folie et la musique. À travers les souvenirs d''un enfant, l''auteur dépeint une histoire d''amour excentrique et poignante.'),
(7, 'Le Mystère Henri Pick', 2025, 9780140449136, 'Français', 7, 7, 'https://example.com/download7', '../image/le-mystere-henri-pick.jpg', 'Une comédie littéraire sur la découverte d''un manuscrit oublié. Les personnages, passionnés de littérature, se lancent dans une enquête littéraire pleine de rebondissements.'),
(8, 'L''Énigme de la Chambre 622', 2024, 9780060850524, 'Français', 8, 3, 'https://example.com/download8', '../image/l-enigme-de-la-chambre-622.jpg', 'Un thriller mystérieux situé dans un hôtel suisse. L''auteur nous entraîne dans un dédale d''indices et de secrets bien gardés.'),
(9, 'La Vie Secrète des Écrivains', 2023, 9780316769488, 'Français', 9, 1, 'https://example.com/download9', '../image/la-vie-secrete-des-ecrivains.jpg', 'Un drame sur la vie cachée des écrivains et leurs secrets. À travers des intrigues croisées, le roman explore les passions et les dilemmes des créateurs.'),
(10, 'Le Bal des Folles', 2022, 9780140268867, 'Français', 10, 1, 'https://example.com/download10', '../image/le-bal-des-folles.jpg', 'Une histoire émouvante de femmes internées dans un asile au 19ème siècle. Le roman met en lumière les injustices et les luttes de ces femmes marginalisées par la société.'),
(11, 'L''Archipel du Chien', 2025, 9780199535675, 'Français', 11, 1, 'https://example.com/download11', '../image/l-archipel-du-chien.jpg', 'Une réflexion poignante sur l''humanité et l''isolement. À travers une série d''événements bouleversants, l''auteur questionne la nature humaine et la moralité.'),
(12, 'Leurs Enfants après Eux', 2023, 9780679736363, 'Français', 12, 1, 'https://example.com/download12', '../image/leurs-enfants-apres-eux.jpg', 'Un roman captivant sur le passage à l''âge adulte dans une petite ville française. À travers les yeux des adolescents, l''auteur explore les rêves et les désillusions de la jeunesse.'),
(13, 'Les Déracinés', 2024, 9780142437223, 'Français', 13, 9, 'https://example.com/download13', '../image/les-deracines.jpg', 'Une saga familiale traversant les époques et les continents. Le roman retrace les vies entrelacées de plusieurs générations, marquées par l''exil et les défis identitaires.'),
(14, 'La Tresse', 2022, 9780374528379, 'Français', 14, 8, 'https://example.com/download14', 'Trois femmes, trois continents, une lutte commune pour la liberté. Chacune d''elles, confrontée à des obstacles insurmontables, trouve la force de changer sa destinée.'),
(15, 'L''Homme qui ment', 2023, 9780143035008, 'Français', 15, 1, 'https://example.com/download15', '../image/l-homme-qui-ment.jpg', 'Un drame psychologique sur les secrets et les mensonges. À travers une narration complexe, le roman dévoile les manipulations et les tromperies des personnages.'),
(16, 'Changer l''eau des fleurs', 2025, 9780060934345, 'Français', 16, 1, 'https://example.com/download16', '../image/changer-l-eau-des-fleurs.jpg', 'Un roman émouvant sur le deuil et la résilience. L''héroïne, gardienne de cimetière, trouve des réponses à ses questions existentielles à travers les histoires des défunts.'),
(17, 'La Disparition de Stéphanie Mailer', 2023, 9780140449266, 'Français', 17, 3, 'https://example.com/download17', '../image/la-disparition-de-stephanie-mailer.jpg', 'Un thriller haletant sur une enquête non résolue. Les enquêteurs, déterminés à découvrir la vérité, se retrouvent plongés dans un labyrinthe de mensonges et de trahisons.'),
(18, 'Le Saut de Tibère', 2024, 9780140275360, 'Français', 18, 9, 'https://example.com/download18', '../image/le-saut-de-tibere.jpg', 'Une quête mystique à travers l''histoire ancienne. Le roman suit un archéologue dans sa recherche d''un artefact légendaire, révélant des secrets enfouis depuis des siècles.'),
(19, 'Leurs Enfants après Eux', 2025, 9780141441146, 'Français', 12, 8, 'https://example.com/download19', '../image/leurs-enfants-apres-eux.jpg', 'Un roman captivant sur le passage à l''âge adulte dans une petite ville française. À travers les yeux des adolescents, l''auteur explore les rêves et les désillusions de la jeunesse.'),
(20, 'Le Lambeau', 2022, 9780141439556, 'Français', 20, 1, 'https://example.com/download20', '../image/le-lambeau.jpg', 'Ce récit autobiographique émouvant relate le parcours de Philippe Lançon, journaliste blessé lors de l''attentat contre Charlie Hebdo. Entre souffrance et résilience, l''auteur dévoile sa lutte pour reconstruire sa vie après le traumatisme. Un témoignage puissant sur la force humaine face à l''adversité.'),
(21, 'Le Serment des Limousins', 2023, 9780143106296, 'Français', 21, 9, 'https://example.com/download21', '../image/le-serment-des-limousins.jpg', 'Plongez au cœur de la Seconde Guerre mondiale avec ce roman historique captivant. Le Limousin devient le théâtre de la résistance héroïque de ses habitants contre l''occupation nazie. À travers des personnages attachants, l''auteur rend hommage à leur courage et leur détermination à défendre leur liberté.'),
(22, 'Un Monde à Portée de Main', 2024, 9780141439563, 'Français', 22, 1, 'https://example.com/download22', '../image/un-monde-a-portee-de-main.jpg', 'Ce roman explore les défis contemporains et les possibilités infinies de l''humanité. Suivez les aventures de personnages audacieux qui remettent en question les normes sociales pour réaliser leurs rêves. Une invitation à repousser les limites et à imaginer un avenir meilleur.'),
(23, 'Les Rêveurs', 2022, 9780141439846, 'Français', 23, 8, 'https://example.com/download23', '../image/les-reveurs.jpg', 'Découvrez un univers poétique et fascinant à travers les yeux de rêveurs qui aspirent à un monde meilleur. L''auteur nous emmène dans un voyage onirique où l''imagination et la réalité se confondent, nous rappelant l''importance de rêver et de croire en ses aspirations.'),
(24, 'Souvenirs Dormants', 2025, 9780141439471, 'Français', 24, 8, 'https://example.com/download24', '../image/souvenirs-dormants.jpg', 'Plongez dans les méandres de la mémoire avec ce roman introspectif. À travers des souvenirs enfouis et des secrets révélés, l''auteur explore l''impact du passé sur le présent et les dilemmes auxquels sont confrontés les personnages. Une réflexion profonde sur la nature de la mémoire et de l''oubli.'),
(25, 'Couleurs de l''incendie', 2023, 9780141439570, 'Français', 25, 9, 'https://example.com/download25', '../image/couleurs-de-l-incendie.jpg', 'Suite du célèbre "Au revoir là-haut", ce roman continue de suivre les destins entrecroisés de personnages marqués par les bouleversements de l''Histoire. Entre vengeance, justice et rédemption, l''auteur nous offre un tableau poignant des défis humains et des passions dévastatrices.'),
(26, 'La Consolation', 2024, 9780141441672, 'Français', 26, 1, 'https://example.com/download26', '../image/la-consolation.jpg', 'Un récit bouleversant sur la quête de rédemption et de paix intérieure. À travers des personnages empreints d''émotions profondes, l''auteur tisse une histoire de résilience et d''espoir, montrant la capacité de l''être humain à trouver la lumière même dans les moments les plus sombres.'),
(27, 'Les Derniers Jours de Rabbit Hayes', 2023, 9780060883287, 'Français', 27, 8, 'https://example.com/download27', '../image/les-derniers-jours-de-rabbit-hayes.jpg', 'Une chronique poignante des derniers jours de Rabbit Hayes, une femme exceptionnelle dont la vie a été marquée par des moments de bonheur et de tragédie. À travers les souvenirs de ses proches, ce roman offre une réflexion émouvante sur la mortalité, l''amour et la valeur des relations humaines.'),
(28, 'La Fontaine', 2022, 9780142437186, 'Français', 28, 1, 'https://example.com/download28', '../image/la-fontaine.jpg', 'Cette biographie exhaustive de Jean de La Fontaine, maître des fables, retrace la vie et l''œuvre du poète. L''auteur nous plonge dans le XVIIe siècle, dévoilant les influences et les inspirations qui ont façonné les récits intemporels de La Fontaine. Un hommage vibrant à un géant de la littérature française.'),
(29, 'L''Amie Prodigieuse', 2023, 9780141182902, 'Français', 29, 9, 'https://example.com/download29', '../image/l-amie-prodigieuse.jpg', 'Premier tome d''une saga napolitaine époustouflante, ce roman explore l''amitié complexe et passionnée entre Elena et Lila. À travers les années, leurs vies se tissent et se dénouent au gré des transformations personnelles et sociales, offrant un portrait inoubliable d''une Italie en mutation.'),
(30, 'Le Livre des Baltimore', 2024, 9782070360425, 'Français', 30, 9, 'https://example.com/download30', '../image/le-livre-des-baltimore.jpg', 'Une saga familiale émouvante qui explore les contrastes entre les branches prospères et modestes d''une famille. À travers les yeux de Marcus Goldman, l''auteur dépeint des histoires de loyauté, de succès et de drames personnels, offrant un tableau riche et nuancé des relations humaines.'),
(31, 'La Plus Secrète Mémoire des Hommes', 2022, 9782070368100, 'Français', 31, 9, 'https://example.com/download31', '../image/la-plus-secrete-memoire-des-hommes.jpg', 'Un voyage littéraire captivant où un jeune écrivain se lance à la recherche d''un auteur mystérieux dont les œuvres ont disparu. À travers cette quête, l''auteur explore les mystères de la création artistique et les secrets que les écrivains emportent avec eux.'),
(32, 'Le Livre de ma mère', 2023, 9782070409181, 'Français', 32, 1, 'https://example.com/download32', '../image/le-livre-de-ma-mere.jpg', 'Un hommage déchirant à une mère adorée. L''auteur partage ses souvenirs intimes et les leçons de vie apprises auprès de sa mère, offrant une réflexion profonde sur l''amour filial, le deuil et la mémoire. Un récit émouvant et universel qui touche au cœur de l''expérience humaine.'),
(33, 'L''Homme qui voulait être heureux', 2024, 9782070401239, 'Français', 33, 6, 'https://example.com/download33', '../image/l-homme-qui-voulait-etre-heureux.jpg', 'À travers les rencontres et les réflexions du protagoniste, ce roman philosophique explore la quête du bonheur et l''importance de vivre une vie authentique. L''auteur invite les lecteurs à redéfinir leur propre notion de bonheur et à envisager des chemins de vie plus épanouissants.'),
(34, 'Le Sympathisant', 2025, 9782070360029, 'Français', 34, 7, 'https://example.com/download34', '../image/le-sympathisant.jpg', 'Un roman d''espionnage palpitant situé pendant la guerre du Vietnam. Le protagoniste, partagé entre deux mondes, navigue à travers des loyautés conflictuelles et des trahisons, offrant une réflexion profonde sur l''identité et les luttes politiques.'),
(35, 'Le Club des incorrigibles optimistes', 2022, 9782070403349, 'Français', 35, 8, 'https://example.com/download35', '../image/le-club-des-incorrigibles-optimistes.jpg', 'Une fresque historique riche et nuancée sur la jeunesse parisienne des années 50 et 60. Le club, constitué de personnages hauts en couleur, incarne l''espoir et la résilience face aux défis de l''époque. Un portrait vibrant de la société d''après-guerre.'),
(36, 'Un secret', 2023, 9782070409358, 'Français', 36, 9, 'https://example.com/download36', '../image/un-secret.jpg', 'Un drame familial émouvant qui révèle des secrets longtemps gardés. À travers les souvenirs et les découvertes du protagoniste, le roman explore les thèmes de la mémoire, de l''identité et de la réconciliation avec le passé.');

DROP TABLE IF EXISTS carte_biblio CASCADE;
DROP TABLE IF EXISTS abonnee CASCADE;
DROP TABLE IF EXISTS fiche_adhesion CASCADE;
DROP TABLE IF EXISTS bibliothecaire CASCADE;
DROP TABLE IF EXISTS emprunteur CASCADE;
DROP TABLE IF EXISTS auteur CASCADE;
DROP TABLE IF EXISTS categorie CASCADE;
DROP TABLE IF EXISTS livre CASCADE;
DROP TABLE IF EXISTS emprunt CASCADE;
DROP TABLE IF EXISTS concerne CASCADE;
DROP TABLE IF EXISTS consultation CASCADE;
DROP TABLE IF EXISTS services CASCADE;
DROP TABLE IF EXISTS orienter CASCADE;

