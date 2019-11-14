DROP TABLE album;
CREATE TABLE album (id INTEGER PRIMARY KEY AUTOINCREMENT, artist varchar(100) NOT NULL, title varchar(100) NOT NULL, date DATE NOT NULL, age INTEGER);
INSERT INTO album (artist, title, date, age) VALUES ('The Military Wives', 'In My Dreams', '2017-01-10', 2);
INSERT INTO album (artist, title, date, age) VALUES ('Adele', '21', '2018-09-12', 1);
INSERT INTO album (artist, title, date, age) VALUES ('Bruce Springsteen', 'Wrecking Ball (Deluxe)', '2003-11-12', 6);
INSERT INTO album (artist, title, date, age) VALUES ('Lana Del Rey', 'Born To Die', '2016-04-15', 3);
INSERT INTO album (artist, title, date, age) VALUES ('Gotye', 'Making Mirrors', '2015-08-04', 4);