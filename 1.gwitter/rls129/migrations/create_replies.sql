CREATE TABLE Reply(
	parent_id INTEGER NOT NULL,
	reply_id INTEGER NOT NULL,

	FOREIGN KEY (parent_id) REFERENCES Gweets(id),
	FOREIGN KEY (reply_id) REFERENCES Gweets(id)
);
