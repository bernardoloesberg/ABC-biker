INSERT INTO customer
(customerlastname,customerfirstname,phonenumber,sex,companyname,contactlastname,contactfirstname,email)
VALUES
('Bernardo','Loesberg','0600000000','M','Hogeschool van Arnhem en Nijmegen','Bram','Geurts','bram.geurts@outlook.com'),
('Tom','Kooiman','0600000000','M','Hogeschool van Arnhem en Nijmegen','Bram','Geurts','bram.geurts@outlook.com'),
('Christaan','ten Voorde','0600000000','M','Hogeschool van Arnhem en Nijmegen','Bram','Geurts','bram.geurts@outlook.com'),
('Ruben','van der Horst','0600000000','M','Hogeschool van Arnhem en Nijmegen','Bram','Geurts','bram.geurts@outlook.com'),
('Bram','Geurts','0600000000','M','Hogeschool van Arnhem en Nijmegen','Bram','Geurts','bram.geurts@outlook.com')

INSERT INTO district
(districtname)
VALUES
('Arnhem'),
('Nijmegen'),
('Velp'),
('Rheden'),
('Dieren')

INSERT INTO address
(districtnumber,street,zipcode,housenumber,city,housenumberaddon)
VALUES
(1,'Twikkel straat','6825BV', 20, 'Arnhem',''),
(2,'Tapir straat','6532AL', 20, 'Nijmegen',''),
(3,'Troelstra straat','6882HD', 2, 'Velp',''),
(4,'Groene straat','6991', 10, 'Rheden',''),
(5,'Zilverakkerweg','6952DX', 66, 'Dieren',''),
(1,'Ruitenberglaan', '6826CC', 31, 'Arnhem', '')
(1,'Tak straat', '6826SGC', 1, 'Arnhem', '')
(1,'Blag laan', '6826AC', 22, 'Arnhem', '')
(1,'Poklo laan', '6826CH', 631, 'Arnhem', '')

INSERT INTO addressforcustomer
(customernumber,addressnumber)
VALUES
(1,1),
(2,2),
(3,3),
(4,5),
(5,4)

INSERT INTO consignment
(customernumber,deliveraddressnumber,pickupaddressnumber,consignorname)
VALUES
(3,1,5,'Christaan ten Voorde'),
(2,2,3,'Tom Kooiman'),
(1,3,4,'Bernardo Loesberg'),
(5,4,2,'Bram Geurts'),
(3,5,1,'Ruben van der Horst')

INSERT INTO employee
(addressnumber,employeelastname,employeefirstname,bsn,cellphone,birthday,sex)
VALUES
(6,'Ruby','Stalenburg','0000000000','0600000000','1970-01-01','V'),
(7,'James','Boris','0000000000','0600000000','1970-02-01','M')
(8,'Ronald','Reagan','0000000000','0600000000','1991-03-01','M'),
(9,'Max','Albarttus','0000000000','0600000000','1989-04-01','M')

INSERT INTO biker
(employeenumber, express, maxdeliveries)
VALUES
(1, 1, 20),
(2, 0, 10)

INSERT INTO workingDistrict
(districtnumber, employeenumber, weeknumber)
VALUES
(1, 3, 20),
(2, 4, 20)

INSERT INTO District
(districtnumber, districtname)
VALUES
(1, Arnhem Zuid),
(2, Arnhem Noord)

INSERT INTO Manager
(employeenumber)
VALUES
(3)

INSERT INTO Bus
(employeenumber)
VALUES
(1)

INSERT INTO Dispatcher
(employeenumber)
VALUES
(4)


INSERT INTO Parcel
(consignmentnumber,pickupemployeenumber,deliveremployeenumber,tracking,weightingrams,pickuptime,deliverytime)
VALUES
(1,2,2,'q244rfxzf',10,null,null),
(2,1,1,'q244rfxzf',10,1,1)