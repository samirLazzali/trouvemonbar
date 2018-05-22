CREATE TABLE "users" (
    username VARCHAR PRIMARY KEY ,
    character_name VARCHAR NOT NULL ,
    password VARCHAR NOT NULL ,
    status VARCHAR NOT NULL 
);

INSERT INTO "users"(username, character_name, password, status) VALUES ('Zigard' ,'Akoda'      , 'mdp', 'GM');
INSERT INTO "users"(username, character_name, password, status) VALUES ('Mixmod' ,'Timmon'     , 'mdp', 'GM');
INSERT INTO "users"(username, character_name, password, status) VALUES ('Alienor','DarkUnicorn', 'mdp', 'GM');
INSERT INTO "users"(username, character_name, password, status) VALUES ('Aenyx'  ,'DevilCat'   , 'mdp', 'GM');

CREATE TABLE "perso" (
    username VARCHAR PRIMARY KEY REFERENCES "users"(username) ,
    character_name VARCHAR NOT NULL ,
    gear VARCHAR ,
    stamina INTEGER NOT NULL ,
    mana INTEGER NOT NULL ,
    strength INTEGER NOT NULL ,
    mind INTEGER NOT NULL ,
    sword_skill INTEGER NOT NULL ,
    staff_skill INTEGER NOT NULL ,
    pet VARCHAR ,
    pet_xp INTEGER ,
    pet_lvl INTEGER ,
    guild VARCHAR ,
    money INTEGER NOT NULL ,
    charac_lvl INTEGER NOT NULL ,
    charac_xp INTEGER NOT NULL ,
    lastquest VARCHAR ,
    endtimequest INTEGER 
);

INSERT INTO "perso" (
       username,
       character_name,
       gear,
       stamina,
       mana,
       strength,
       mind,
       sword_skill,
       staff_skill,
       money,
       charac_lvl,
       charac_xp
) VALUES (
  'Zigard' ,
  'Akoda',
  'Bâton',
  100,
  100,
  50,
  50,
  0,
  0,
  0,
  1,
  0
);

INSERT INTO "perso" (
       username,
       character_name,
       gear,
       stamina,
       mana,
       strength,
       mind,
       sword_skill,
       staff_skill,
       money,
       charac_lvl,
       charac_xp
) VALUES (
  'Mixmod' ,
  'Timmon',
  'Epée',
  100,
  100,
  50,
  50,
  0,
  0,
  0,
  1,
  0
);

INSERT INTO "perso" (
       username,
       character_name,
       gear,
       stamina,
       mana,
       strength,
       mind,
       sword_skill,
       staff_skill,
       money,
       charac_lvl,
       charac_xp
) VALUES (
  'Aenyx' ,
  'DevilCat',
  'Epée',
  100,
  100,
  50,
  50,
  0,
  0,
  0,
  1,
  0
);

INSERT INTO "perso" (
       username,
       character_name,
       gear,
       stamina,
       mana,
       strength,
       mind,
       sword_skill,
       staff_skill,
       money,
       charac_lvl,
       charac_xp
) VALUES (
  'Alienor' ,
  'DarkUnicorn',
  'Bâton',
  100,
  100,
  50,
  50,
  0,
  0,
  0,
  1,
  0
);

CREATE TABLE "guilde" (
    guild_name VARCHAR PRIMARY KEY ,
    guild_symbole VARCHAR NOT NULL ,
    guild_points INTEGER NOT NULL ,
    guild_leader VARCHAR NOT NULL 
);

CREATE TABLE "adventure" (
    q_name VARCHAR(50) PRIMARY KEY ,
    q_level INTEGER NOT NULL ,
    reward_money INTEGER NOT NULL ,
    reward_sword INTEGER NOT NULL ,
    reward_staff INTEGER NOT NULL ,
    reward_xp INTEGER NOT NULL ,
    q_time INTEGER NOT NULL
);

INSERT INTO "adventure"(q_name, q_level, reward_money, reward_sword, reward_staff, reward_xp, q_time) VALUES ('Recherche Pantoufle', 1, 10, 10, 10, 434, 30);
INSERT INTO "adventure"(q_name, q_level, reward_money, reward_sword, reward_staff, reward_xp, q_time) VALUES ('Mise à l épreuve', 4, 20, 20, 20, 1467, 360);
INSERT INTO "adventure"(q_name, q_level, reward_money, reward_sword, reward_staff, reward_xp, q_time) VALUES ('Une petite course', 2, 5, 5, 5, 694, 720);
INSERT INTO "adventure"(q_name, q_level, reward_money, reward_sword, reward_staff, reward_xp, q_time) VALUES ('Participant à un tournois', 6, 50, 27, 27, 2037, 360);
INSERT INTO "adventure"(q_name, q_level, reward_money, reward_sword, reward_staff, reward_xp, q_time) VALUES ('Souris dans mon auberge', 1, 8, 5, 5, 256, 180);
INSERT INTO "adventure"(q_name, q_level, reward_money, reward_sword, reward_staff, reward_xp, q_time) VALUES ();
INSERT INTO "adventure"(q_name, q_level, reward_money, reward_sword, reward_staff, reward_xp, q_time) VALUES ();


CREATE TABLE "pet" (
    species VARCHAR PRIMARY KEY 
);

INSERT INTO "pet"(species) VALUES ('Paresseux');
INSERT INTO "pet"(species) VALUES ('Chat');
INSERT INTO "pet"(species) VALUES ('Mimic');
INSERT INTO "pet"(species) VALUES ('Licorne');
INSERT INTO "pet"(species) VALUES ('Dragon');



CREATE TABLE "items" (
    item_name VARCHAR PRIMARY KEY ,
    price INTEGER NOT NULL 
);

INSERT INTO "items"(item_name, price) VALUES ('Biscuits'           , 10);
INSERT INTO "items"(item_name, price) VALUES ('Potion de Force'    , 100);
INSERT INTO "items"(item_name, price) VALUES ('Potion de Mental'   , 100);
INSERT INTO "items"(item_name, price) VALUES ('Potion de Chance'   , 200);
INSERT INTO "items"(item_name, price) VALUES ('Potion de Fortune'  , 200);
INSERT INTO "items"(item_name, price) VALUES ('Potion de Celerite' , 1000);




CREATE TABLE "inventory" (
    id INTEGER PRIMARY KEY ,
    username VARCHAR PRIMARY KEY REFERENCES "users"(username) ,
    item_name VARCHAR ,
    nb INTEGER NOT NULL 
);
