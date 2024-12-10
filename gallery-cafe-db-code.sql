DROP DATABASE main_db;
CREATE DATABASE main_db;

CREATE TABLE customer (
	customer_id BIGINT PRIMARY KEY AUTO_INCREMENT,
    id BIGINT UNIQUE NOT NULL,
	fullname VARCHAR(50) NOT NULL,
    mobile_no VARCHAR(50) NOT NULL,
	username VARCHAR(25) NOT NULL UNIQUE,
	password VARCHAR(25) NOT NULL	
);

CREATE TABLE admin (
	admin_id BIGINT PRIMARY KEY AUTO_INCREMENT,
	fullname VARCHAR(50) NOT NULL,
    mobile_no VARCHAR(50) NOT NULL,
	username VARCHAR(25) NOT NULL UNIQUE,
	password VARCHAR(25) NOT NULL	
);

CREATE TABLE staff (
	staff_id BIGINT PRIMARY KEY AUTO_INCREMENT,
	fullname VARCHAR(50) NOT NULL,
    mobile_no VARCHAR(50) NOT NULL,
	username VARCHAR(25) NOT NULL UNIQUE,
	password VARCHAR(25) NOT NULL
);

CREATE TABLE food (
	food_id BIGINT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
    cusine_type VARCHAR(255) NOT NULL,
    price VARCHAR(100) NOT NULL,
    image VARCHAR(255) NOT NULL
);

CREATE TABLE food_preorder (
	order_id BIGINT AUTO_INCREMENT,
    customer_id BIGINT NOT NULL,
    food_id BIGINT NOT NULL,
    quantity BIGINT NOT NULL,
    state VARCHAR(50) NULL,
    CONSTRAINT PK_customer_order_id PRIMARY KEY (order_id, customer_id),
	CONSTRAINT FK_customer_id FOREIGN KEY (customer_id) REFERENCES customer(customer_id),
    CONSTRAINT FK_food_id FOREIGN KEY (food_id) REFERENCES food(food_id)
);

CREATE TABLE table_reservation (
	table_reservation_id BIGINT PRIMARY KEY AUTO_INCREMENT,
    customer_id BIGINT NOT NULL,
	name VARCHAR(100) NOT NULL,
    person BIGINT NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    state VARCHAR(50) NULL,
	CONSTRAINT FK_customer_id FOREIGN KEY (customer_id) REFERENCES customer(customer_id)
);

CREATE TABLE message (
	message_id BIGINT PRIMARY KEY AUTO_INCREMENT,
    customer_id BIGINT NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    respond VARCHAR(50) NULL,
	CONSTRAINT FK_customer_id FOREIGN KEY (customer_id) REFERENCES customer(customer_id)
);


INSERT INTO admin (fullname, mobile_no, username, password)
VALUES
	('Lanka Leelarathna', '0773327832', 'lanka', 'lanka123');


INSERT INTO staff (fullname, mobile_no, username, password)
VALUES
	('Lanka Leelarathna', '0773327832', 'lanka', 'lanka123');


INSERT INTO food (name, cusine_type, price, image)
VALUES 
	('Hot Dog', 'American', '1000', 'pictures\\food-card-pictures\\hot-dog.jpg'),
	('Cheese Kottu', 'Sri Lankan', '1500', 'pictures\\food-card-pictures\\cheese-kottu.jpg'),
	('Sushi', 'Chinese', '2000', 'pictures\\food-card-pictures\\shushi.jpg'),
	('Tacos', 'Mexican', '1300', 'pictures\\food-card-pictures\\tacos.jpg'),
	('Margherita Pizza', 'Italian', '2500', 'pictures\\food-card-pictures\\pizza-margherita.jpg'),
	('Baozi', 'Chinese', '850', 'pictures\\food-card-pictures\\baozi.jpg'),
	('Mango Lassi', 'Indian', '450', 'pictures\\food-card-pictures\\mango-lassi.jpg'),
	('Cheese Burger', 'American', '1550', 'pictures\\food-card-pictures\\cheese-burger.jpg'),
	('String Hoppers', 'Sri Lankan', '530', 'pictures\\food-card-pictures\\string-hoppers.jpg'),
	('Dum Biriyani', 'Indian', '2600', 'pictures\\food-card-pictures\\biriryani.jpg'),
	('Spaghetti', 'Italian', '2000', 'pictures\\food-card-pictures\\spaghetti.jpg'),
	('Blueberry Mojito', 'Cuban', '800', 'pictures\\food-card-pictures\\mojito.jpg');




