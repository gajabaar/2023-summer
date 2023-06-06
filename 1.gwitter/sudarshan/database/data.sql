INSERT INTO users (username, password)
VALUES
    ("luffy", "strawhat"),
    ("zoro", "swordsman"),
    ("nami", "navigator"),
    ("sanji", "cook"),
    ("usopp", "sniper"),
    ("chopper", "doctor"),
    ("robin", "archeologist"),
    ("franky", "shipwright"),
    ("brook", "musician"),
    ("jinbe", "fishman");

INSERT INTO gweets (gweet, user_id)
VALUES
    ("Just had a meat feast with Monkey D. Luffy. The guy sure knows how to eat!", 3),
    ("Zoro tried to slice a banana, but somehow ended up with a coconut in two pieces!", 2),
    ("Nami swindled me into buying a treasure map. Turns out, it led to a hidden stash of socks!", 4),
    ("Sanji cooked a meal that made my taste buds explode! Who needs the Grand Line with food like this?", 1),
    ("Usopp told a tall tale about a sea king that had a pet seagull. Can you believe it?", 6),
    ("Chopper transformed into a giant reindeer and gave everyone a ride around the ship. So much fun!", 5),
    ("Robin unveiled a mysterious book with ancient secrets. I can't wait to uncover its mysteries!", 7),
    ("Franky built a cola-powered cannon that shoots fireworks. The party is on!", 10),
    ("Brook played a hauntingly beautiful melody that made even the sea kings shed tears. The power of music!", 9),
    ("Jinbe taught me how to swim like a fishman. Now I can explore the ocean depths!", 8);




INSERT INTO followers (uid, followed_by)
VALUES
    (1, 2), (1, 4), (1, 6), (1, 8),
    (2, 1), (2, 3), (2, 5), (2, 7),
    (3, 2), (3, 4), (3, 6), (3, 8),
    (4, 1), (4, 3), (4, 5), (4, 7),
    (5, 2), (5, 4), (5, 6), (5, 8),
    (6, 1), (6, 3), (6, 5), (6, 7),
    (7, 2), (7, 4), (7, 6), (7, 8),
    (8, 1), (8, 3), (8, 5), (8, 7),
    (9, 2), (9, 4), (9, 6), (9, 8),
    (10, 1), (10, 3), (10, 5), (10, 7);    