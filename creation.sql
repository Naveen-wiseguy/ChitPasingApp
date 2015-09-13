/*Disec tables:
*/
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

/* SC tables */
create table sc_countries(
country varchar(30),
PRIMARY KEY (country)
);

create table sc_users(
username varchar(50),
password varchar(50),
country varchar(50),
PRIMARY KEY (username),
FOREIGN KEY (country) REFERENCES sc_countries(country)
);

create table sc_msg(
id int AUTO_INCREMENT,
frm varchar(50),
recipient varchar(50),
message text,
sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
eb BOOLEAN,
FOREIGN KEY (frm) REFERENCES sc_users(username),
FOREIGN KEY (recipient) REFERENCES sc_users(username),
PRIMARY KEY (id)
);

create table sc_gsl(
id int AUTO_INCREMENT,
country varchar(50) UNIQUE,
PRIMARY KEY(id),
FOREIGN KEY (country) REFERENCES sc_countries(country)
);

/* EU tables */

create table eu_countries(
country varchar(30),
PRIMARY KEY (country)
);

create table eu_users(
username varchar(50),
password varchar(50),
country varchar(50),
PRIMARY KEY (username),
FOREIGN KEY (country) REFERENCES eu_countries(country)
);

create table eu_msg(
id int AUTO_INCREMENT,
frm varchar(50),
recipient varchar(50),
message text,
sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
eb BOOLEAN,
FOREIGN KEY (frm) REFERENCES eu_users(username),
FOREIGN KEY (recipient) REFERENCES eu_users(username),
PRIMARY KEY (id)
);

create table eu_gsl(
id int AUTO_INCREMENT,
country varchar(50) UNIQUE,
PRIMARY KEY(id),
FOREIGN KEY (country) REFERENCES eu_countries(country)
);

/*HRC tables */
create table hrc_countries(
country varchar(30),
PRIMARY KEY (country)
);

create table hrc_users(
username varchar(50),
password varchar(50),
country varchar(50),
PRIMARY KEY (username),
FOREIGN KEY (country) REFERENCES hrc_countries(country)
);

create table hrc_msg(
id int AUTO_INCREMENT,
frm varchar(50),
recipient varchar(50),
message text,
sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
eb BOOLEAN,
FOREIGN KEY (frm) REFERENCES hrc_users(username),
FOREIGN KEY (recipient) REFERENCES hrc_users(username),
PRIMARY KEY (id)
);

create table hrc_gsl(
id int AUTO_INCREMENT,
country varchar(50) UNIQUE,
PRIMARY KEY(id),
FOREIGN KEY (country) REFERENCES hrc_countries(country)
);

/* IAEA tables */

create table iaea_countries(
country varchar(30),
PRIMARY KEY (country)
);

create table iaea_users(
username varchar(50),
password varchar(50),
country varchar(50),
PRIMARY KEY (username),
FOREIGN KEY (country) REFERENCES iaea_countries(country)
);

create table iaea_msg(
id int AUTO_INCREMENT,
frm varchar(50),
recipient varchar(50),
message text,
sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
eb BOOLEAN,
FOREIGN KEY (frm) REFERENCES iaea_users(username),
FOREIGN KEY (recipient) REFERENCES iaea_users(username),
PRIMARY KEY (id)
);

create table iaea_gsl(
id int AUTO_INCREMENT,
country varchar(50) UNIQUE,
PRIMARY KEY(id),
FOREIGN KEY (country) REFERENCES iaea_countries(country)
);


create table eb_cred(
council varchar(20),
password varchar(50),
PRIMARY KEY (council)
);

create table ip_cred(
council varchar(20),
password varchar(50),
PRIMARY KEY (council)
);

create index disec_msg_index on disec_msg (frm,recipient);
create index sc_msg_index on sc_msg (frm,recipient);
create index hrc_msg_index on hrc_msg (frm,recipient);
create index eu_msg_index on eu_msg (frm,recipient);
create index iaea_msg_index on iaea_msg (frm,recipient);