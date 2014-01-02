CREATE USER 'NoProtection'@'localhost' IDENTIFIED BY 'WllIFvA9YImLIb1L9XZYTEeuBfNuE8KxhS1aXdf6AEFzUCVy5HRP9PurkmSxEXk';
CREATE USER 'EscapeQuery'@'localhost' IDENTIFIED BY '7dBAg4sORWnLqN1QzxhTDin37UM8fEDfGw5ArMCQHLGeUeqm4yZ09sTK82iQKbb';
CREATE USER 'Cookies'@'localhost' IDENTIFIED BY 'sNg2XGgenMPH97sXlENkozd17wzutwo8MzVENrK9famH6d8yxKYgmvtTpb041ir';
CREATE USER 'ServerVariables'@'localhost' IDENTIFIED BY 'lbdfHjmPNPmwy20ZJ6w0a5jvUBLRBIGqesKbUVQzeUUHIbRTJ2hFFvVpG4EBLvB';
CREATE USER 'sudo'@'localhost' IDENTIFIED BY 'QCmy9hSSIk68o0u83JN1DKqZA9aMehgiIexcB4ihnj32J7Q6QPziUKMeyvzP41K';
CREATE USER 'BasicAuth'@'localhost' IDENTIFIED BY 'N0XG1JVj4q6KaEYg1wk3yzHnT2n9p8e94g7ajegSbkqIgaeOkAOCPpnr0iCiKOx';


DROP DATABASE SQLITraining;
CREATE DATABASE SQLITraining;
USE SQLITraining;

CREATE TABLE NoProtection (ID int AUTO_INCREMENT, Username VARCHAR(255), Password VARCHAR(255), PRIMARY KEY (id));
INSERT INTO NoProtection (Username, Password) VALUES ("Admin", MD5('Who here likes apples'));
INSERT INTO NoProtection (Username, Password) VALUES ("Bob", MD5('I like apples'));
INSERT INTO NoProtection (Username, Password) VALUES ("Jim", MD5('alegitpassword'));
INSERT INTO NoProtection (Username, Password) VALUES ("That creepy guy", MD5('goaway'));
INSERT INTO NoProtection (Username, Password) VALUES ("AKA", MD5('its a pain to think up fake passwords'));
INSERT INTO NoProtection (Username, Password) VALUES ("Steve", MD5('Ya wanna see a trick'));
INSERT INTO NoProtection (Username, Password) VALUES ("Hacker", MD5('^never say yes to this'));
INSERT INTO NoProtection (Username, Password) VALUES ("Select * from users;", MD5('Drop table users;'));
INSERT INTO NoProtection (Username, Password) VALUES ("flag", "{This Is Your First Flag, Congratz}");
GRANT ALL ON SQLITraining.NoProtection TO 'NoProtection'@'localhost';

CREATE TABLE EscapeQuery (ID int AUTO_INCREMENT, Username VARCHAR(255), Password VARCHAR(255), YOB int(4), PRIMARY KEY (id));
INSERT INTO EscapeQuery (Username, Password, yob) VALUES ("Admin", MD5('Who here likes apples'), 1937);
INSERT INTO EscapeQuery (Username, Password, yob) VALUES ("Bob", MD5('I like apples'), 1986);
INSERT INTO EscapeQuery (Username, Password, yob) VALUES ("Jim", MD5('alegitpassword'), 1875);
INSERT INTO EscapeQuery (Username, Password, yob) VALUES ("That creepy guy", MD5('goaway'), 1990);
INSERT INTO EscapeQuery (Username, Password, yob) VALUES ("AKA", MD5('its a pain to think up fake passwords'), 1945);
INSERT INTO EscapeQuery (Username, Password, yob) VALUES ("Steve", MD5('Ya wanna see a trick'), 1992);
INSERT INTO EscapeQuery (Username, Password, yob) VALUES ("Hacker", MD5('^never say yes to this'), 1337);
INSERT INTO EscapeQuery (Username, Password, yob) VALUES ("Select * from users;", MD5('Drop table users;'), 1993);
INSERT INTO EscapeQuery (Username, Password, yob) VALUES ("flag", "{Its over 9000, well almost}", 8999);
GRANT ALL ON SQLITraining.EscapeQuery TO 'EscapeQuery'@'localhost';

CREATE TABLE Cookies (ID int AUTO_INCREMENT, Username VARCHAR(255), Password VARCHAR(255), PRIMARY KEY (id));
INSERT INTO Cookies (Username, Password) VALUES ("Admin", MD5('Who here likes apples'));
INSERT INTO Cookies (Username, Password) VALUES ("Bob", MD5('I like apples'));
INSERT INTO Cookies (Username, Password) VALUES ("Jim", MD5('alegitpassword'));
INSERT INTO Cookies (Username, Password) VALUES ("That creepy guy", MD5('goaway'));
INSERT INTO Cookies (Username, Password) VALUES ("AKA", MD5('its a pain to think up fake passwords'));
INSERT INTO Cookies (Username, Password) VALUES ("Steve", MD5('Ya wanna see a trick'));
INSERT INTO Cookies (Username, Password) VALUES ("Hacker", MD5('^never say yes to this'));
INSERT INTO Cookies (Username, Password) VALUES ("Select * from users;", MD5('Drop table users;'));
INSERT INTO Cookies (Username, Password) VALUES ("flag", "{C is for Cookie, that's good enough for me}");
GRANT ALL ON SQLITraining.Cookies TO 'Cookies'@'localhost';

CREATE TABLE ServerVariables (title VARCHAR(1024), message VARCHAR(2048), useragent VARCHAR(1024), userip VARCHAR(1024), verified bool);
INSERT INTO ServerVariables (title, message, useragent, userip, verified) VALUES ('flag', '{Q: Is there anything i can\'t inject? A: No}', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36', '127.0.0.1', true);
GRANT ALL ON SQLITraining.ServerVariables TO 'ServerVariables'@'localhost';

CREATE TABLE BlindBasic(name VARCHAR(1024));
INSERT INTO BlindBasic(name) VALUES ('Darc_Pyro');
GRANT ALL ON SQLITraining.BlindBasic TO 'sudo'@'localhost';

CREATE TABLE BasicAuth(ID int AUTO_INCREMENT, Username VARCHAR(255), Password VARCHAR(255), PRIMARY KEY (id));
INSERT INTO BasicAuth (Username, Password) VALUES ("Hacker", MD5('another crappy password'));
GRANT ALL ON SQLITraining.BasicAuth TO 'BasicAuth'@'localhost';


