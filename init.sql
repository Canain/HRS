SET storage_engine = INNODB;

/* Management = management
Username = username
Password = password */

CREATE TABLE management (
	username VARCHAR(255) NOT NULL,
	password VARCHAR(255)
);

/* Customer = customer
Username = username
Password = password
Email = email */

CREATE TABLE customer (
	username VARCHAR(255) NOT NULL,
	password VARCHAR(255),
	email VARCHAR(255) UNIQUE,
	PRIMARY KEY(username)
);

/* Room = room
Location = location
Room # = num
Cost/Day = cost
Room Category = category
# People = people
Cost of Extra Bed/Day = cost_extra_bed*/

CREATE TABLE room (
	location VARCHAR(255) NOT NULL,
	num INT NOT NULL,
	cost DECIMAL,
	category VARCHAR(255),
	people INT,
	cost_extra_bed DECIMAL,
	PRIMARY KEY (location,num),
	CHECK(location='Atlanta' OR location='Charlotte' OR location='Savannah' OR location='Orlando' OR location='Miami'),
CHECK(people=2 OR people=4)
);


/* Hotel Review = review
Review # = id
Location = location
Rating = rating
Comment = comment
Username = username */

CREATE TABLE review (
	id INT NOT NULL,
	location VARCHAR(255) NOT NULL,
	rating VARCHAR(255),
	comment TEXT,
	username VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
	FOREIGN KEY (username) REFERENCES customer(username),
	CHECK(location='Atlanta' OR location='Charlotte' OR location='Savannah' OR location='Orlando' OR location='Miami'),
	CHECK(rating='Excellent' OR rating='Good' OR rating='Bad' OR rating='Very Bad' OR rating='Neutral')
);




/* Payment Information = payment
Card # = card_no
CVV = cvv
Exp. Date = exp_date
Name = name
Username = username */

CREATE TABLE payment (
	card_no 	INT 	NOT NULL,
    	cvv 		INT,
    	exp_date 	DATE,
    	name 		VARCHAR(255),
    	username 	VARCHAR(255) NOT NULL,
    	PRIMARY KEY(card_no),
	FOREIGN KEY(username) REFERENCES customer(username)
);

/* ReservationID = reservation_id
Start Date = start_date
End Date = end_date
Is Cancelled? = is_cancelled
Total Cost = total_cost
Card # = card_no
Username = username */

CREATE TABLE reservation(
	reservation_id	INT	NOT NULL,
    	start_date	DATE 	NOT NULL,
    	end_date	DATE 	NOT NULL,
    	is_cancelled 	BOOLEAN,
    	total_cost	DECIMAL,
    	card_no	INT,
   	username	VARCHAR(255) NOT NULL,
    	PRIMARY KEY(reservation_id),
    	FOREIGN KEY(card_no) 	REFERENCES payment(card_no)
ON DELETE SET NULL,
    	FOREIGN KEY(username) 	REFERENCES customer(username)
);

/* ReservationID = reservation_id
Location = location
Room # = room_no
Include Extra Bed? = extra_bed*/

CREATE TABLE reservation_has_room (
	reservation_id INT NOT NULL,
	location VARCHAR(255) NOT NULL,
    	room_no INT NOT NULL,
	extra_bed BOOLEAN,
	PRIMARY KEY(reservation_id, location, room_no),
  	FOREIGN KEY(reservation_id) REFERENCES reservation(reservation_id),
    	FOREIGN KEY(location, room_no) REFERENCES room(location, num),
    	CHECK(location='Atlanta' OR location='Charlotte' OR location='Savannah' OR  location='Orlando' OR location='Miami')
);
