
CREATE DATABASE lamp_final_project;

USE lamp_final_project;


CREATE TABLE categories(
  category_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  main_category VARCHAR(30) NOT NULL,
  sub_category VARCHAR(30) NOT NULL );


CREATE TABLE locations(
  location_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  country VARCHAR(30) NOT NULL,
  city VARCHAR(30) NOT NULL );

CREATE TABLE posts(
  post_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(30) NOT NULL,
  description VARCHAR(70),
  category VARCHAR(40) NOT NULL,
  sub_category VARCHAR(40) NOT NULL,
  country VARCHAR(40) NOT NULL,
  city VARCHAR(40) NOT NULL,
  cost INT UNSIGNED ,
  email VARCHAR(40) NOT NULL,
  img1 VARCHAR(256),
  img2 VARCHAR(256),
  img3 VARCHAR(256),
  img4 VARCHAR(256) );

CREATE TABLE login(
  login_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(40) NOT NULL,
  password VARCHAR(20) NOT NULL);
 
 /* Created by:Apoorva Khandwekar
     Email:apoorvakhandwekar39@gmail.com
  */

