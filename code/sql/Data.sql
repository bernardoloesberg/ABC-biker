INSERT INTO customer
(customernumber,customerlastname,customerfirstname,phonenumber,sex,companyname,contactlastname,contactfirstname,email)
VALUES
(1,'Bernardo','Loesberg','0600000000','M','Hogeschool van Arnhem en Nijmegen','Bram','Geurts','bram.geurts@outlook.com'),
(2,'Tom','Kooiman','0600000000','M','Hogeschool van Arnhem en Nijmegen','Bram','Geurts','bram.geurts@outlook.com'),
(3,'Christaan','ten Voorde','0600000000','M','Hogeschool van Arnhem en Nijmegen','Bram','Geurts','bram.geurts@outlook.com'),
(4,'Ruben','van der Horst','0600000000','M','Hogeschool van Arnhem en Nijmegen','Bram','Geurts','bram.geurts@outlook.com'),
(5,'Bram','Geurts','0600000000','M','Hogeschool van Arnhem en Nijmegen','Bram','Geurts','bram.geurts@outlook.com')

INSERT INTO district
(districtnumber,districtname)
VALUES
(1,'Arnhem'),
(2,'Nijmegen'),
(3,'Velp'),
(4,'Rheden'),
(5,'Dieren')

INSERT INTO address
(addressnumber,districtnumber,street,zipcode,housenumber,city,housenumberaddon)
VALUES
(1,1,'Twikkelstraat','6825BV', 20, 'Arnhem',''),
(2,2,'Tapirstraat','6532AL', 20, 'Nijmegen',''),
(3,3,'Troelstrastraat','6882HD', 2, 'Velp',''),
(4,4,'Groenestraat','6991', 10, 'Rheden',''),
(5,5,'Zilverakkerweg','6952DX', 66, 'Dieren',''),
(6,1,'Ruitenberglaan', '6826CC', 31, 'Arnhem', '')

INSERT INTO addressforcustomer
(customernumber,addressnumber)
VALUES
(1,1),
(2,2),
(3,3),
(4,5),
(5,4)

INSERT INTO consignment
(consignmentnumber,customernumber,deliveraddressnumber,pickupaddressnumber,consignorname)
VALUES
(1,3,1,5,'Christaan ten Voorde'),
(2,2,2,3,'Tom Kooiman'),
(3,1,3,4,'Bernardo Loesberg'),
(4,5,4,2,'Bram Geurts'),
(5,3,5,1,'Ruben van der Horst')

INSERT INTO employee
(employeenumber,addressnumber,employeelastname,employeefirstname,bsn,cellphone,birthday,sex)
VALUES
(1,6,'Ruby','Stalenburg','0000000000','0600000000','1970-01-01','V'),
(2,6,'James','Boris','0000000000','0600000000','1970-01-01','M')

INSERT INTO Parcel
(consignmentnumber,parcelnumber,pickupemployeenumber,deliveremployeenumber,tracking,weightingrams,pickuptime,deliverytime)
VALUES
(1,1,2,2,'q244rfxzf',10,null,null),
(2,2,1,1,'q244rfxzf',10,1,1)