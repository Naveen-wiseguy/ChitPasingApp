Users table:

create table disec_countries(
country varchar(30),
PRIMARY KEY (country)
);

create table disec_users(
username varchar(50),
password varchar(50),
country varchar(50),
PRIMARY KEY (username),
FOREIGN KEY (country) REFERENCES disec_countries(country)
);

create table disec_msg(
id int AUTO_INCREMENT,
frm varchar(50),
recipient varchar(50),
message text,
sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
eb BOOLEAN,
FOREIGN KEY (frm) REFERENCES disec_users(username),
FOREIGN KEY (recipient) REFERENCES disec_users(username),
PRIMARY KEY (id)
);

create table disec_gsl(
id int AUTO_INCREMENT,
country varchar(50) UNIQUE,
PRIMARY KEY(id),
FOREIGN KEY (country) REFERENCES disec_countries(country)
);

create table eb_cred(
council varchar(20),
password varchar(50),
PRIMARY KEY (council)
);

create index msg_index on disec_msg (frm,recipient);