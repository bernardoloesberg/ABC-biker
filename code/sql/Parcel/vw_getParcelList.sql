/*
 *@Author: Bernardo Loesberg
 */
use `abcbiker`;

DROP VIEW vw_getParcelList;

CREATE VIEW vw_getParcelList
AS
SELECT p.parcelnumber,p.consignmentnumber,p.pickupemployeenumber,p.deliveremployeenumber,a.addressnumber,a.districtnumber,a.street,a.zipcode,a.housenumber,a.housenumberaddon,a.city,p.weightingrams,p.pickup,p.delivery,p.hqarrival,p.hqdeparture,p.comment FROM parcel p
INNER JOIN address a ON a.addressnumber = p.addressnumber;