.tables

insert into users ("username", "password") values 
( "girish", "giriskK8"),
( "gamvir", "gunamuna8"),
( "samir", "123school8"),
( "json", "hero@k8888"),
( "vabisya", "mahat999888"),
( "sacar", "232www8888"),
( "vasme", "donHoMa8888"),
( "irish", "sherpa888"),
( "sankhar", "hardikKK888"),
( "sherpa", "gaunleKTO888")
;

insert into posts ("userId","username", "title") values 
(1, "girish", "SomLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "girish", "gamvpsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "girish", "samisum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "girish", "jsonum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "girish", "vabiipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "girish", "sacasum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "girish", "vasmsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "girish", "giripsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "girish", "sankipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(1, "girish", "sheipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(2, "gamvir", "jsosum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(2, "gamvir", "vab ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(2, "gamvir", "sacpsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
(2, "gamvir", "vaspsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.")
;


insert into comments ("postId", "userId", "username", "title") values 
(1, 1, "girish", "Mycomment"),
(1, 2, "gamvir", "My next comment"),
(1, 2, "gamvir", "Mycomment"),
(2, 1, "girish",  "Mycomment"),
(3, 1, "girish", "Mycomment"),
(4, 1, "girish",  "Mycomment"),
(5, 1, "girish", "Mycomment"),
(6, 1, "girish", "Mycomment")
;

insert into followers ("userId", "followerId") values 
(1,2),
(1,3),
(1,4),
(2,1),
(2,3),
(3,1),
(3,2),
(4,1)
;

insert into followings ("userId", "followingId") values 
(1, 3),
(1, 2),
(1, 4),
(2, 1),
(2, 3),
(2, 4),
(3, 1),
(3, 2)
;

