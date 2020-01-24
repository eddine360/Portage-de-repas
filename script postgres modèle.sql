------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: TYPE_VEHICULE
------------------------------------------------------------
CREATE TABLE public.TYPE_VEHICULE(
	num_type   SERIAL NOT NULL ,
	type       VARCHAR (10) NOT NULL ,
	capacite   INT  NOT NULL  ,
	CONSTRAINT TYPE_VEHICULE_PK PRIMARY KEY (num_type)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: NEWS
------------------------------------------------------------
CREATE TABLE public.NEWS(
	num_news     SERIAL NOT NULL ,
	titre_news   VARCHAR (10) NOT NULL ,
	article      VARCHAR (2000)  NOT NULL ,
	date_news    DATE  NOT NULL  ,
	CONSTRAINT NEWS_PK PRIMARY KEY (num_news)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: INGREDIENTS
------------------------------------------------------------
CREATE TABLE public.INGREDIENTS(
	num_ingre   SERIAL NOT NULL ,
	nom_ingre   VARCHAR (20) NOT NULL ,
	allergene   VARCHAR (-1) NOT NULL  ,
	CONSTRAINT INGREDIENTS_PK PRIMARY KEY (num_ingre)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: LIB_AVIS
------------------------------------------------------------
CREATE TABLE public.LIB_AVIS(
	num_lib_avis   SERIAL NOT NULL ,
	lib_avis       VARCHAR (50) NOT NULL  ,
	CONSTRAINT LIB_AVIS_PK PRIMARY KEY (num_lib_avis)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: CONGE
------------------------------------------------------------
CREATE TABLE public.CONGE(
	num_conge          SERIAL NOT NULL ,
	motif              VARCHAR (50) NOT NULL ,
	date_debut_conge   DATE  NOT NULL ,
	date_fin_conge     DATE  NOT NULL  ,
	CONSTRAINT CONGE_PK PRIMARY KEY (num_conge)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: PERSONNEL
------------------------------------------------------------
CREATE TABLE public.PERSONNEL(
	num_pers         SERIAL NOT NULL ,
	nom_pers         VARCHAR (20) NOT NULL ,
	prenom_pers      VARCHAR (20) NOT NULL ,
	tel_pers         VARCHAR (20) NOT NULL ,
	mail_pers        VARCHAR (50) NOT NULL ,
	adresse          VARCHAR (50) NOT NULL ,
	date_nais_pers   DATE  NOT NULL ,
	permis           BOOL  NOT NULL ,
	login_pers       VARCHAR (50) NOT NULL ,
	mdp_pers         VARCHAR (50) NOT NULL  ,
	CONSTRAINT PERSONNEL_PK PRIMARY KEY (num_pers)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: CUISINIER
------------------------------------------------------------
CREATE TABLE public.CUISINIER(
	num_pers         INT  NOT NULL ,
	num_cuisi        INT  NOT NULL ,
	nom_pers         VARCHAR (20) NOT NULL ,
	prenom_pers      VARCHAR (20) NOT NULL ,
	tel_pers         VARCHAR (20) NOT NULL ,
	mail_pers        VARCHAR (50) NOT NULL ,
	adresse          VARCHAR (50) NOT NULL ,
	date_nais_pers   DATE  NOT NULL ,
	permis           BOOL  NOT NULL ,
	login_pers       VARCHAR (50) NOT NULL ,
	mdp_pers         VARCHAR (50) NOT NULL  ,
	CONSTRAINT CUISINIER_PK PRIMARY KEY (num_pers,num_cuisi)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: MENU
------------------------------------------------------------
CREATE TABLE public.MENU(
	num_menu    SERIAL NOT NULL ,
	date_menu   DATE  NOT NULL  ,
	CONSTRAINT MENU_PK PRIMARY KEY (num_menu)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: TYPE_PLAT
------------------------------------------------------------
CREATE TABLE public.TYPE_PLAT(
	num_type   SERIAL NOT NULL ,
	nom_type   CHAR (5)  NOT NULL  ,
	CONSTRAINT TYPE_PLAT_PK PRIMARY KEY (num_type)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: PLAT
------------------------------------------------------------
CREATE TABLE public.PLAT(
	num_plat      SERIAL NOT NULL ,
	nom_plat      VARCHAR (10) NOT NULL ,
	image_plat    VARCHAR (2000)  NOT NULL ,
	description   VARCHAR (10) NOT NULL ,
	num_type      INT  NOT NULL  ,
	CONSTRAINT PLAT_PK PRIMARY KEY (num_plat)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: TYPE_CO
------------------------------------------------------------
CREATE TABLE public.TYPE_CO(
	num_type_co   SERIAL NOT NULL ,
	type_co       VARCHAR (50) NOT NULL  ,
	CONSTRAINT TYPE_CO_PK PRIMARY KEY (num_type_co)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: COMPTE
------------------------------------------------------------
CREATE TABLE public.COMPTE(
	id_connexion   SERIAL NOT NULL ,
	identifiant    VARCHAR (50) NOT NULL ,
	mdp            VARCHAR (50) NOT NULL ,
	num_type_co    INT  NOT NULL  ,
	CONSTRAINT COMPTE_PK PRIMARY KEY (id_connexion)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: LIVREUR
------------------------------------------------------------
CREATE TABLE public.LIVREUR(
	num_pers         INT  NOT NULL ,
	num_liv          INT  NOT NULL ,
	nom_pers         VARCHAR (20) NOT NULL ,
	prenom_pers      VARCHAR (20) NOT NULL ,
	tel_pers         VARCHAR (20) NOT NULL ,
	mail_pers        VARCHAR (50) NOT NULL ,
	adresse          VARCHAR (50) NOT NULL ,
	date_nais_pers   DATE  NOT NULL ,
	permis           BOOL  NOT NULL ,
	login_pers       VARCHAR (50) NOT NULL ,
	mdp_pers         VARCHAR (50) NOT NULL ,
	id_connexion     INT  NOT NULL  ,
	CONSTRAINT LIVREUR_PK PRIMARY KEY (num_pers,num_liv)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: contenir
------------------------------------------------------------
CREATE TABLE public.contenir(
	num_plat    INT  NOT NULL ,
	num_ingre   INT  NOT NULL  ,
	CONSTRAINT contenir_PK PRIMARY KEY (num_plat,num_ingre)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: reserver
------------------------------------------------------------
CREATE TABLE public.reserver(
	num_pers    INT  NOT NULL ,
	num_conge   INT  NOT NULL  ,
	CONSTRAINT reserver_PK PRIMARY KEY (num_pers,num_conge)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: composer
------------------------------------------------------------
CREATE TABLE public.composer(
	num_plat   INT  NOT NULL ,
	num_menu   INT  NOT NULL  ,
	CONSTRAINT composer_PK PRIMARY KEY (num_plat,num_menu)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: BENEFICIAIRE
------------------------------------------------------------
CREATE TABLE public.BENEFICIAIRE(
	num_benef         SERIAL NOT NULL ,
	nom_benef         VARCHAR (50) NOT NULL ,
	prenom_benef      VARCHAR (50) NOT NULL ,
	genre             VARCHAR (10) NOT NULL ,
	date_nais_benef   DATE  NOT NULL ,
	tel_benef         VARCHAR (10) NOT NULL ,
	cp_benef          VARCHAR (50) NOT NULL ,
	num_fo            INT  NOT NULL ,
	id_connexion      INT  NOT NULL  ,
	CONSTRAINT BENEFICIAIRE_PK PRIMARY KEY (num_benef)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: VEHICULE
------------------------------------------------------------
CREATE TABLE public.VEHICULE(
	num_veh      SERIAL NOT NULL ,
	imm_veh      VARCHAR (10) NOT NULL ,
	num_type     INT  NOT NULL ,
	id_cuisine   INT  NOT NULL  ,
	CONSTRAINT VEHICULE_PK PRIMARY KEY (num_veh)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: AVIS
------------------------------------------------------------
CREATE TABLE public.AVIS(
	num_avis       SERIAL NOT NULL ,
	remarques      VARCHAR (10) NOT NULL ,
	attitude_liv   VARCHAR (10) NOT NULL ,
	date_avis      DATE  NOT NULL ,
	num_benef      INT  NOT NULL ,
	num_lib_avis   INT  NOT NULL  ,
	CONSTRAINT AVIS_PK PRIMARY KEY (num_avis)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: LIVRAISON
------------------------------------------------------------
CREATE TABLE public.LIVRAISON(
	num_liv            SERIAL NOT NULL ,
	date_liv           DATE  NOT NULL ,
	etat_liv           BOOL  NOT NULL ,
	num_pers_LIVREUR   INT  NOT NULL ,
	num_liv_LIVREUR    INT  NOT NULL ,
	id_livraison       INT  NOT NULL ,
	num_veh            INT  NOT NULL  ,
	CONSTRAINT LIVRAISON_PK PRIMARY KEY (num_liv)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: FACTURE
------------------------------------------------------------
CREATE TABLE public.FACTURE(
	num_fact       SERIAL NOT NULL ,
	montant_fact   FLOAT  NOT NULL ,
	date_fact      DATE  NOT NULL ,
	num_commande   INT  NOT NULL  ,
	CONSTRAINT FACTURE_PK PRIMARY KEY (num_fact)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: COMMANDE_SEMAINE
------------------------------------------------------------
CREATE TABLE public.COMMANDE_SEMAINE(
	num_commande   SERIAL NOT NULL ,
	date_com       DATE  NOT NULL ,
	date_debut     DATE  NOT NULL ,
	date_fin       DATE  NOT NULL ,
	num_fact       INT  NOT NULL ,
	num_fo         INT  NOT NULL  ,
	CONSTRAINT COMMANDE_SEMAINE_PK PRIMARY KEY (num_commande)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: FOYER
------------------------------------------------------------
CREATE TABLE public.FOYER(
	num_fo         SERIAL NOT NULL ,
	adress_fo      VARCHAR (50) NOT NULL ,
	ID_pos_foyer   INT  NOT NULL  ,
	CONSTRAINT FOYER_PK PRIMARY KEY (num_fo)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: CARTE_LIVRAISON
------------------------------------------------------------
CREATE TABLE public.CARTE_LIVRAISON(
	id_livraison   SERIAL NOT NULL ,
	ligne          VARCHAR (50) NOT NULL ,
	num_liv        INT  NOT NULL  ,
	CONSTRAINT CARTE_LIVRAISON_PK PRIMARY KEY (id_livraison)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: CARTE_POSITION_FOYER
------------------------------------------------------------
CREATE TABLE public.CARTE_POSITION_FOYER(
	ID_pos_foyer   SERIAL NOT NULL ,
	point_fo       VARCHAR (50) NOT NULL ,
	num_fo         INT  NOT NULL  ,
	CONSTRAINT CARTE_POSITION_FOYER_PK PRIMARY KEY (ID_pos_foyer)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: CARTE_POSITION_CUISINE
------------------------------------------------------------
CREATE TABLE public.CARTE_POSITION_CUISINE(
	id_cuisine   SERIAL NOT NULL ,
	point_cui    VARCHAR (50) NOT NULL ,
	num_veh      INT  NOT NULL  ,
	CONSTRAINT CARTE_POSITION_CUISINE_PK PRIMARY KEY (id_cuisine)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: COMMANDE_JOUR
------------------------------------------------------------
CREATE TABLE public.COMMANDE_JOUR(
	commande_jour_id   SERIAL NOT NULL ,
	date_jour          DATE  NOT NULL ,
	num_liv            INT   ,
	num_commande       INT  NOT NULL  ,
	CONSTRAINT COMMANDE_JOUR_PK PRIMARY KEY (commande_jour_id)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: commande_plat
------------------------------------------------------------
CREATE TABLE public.commande_plat(
	num_plat           INT  NOT NULL ,
	num_menu           INT  NOT NULL ,
	commande_jour_id   INT  NOT NULL ,
	qte_commandee      INT  NOT NULL  ,
	CONSTRAINT commande_plat_PK PRIMARY KEY (num_plat,num_menu,commande_jour_id)
)WITHOUT OIDS;




ALTER TABLE public.CUISINIER
	ADD CONSTRAINT CUISINIER_PERSONNEL0_FK
	FOREIGN KEY (num_pers)
	REFERENCES public.PERSONNEL(num_pers);

ALTER TABLE public.PLAT
	ADD CONSTRAINT PLAT_TYPE_PLAT0_FK
	FOREIGN KEY (num_type)
	REFERENCES public.TYPE_PLAT(num_type);

ALTER TABLE public.COMPTE
	ADD CONSTRAINT COMPTE_TYPE_CO0_FK
	FOREIGN KEY (num_type_co)
	REFERENCES public.TYPE_CO(num_type_co);

ALTER TABLE public.LIVREUR
	ADD CONSTRAINT LIVREUR_PERSONNEL0_FK
	FOREIGN KEY (num_pers)
	REFERENCES public.PERSONNEL(num_pers);

ALTER TABLE public.LIVREUR
	ADD CONSTRAINT LIVREUR_COMPTE1_FK
	FOREIGN KEY (id_connexion)
	REFERENCES public.COMPTE(id_connexion);

ALTER TABLE public.LIVREUR 
	ADD CONSTRAINT LIVREUR_COMPTE0_AK 
	UNIQUE (id_connexion);

ALTER TABLE public.contenir
	ADD CONSTRAINT contenir_PLAT0_FK
	FOREIGN KEY (num_plat)
	REFERENCES public.PLAT(num_plat);

ALTER TABLE public.contenir
	ADD CONSTRAINT contenir_INGREDIENTS1_FK
	FOREIGN KEY (num_ingre)
	REFERENCES public.INGREDIENTS(num_ingre);

ALTER TABLE public.reserver
	ADD CONSTRAINT reserver_PERSONNEL0_FK
	FOREIGN KEY (num_pers)
	REFERENCES public.PERSONNEL(num_pers);

ALTER TABLE public.reserver
	ADD CONSTRAINT reserver_CONGE1_FK
	FOREIGN KEY (num_conge)
	REFERENCES public.CONGE(num_conge);

ALTER TABLE public.composer
	ADD CONSTRAINT composer_PLAT0_FK
	FOREIGN KEY (num_plat)
	REFERENCES public.PLAT(num_plat);

ALTER TABLE public.composer
	ADD CONSTRAINT composer_MENU1_FK
	FOREIGN KEY (num_menu)
	REFERENCES public.MENU(num_menu);

ALTER TABLE public.BENEFICIAIRE
	ADD CONSTRAINT BENEFICIAIRE_FOYER0_FK
	FOREIGN KEY (num_fo)
	REFERENCES public.FOYER(num_fo);

ALTER TABLE public.BENEFICIAIRE
	ADD CONSTRAINT BENEFICIAIRE_COMPTE1_FK
	FOREIGN KEY (id_connexion)
	REFERENCES public.COMPTE(id_connexion);

ALTER TABLE public.BENEFICIAIRE 
	ADD CONSTRAINT BENEFICIAIRE_COMPTE0_AK 
	UNIQUE (id_connexion);

ALTER TABLE public.VEHICULE
	ADD CONSTRAINT VEHICULE_TYPE_VEHICULE0_FK
	FOREIGN KEY (num_type)
	REFERENCES public.TYPE_VEHICULE(num_type);

ALTER TABLE public.VEHICULE
	ADD CONSTRAINT VEHICULE_CARTE_POSITION_CUISINE1_FK
	FOREIGN KEY (id_cuisine)
	REFERENCES public.CARTE_POSITION_CUISINE(id_cuisine);

ALTER TABLE public.VEHICULE 
	ADD CONSTRAINT VEHICULE_CARTE_POSITION_CUISINE0_AK 
	UNIQUE (id_cuisine);

ALTER TABLE public.AVIS
	ADD CONSTRAINT AVIS_BENEFICIAIRE0_FK
	FOREIGN KEY (num_benef)
	REFERENCES public.BENEFICIAIRE(num_benef);

ALTER TABLE public.AVIS
	ADD CONSTRAINT AVIS_LIB_AVIS1_FK
	FOREIGN KEY (num_lib_avis)
	REFERENCES public.LIB_AVIS(num_lib_avis);

ALTER TABLE public.AVIS 
	ADD CONSTRAINT AVIS_LIB_AVIS0_AK 
	UNIQUE (num_lib_avis);

ALTER TABLE public.LIVRAISON
	ADD CONSTRAINT LIVRAISON_LIVREUR0_FK
	FOREIGN KEY (num_pers_LIVREUR,num_liv_LIVREUR)
	REFERENCES public.LIVREUR(num_pers,num_liv);

ALTER TABLE public.LIVRAISON
	ADD CONSTRAINT LIVRAISON_CARTE_LIVRAISON1_FK
	FOREIGN KEY (id_livraison)
	REFERENCES public.CARTE_LIVRAISON(id_livraison);

ALTER TABLE public.LIVRAISON
	ADD CONSTRAINT LIVRAISON_VEHICULE2_FK
	FOREIGN KEY (num_veh)
	REFERENCES public.VEHICULE(num_veh);

ALTER TABLE public.LIVRAISON 
	ADD CONSTRAINT LIVRAISON_CARTE_LIVRAISON0_AK 
	UNIQUE (id_livraison);

ALTER TABLE public.FACTURE
	ADD CONSTRAINT FACTURE_COMMANDE_SEMAINE0_FK
	FOREIGN KEY (num_commande)
	REFERENCES public.COMMANDE_SEMAINE(num_commande);

ALTER TABLE public.FACTURE 
	ADD CONSTRAINT FACTURE_COMMANDE_SEMAINE0_AK 
	UNIQUE (num_commande);

ALTER TABLE public.COMMANDE_SEMAINE
	ADD CONSTRAINT COMMANDE_SEMAINE_FACTURE0_FK
	FOREIGN KEY (num_fact)
	REFERENCES public.FACTURE(num_fact);

ALTER TABLE public.COMMANDE_SEMAINE
	ADD CONSTRAINT COMMANDE_SEMAINE_FOYER1_FK
	FOREIGN KEY (num_fo)
	REFERENCES public.FOYER(num_fo);

ALTER TABLE public.COMMANDE_SEMAINE 
	ADD CONSTRAINT COMMANDE_SEMAINE_FACTURE0_AK 
	UNIQUE (num_fact);

ALTER TABLE public.FOYER
	ADD CONSTRAINT FOYER_CARTE_POSITION_FOYER0_FK
	FOREIGN KEY (ID_pos_foyer)
	REFERENCES public.CARTE_POSITION_FOYER(ID_pos_foyer);

ALTER TABLE public.FOYER 
	ADD CONSTRAINT FOYER_CARTE_POSITION_FOYER0_AK 
	UNIQUE (ID_pos_foyer);

ALTER TABLE public.CARTE_LIVRAISON
	ADD CONSTRAINT CARTE_LIVRAISON_LIVRAISON0_FK
	FOREIGN KEY (num_liv)
	REFERENCES public.LIVRAISON(num_liv);

ALTER TABLE public.CARTE_LIVRAISON 
	ADD CONSTRAINT CARTE_LIVRAISON_LIVRAISON0_AK 
	UNIQUE (num_liv);

ALTER TABLE public.CARTE_POSITION_FOYER
	ADD CONSTRAINT CARTE_POSITION_FOYER_FOYER0_FK
	FOREIGN KEY (num_fo)
	REFERENCES public.FOYER(num_fo);

ALTER TABLE public.CARTE_POSITION_FOYER 
	ADD CONSTRAINT CARTE_POSITION_FOYER_FOYER0_AK 
	UNIQUE (num_fo);

ALTER TABLE public.CARTE_POSITION_CUISINE
	ADD CONSTRAINT CARTE_POSITION_CUISINE_VEHICULE0_FK
	FOREIGN KEY (num_veh)
	REFERENCES public.VEHICULE(num_veh);

ALTER TABLE public.CARTE_POSITION_CUISINE 
	ADD CONSTRAINT CARTE_POSITION_CUISINE_VEHICULE0_AK 
	UNIQUE (num_veh);

ALTER TABLE public.COMMANDE_JOUR
	ADD CONSTRAINT COMMANDE_JOUR_LIVRAISON0_FK
	FOREIGN KEY (num_liv)
	REFERENCES public.LIVRAISON(num_liv);

ALTER TABLE public.COMMANDE_JOUR
	ADD CONSTRAINT COMMANDE_JOUR_COMMANDE_SEMAINE1_FK
	FOREIGN KEY (num_commande)
	REFERENCES public.COMMANDE_SEMAINE(num_commande);

ALTER TABLE public.commande_plat
	ADD CONSTRAINT commande_plat_PLAT0_FK
	FOREIGN KEY (num_plat)
	REFERENCES public.PLAT(num_plat);

ALTER TABLE public.commande_plat
	ADD CONSTRAINT commande_plat_MENU1_FK
	FOREIGN KEY (num_menu)
	REFERENCES public.MENU(num_menu);

ALTER TABLE public.commande_plat
	ADD CONSTRAINT commande_plat_COMMANDE_JOUR2_FK
	FOREIGN KEY (commande_jour_id)
	REFERENCES public.COMMANDE_JOUR(commande_jour_id);
