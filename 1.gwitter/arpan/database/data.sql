INSERT INTO User ("username","password") VALUES
("arpan","arpan19"),
("bishnu","bishnu29"),
("sarika","sarika39"),
("suraj","suraj49"),
("arjun","arjun59")
;

INSERT INTO Gweet("user_id","gweet") VALUES
(1,"hi this is my first tweet"),
(2,"hello guys how u doin"),
(2,"this is sqlite"),
(3,"gajabaar is fun"),
(4,"security boom boom"),
(5,"be careful of sql injection")
;

INSERT INTO Comment("user_id","gweet_id","comment") VALUES
(1,1,"this is a comment"),
(1,2,"hola ho ho"),
(2,3,"k xa khabar"),
(5,3,"nice pic"),
(3,4,"great")
;

INSERT INTO Follower("user_id","follower_id") VALUES
(1,2),
(2,1),
(3,2),
(4,5),
(5,3)
;

INSERT INTO Following("user_id","following_id") VALUES
(1,2),
(2,1),
(2,3),
(3,5),
(5,4)
;