/*
 *@Author: Bernardo Loesberg
 */
use `abcbiker`;

DROP VIEW vw_getConsignmentList

CREATE VIEW vw_getConsignmentList
AS
SELECT co.consignmentnumber, cu.customernumber, cu.customerfirstname, cu.customerlastname, deliver.street AS deliverstreet,deliver.housenumber AS deliverhousenumber, deliver.zipcode AS deliverzipcode, deliver.city AS delivercity, pickup.street AS pickupstreet, pickup.housenumber AS pickuphousenumber, pickup.zipcode AS pickupzipcode, pickup.city AS pickupcity consignorname FROM consignment co
INNER JOIN customer cu ON co.customernumber = cu.customernumber
INNER JOIN address deliver ON co.deliveraddressnumber = deliver.addressnumber
INNER JOIN address pickup ON co.pickupaddressnumber = pickup.addressnumber