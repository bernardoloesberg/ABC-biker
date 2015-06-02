INSERT INTO customer
(customerlastname,customerfirstname,phonenumber,sex,companyname,email)
VALUES
('Bernardo','Loesberg','0600000000','M','Hogeschool van Arnhem en Nijmegen','bram.geurts@outlook.com'),
('Tom','Kooiman','0600000000','M','Hogeschool van Arnhem en Nijmegen','bram.geurts@outlook.com'),
('Christaan','ten Voorde','0600000000','M','Hogeschool van Arnhem en Nijmegen','bram.geurts@outlook.com'),
('Ruben','van der Horst','0600000000','M','Hogeschool van Arnhem en Nijmegen','bram.geurts@outlook.com'),
('Bram','Geurts','0600000000','M','Hogeschool van Arnhem en Nijmegen','bram.geurts@outlook.com');

INSERT INTO district (districtname)
VALUES
  ('Niet toegewezen'),
  ('Arnhem'),
  ('Nijmegen'),
  ('Velp'),
  ('Rheden'),
  ('Dieren');

INSERT INTO address
(districtnumber,street,zipcode,housenumber,city,housenumberaddon)
VALUES
(1,'Twikkel straat','6825BV', 1, 'Arnhem',''),
(2,'Tapir straat','6532AL', 2, 'Nijmegen',''),
(3,'Troelstra straat','6882HD', 2, 'Velp',''),
(5,'Zilverakkerweg','6952DX', 3, 'Dieren',''),
(1,'Ruitenberglaan', '6826CC', 4, 'Arnhem', ''),
(1,'Tak straat', '6826GC', 1, 'Arnhem', ''),
(1,'Blag laan', '6826AC', 2, 'Arnhem', ''),
(1,'Poklo laan', '6826CH', 3, 'Arnhem', '');

INSERT INTO addressforcustomer
(customernumber,addressnumber)
VALUES
(1,1),
(2,2),
(3,3),
(4,5),
(5,4);
/*
INSERT INTO consignment
(customernumber,deliveraddressnumber,pickupaddressnumber,consignorname)
VALUES
(3,1,5,'Christaan ten Voorde'),
(2,2,3,'Tom Kooiman'),
(1,3,4,'Bernardo Loesberg'),
(5,4,2,'Bram Geurts'),
(3,5,1,'Ruben van der Horst');*/

INSERT INTO employee
(addressnumber,employeelastname,employeefirstname,bsn,cellphone,birthday,sex, password)
VALUES
  (1,'Ruby','Stalenburg','0000000000','0600000000','1970-01-01','V', 'qwerty'),
  (2,'James','Boris','0000000000','0600000000','1970-02-01','M', 'password'),
  (1,'Ronald','Reagan','0000000000','0600000000','1991-03-01','M', 'wachtwoord'),
  (5,'Max','Albarttus','0000000000','0600000000','1989-04-01','M', 'test123'),
  (1,'Jan','Snot','0000000000','0600000000','1991-03-01','M', 'fiets'),
  (2,'Piet','Alleman','0000000000','0600000000','1989-04-01','M', 'geheim');

INSERT INTO biker
(employeenumber, express, maxdeliveries)
VALUES
  (1, 1, 20),
  (2, 0, 10),
  (5, 1, 25),
  (6, 0, 25);

INSERT INTO workingDistrict
(districtnumber, employeenumber, weeknumber)
VALUES
  (1, 1, 20),
  (2, 2, 20),
  (1, 5, 20),
  (2, 6, 20);

INSERT INTO price
VALUES
  (0,0,2,5),
  (0,0.5,2.5,6),
  (0,3.0,4,8),
  (0,8,NULL,NULL),

  (2,0,3,6),
  (2,0.5,3.5,7),
  (2,3.0,5,8),
  (2,8.0, NULL, NULL),

  (4,0,4,7),
  (4,0.5,4.5,8),
  (4,3.0,6,9),
  (4,8.0, NULL, NULL),

  (6,0,5,8),
  (6,0.5,5.5,9),
  (6,3.0,7,10),
  (6,8.0, NULL, NULL),

  (10,0,6,NULL),
  (10,0.5,7,NULL),
  (10,3.0,8,NULL),
  (10,8.0,NULL,NULL)


/*
INSERT INTO Parcel
(consignmentnumber,pickupemployeenumber,deliveremployeenumber,tracking,weightingrams,pickuptime,deliverytime)
VALUES
(1,2,2,'q244rfxzf',10,null,null),
(2,1,1,'q244rfxzf',10,1,1);*/