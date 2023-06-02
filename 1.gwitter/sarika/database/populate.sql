INSERT INTO users("firstName", "lastName", "username", "password") VALUES 
("Sarika", "Ghimire", "latrodectus", "s@r!k@21"),
("Arpan", "Paudel", "daudel", "ihaveproperties"),
("Suraj", "Dhakal", "dhakaldim", "wholetthedogsout"),
("Bishnu", "Paudel", "iamdesigner","arpanlies")
;

INSERT INTO followers("userID", "followersID") VALUES 
(1,1),
(2,2),
(3,3),
(4,4);

INSERT INTO followings("userID","followingID") VALUES 
(1,1),
(2,2),
(3,3),
(4,4);

INSERT INTO gweets("gweet", "userID") VALUES 
("Hi Arpan has properties!", 1 ),
("I think I should change the cooling fan of my laptop", 2),
("Happy Pride Month", 3),
("Pokhara doesn't have good companies!!!", 4);

INSERT INTO comments("comment", "gweetID", "userID") VALUES 
("That is true", 1, 1),
("Yeah It makes annoying noise", 2, 2),
("Let's your month together", 3, 3),
("Intern Paayeu?", 4, 4);

