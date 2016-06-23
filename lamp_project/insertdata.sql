
USE lamp_final_project;


INSERT INTO categories VALUES
  (null,'sale','Books'),
  (null,'sale','Electronics'),
  (null,'sale','Household'),
  (null,'service','Computer'),
  (null,'service','Finance'),
  (null,'service','Medical'),
  (null,'jobs','FULL_TIME'),
  (null,'jobs','PART_TIME'),
  (null,'jobs','VOLUNTEERING');

INSERT INTO locations VALUES
  (null,'India','Delhi'),
  (null,'India' ,'Mumbai'),
  (null,'India' ,'Hydrabad'),
  (null,'USA','San francisco'),
  (null,'USA','Sacramento'),
  (null,'USA','New York'),
  (null,'UK','London'),
  (null,'UK','Edinburg'),
  (null,'UK','Bristol');

INSERT INTO posts VALUES
  (null,'Hum-Tum book','HUM-TUM','sale', 'Books', 'India', 'Delhi','25','book@info.com',NULL,NULL,NULL,NULL),
  (null,'Three Blind Mice','by Agatha Christie','sale', 'Books', 'India', 'Mumbai','50','k@info.com',NULL,NULL,NULL,NULL),
  (null,'The First Born','by Arthur C Clarke','sale', 'Books','India', 'Hydrabad','45','ok@info.com',NULL,NULL,NULL,NULL),

  (null,'Laptop','Dell Inspiron','sale', 'Electronics','USA', 'San francisco','525','b@info.com',NULL,NULL,NULL,NULL),
  (null,'Tablet','Apple IPad Mini','sale', 'Electronics','USA', 'Sacramento','125','bond@info.com',NULL,NULL,NULL,NULL),
  (null,'Mobile Phone','Nexus 5','sale', 'Electronics','USA', 'New York','225','ty@info.com',NULL,NULL,NULL,NULL),

  (null,'Sofa','Leather, Black','sale', 'Household','UK', 'London','500','yt@hose.com',NULL,NULL,NULL,NULL),
  (null,'TV','Panasonic','sale', 'Household','UK', 'Edinburg','250','av@info.com',NULL,NULL,NULL,NULL),
  (null,'Blender','Ninja','sale', 'Household','UK', 'Bristol','25','pj@yahoo.com',NULL,NULL,NULL,NULL),

  (null,'webcamp repair','7-9mpic','service', 'Computer','India', 'Delhi','258','electronics@red.com',NULL,NULL,NULL,NULL),
  (null,'software update','windows 10 instalment','service', 'Computer','India', 'Mumbai','566','elect@info.com',NULL,NULL,NULL,NULL),
  (null,'hardware upgrade','speakers,microphone,keyboard','service', 'Computer','India', 'Hydrabad','295','electronicsok@gmail.com',NULL,NULL,NULL,NULL),

  (null,'CA','maths and stastics','service', 'Finance','USA', 'Sacramento','25','try@info.com',NULL,NULL,NULL,NULL),
  (null,'MBA','maths and stastics','service', 'Finance','USA', 'New York','25','till@info.com',NULL,NULL,NULL,NULL),
  (null,'Manager','maths and stastics','service', 'Finance','UK', 'London','25','you@info.com',NULL,NULL,NULL,NULL),

  (null,'MBBS','general phy.','service', 'Medical','UK', 'London','500','ayt@hose.com',NULL,NULL,NULL,NULL),
  (null,'MD','heart specialist','service', 'Medical','UK', 'Edinburg','250','bav@info.com',NULL,NULL,NULL,NULL),
  (null,'BAMS','Ayurveda','service', 'Medical','UK', 'Bristol','25','cpj@yahoo.com',NULL,NULL,NULL,NULL),

  (null,'computer engg','software developer','jobs', 'FULL_TIME','India', 'Delhi','825','succeed@info.com',NULL,NULL,NULL,NULL),
  (null,'mechanical engg','autodeal','jobs', 'FULL_TIME','India', 'Mumbai','625','top@info.com',NULL,NULL,NULL,NULL),
  (null,'electrical engg','transformers','jobs', 'FULL_TIME','India', 'Hydrabad','425','two@info.com',NULL,NULL,NULL,NULL),

  (null,'receptionist','MacD','jobs', 'PART_TIME','USA', 'San francisco','525','batman@info.com',NULL,NULL,NULL,NULL),
  (null,'TA','SCSU','jobs', 'PART_TIME','USA', 'Sacramento','125','fevibond@info.com',NULL,NULL,NULL,NULL),
  (null,'Internship','google','jobs', 'PART_TIME','USA', 'New York','225','tasty@info.com',NULL,NULL,NULL,NULL),

  (null,'repair','electronics gadgets','jobs', 'VOLUNTEERING','USA', 'San francisco','10','byte@info.com',NULL,NULL,NULL,NULL),
  (null,'event management','Anywhere in bay area','jobs', 'VOLUNTEERING', 'USA', 'Sacramento','100','london@info.com',NULL,NULL,NULL,NULL),
  (null,'gardning','national park maintainence','jobs', 'VOLUNTEERING','UK', 'Bristol','10','lessions@info.com',NULL,NULL,NULL,NULL);



INSERT INTO login VALUES(null,'user1','123'); 
 
 /* Created by:Apoorva Khandwekar
     Email:apoorvakhandwekar39@gmail.com
  */

