/*
 *@Author: Bernardo Loesberg
 */
use `abcbiker`;

DROP VIEW vw_getParcelList;

CREATE VIEW vw_getParcelList
AS
SELECT p.parcelnumber,p.consignmentnumber,p.pickupemployeenumber,e1.employeefirstname AS pickupemployeefirstname,e1.employeelastname AS pickupemployeelastname,p.deliveremployeenumber,e2.employeefirstname AS deliveremployeefirstname,e2.employeelastname AS deliveremployeelastname,a.addressnumber,a.districtnumber,a.street,a.zipcode,a.housenumber,a.housenumberaddon,a.city,p.weightingrams,p.pickup,p.delivery,p.hqarrival,p.hqdeparture,p.comment,p.price,p.express FROM parcel p
INNER JOIN address a ON a.addressnumber = p.addressnumber
INNER JOIN employee e1 ON e1.employeenumber = p.pickupemployeenumber
INNER JOIN employee e2 ON e2.employeenumber = p.deliveremployeenumber