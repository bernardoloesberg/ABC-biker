INSERT INTO customer
(customerlastname,customerfirstname,phonenumber,sex,companyname,contactlastname,contactfirstname,email)
VALUES
('Bernardo','Loesberg','0600000000','M','Hogeschool van Arnhem en Nijmegen','Bram','Geurts','bram.geurts@outlook.com'),
('Tom','Kooiman','0600000000','M','Hogeschool van Arnhem en Nijmegen','Bram','Geurts','bram.geurts@outlook.com'),
('Christaan','ten Voorde','0600000000','M','Hogeschool van Arnhem en Nijmegen','Bram','Geurts','bram.geurts@outlook.com'),
('Ruben','van der Horst','0600000000','M','Hogeschool van Arnhem en Nijmegen','Bram','Geurts','bram.geurts@outlook.com'),
('Bram','Geurts','0600000000','M','Hogeschool van Arnhem en Nijmegen','Bram','Geurts','bram.geurts@outlook.com');

INSERT INTO district (districtname)
VALUES
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

INSERT INTO consignment
(customernumber,deliveraddressnumber,pickupaddressnumber,consignorname)
VALUES
(3,1,5,'Christaan ten Voorde'),
(2,2,3,'Tom Kooiman'),
(1,3,4,'Bernardo Loesberg'),
(5,4,2,'Bram Geurts'),
(3,5,1,'Ruben van der Horst');

INSERT INTO employee
(addressnumber,employeelastname,employeefirstname,bsn,cellphone,birthday,sex)
VALUES
(1,'Ruby','Stalenburg','0000000000','0600000000','1970-01-01','V'),
(2,'James','Boris','0000000000','0600000000','1970-02-01','M'),
(1,'Ronald','Reagan','0000000000','0600000000','1991-03-01','M'),
(5,'Max','Albarttus','0000000000','0600000000','1989-04-01','M'),
(1,'Jan','Snot','0000000000','0600000000','1991-03-01','M'),
(2,'Piet','Alleman','0000000000','0600000000','1989-04-01','M');

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

INSERT INTO Manager
(employeenumber)
VALUES
(3);

INSERT INTO Bus
(employeenumber)
VALUES
(1);

INSERT INTO Dispatcher
(employeenumber)
VALUES
(4);


INSERT INTO Parcel
(consignmentnumber,pickupemployeenumber,deliveremployeenumber,tracking,weightingrams,pickuptime,deliverytime)
VALUES
(1,2,2,'q244rfxzf',10,null,null),
(2,1,1,'q244rfxzf',10,1,1);

/*Nieuwe inserts*/
INSERT INTO customer
(customerlastname,customerfirstname,phonenumber,sex,companyname,email,password)
VALUES
('Loesberg', 'Bernardo', '0600000000', 'M', 'Hogeschool van Arnhem en Nijmegen','test@live.nl',''),
('Kooiman', 'Tom', '0600000000', 'M', 'Hogeschool van Arnhem en Nijmegen','test@live.nl',''),
('ten Voorde', 'Christiaan', '0600000000', 'M', 'Hogeschool van Arnhem en Nijmegen','test@live.nl',''),
('Geurts', 'Bram', '0600000000', 'M', 'Hogeschool van Arnhem en Nijmegen','test@live.nl',''),
('van der Horst', 'Ruben', '0600000000', 'M', 'Hogeschool van Arnhem en Nijmegen','test@live.nl','')

INSERT INTO employee
(addressnumber,employeelastname,employeefirstname,bsn,cellphone,birthday,sex)
VALUES
(1,'Ruby','Stalenburg','0000000000','0600000000','1970-01-01','V', '')