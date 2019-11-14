DROP TABLE album;
CREATE TABLE album (id INTEGER PRIMARY KEY AUTOINCREMENT, artist varchar(100) NOT NULL, title varchar(100) NOT NULL, date DATE NOT NULL);
INSERT INTO album (artist, title, date) VALUES ('The Military Wives', 'In My Dreams', '2017-01-10');
INSERT INTO album (artist, title, date) VALUES ('Adele', '21', '2018-09-12');
INSERT INTO album (artist, title, date) VALUES ('Bruce Springsteen', 'Wrecking Ball (Deluxe)', '2003-11-12');
INSERT INTO album (artist, title, date) VALUES ('Lana Del Rey', 'Born To Die', '2016-04-15');
INSERT INTO album (artist, title, date) VALUES ('Gotye', 'Making Mirrors', '2015-08-04');