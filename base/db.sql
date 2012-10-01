# ADMIN ACCESS TABLE LIST
# ENSURE THAT ATLEAST ONE ADMIN STAYS IN THIS.
CREATE TABLE AT_ADMIN (
	ID INTEGER PRIMARY KEY AUTO_INCREMENT,
	USERNAME VARCHAR(75),
	PASSWORD VARCHAR(75)
);

# POSTS TABLE TO CONTAIN THE DATA
CREATE TABLE AT_POSTS (
	ID INTEGER PRIMARY KEY AUTO_INCREMENT, #UNIQUE ID FOR THE POST
	UID INTEGER DEFAULT NULL, #DEFAULT CAN BE NULL TO GIVE A POSSIBLE CHOICE OF ANONYMUS POSTER
	TITLE VARCHAR(255) NOT NULL, #THE POST'S TITLE
	POST TEXT, #THE PLACE TO CONTAIN THE ACTUAL HTML OF THE POST
	STATUS SMALLINT DEFAULT 0, #0- DRAFT, 1- PUBLISHED
	
	CREATED TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, #MYSQL DOESNT ALLOW CURRENT_TIMESTAMP FOR 2 COLUMS, TAKE CARE IF THIS IN PHP
	UPDATED TIMESTAMP,
	PUBLISHED TIMESTAMP,

	FOREIGN KEY(UID) REFERENCES AT_ADMIN(ID),

	FULLTEXT (TITLE,POST),
	INDEX (TITLE(85),POST(247))
)ENGINE=MyISAM CHARACTER SET=utf8;
