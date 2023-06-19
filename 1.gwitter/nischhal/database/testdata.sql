INSERT INTO users(username, passkey) 
    VALUES
        ("naruto", "naruto123"),
        ("madara", "madara123"),
        ("kakashi", "kakashi123"),
        ("sasuke", "sasuke123"),
        ("jiriya", "jiriya123"),
        ("obito", "obito123"),
        ("pain", "pain123"),
        ("tsunade", "tsunade123"),
        ("hinata", "hinata123");

INSERT INTO followed_by(username, followed_by) 
    VALUES
        ("naruto","hinata"),
        ("naruto","sasuke"),
        ("naruto","jiriya"),
        ("hinata","naruto"),
        ("hinata","tsunade"),
        ("tsunade", "naruto"),
        ("jiriya", "tsunade"),
        ("madara", "sasuke");

INSERT INTO gweets(username, gweet) 
    VALUES
        ("naruto", "Hard work is worthless for those that don’t believe in themselves."),
        ("madara", "When a man learns to love, he must bear the risk of hatred."),
        ("kakashi", "As long as you don’t give up, you can still be saved!"),
        ("sasuke", "It's not the future I dream of anymore, only the past."),
        ("jiriya", "A place where someone still thinks about you is a place you can call home."),
        ("obito", "There is no such thing as peace in this world—that is reality."),
        ("pain", "The cure for the pain is in the pain."),
        ("tsunade", "Only when it comes to money. My life is a different story. I’m still alive aren’t I?"),
        ("hinata", "Stand up together with me, Naruto.");

