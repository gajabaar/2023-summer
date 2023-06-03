.tables

insert into Users ("Username", "Password") values 
( "girish", "giriskK8"),
( "gamvir", "gunamuna8"),
( "samir", "123school8"),
( "json", "hero@k8888"),
( "vabisya", "mahat999888"),
( "sacar", "232www8888"),
( "vasme", "donHoMa8888"),
( "girish", "sherpa888"),
( "sankhar", "hardikKK888"),
( "sherpa", "gaunleKTO888")
;

insert into Posts ("UserId", "Title") values 
(1, "SomLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "gamvpsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "samisum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "jsonum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "vabiipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "sacasum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "vasmsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "giripsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "sankipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "sheipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(2, "jsosum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(2, "vab ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(2, "sacpsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(2, "vaspsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.")
;


insert into Comments ("PostId", "UserId", "Title") values 
(1, 1, "Mycomment"),
(1, 2, "My next comment"),
(1, 2, "Mycomment"),
(2, 1, "Mycomment"),
(3, 1, "Mycomment"),
(4, 1, "Mycomment"),
(5, 1, "Mycomment"),
(6, 1, "Mycomment")
;

insert into Followers ("UserId", "FollowerId") values 
(1,2),
(1,3),
(1,4),
(2,1),
(2,3),
(3,1),
(3,2),
(4,1)
;

insert into Followings ("UserId", "FollowingId") values 
(1, 3),
(1, 2),
(1, 4),
(2, 1),
(2, 3),
(2, 4),
(3, 1),
(3, 2)
;

