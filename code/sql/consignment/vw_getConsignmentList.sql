/*
 *@Author: Bernardo Loesberg
 */
use `abcbiker`;

DROP VIEW IF EXISTS vw_getConsignmentList;

CREATE VIEW vw_getConsignmentList
AS
SELECT co.consignmentnumber, cu.customernumber, cu.customerfirstname, cu.customerlastname, pickup.street AS pickupstreet, pickup.housenumber AS pickuphousenumber, pickup.zipcode AS pickupzipcode, pickup.city AS pickupcity, co.consignorname, co.completed, co.scheduledpickup, co.scheduleddelivery, co.price, co.totalprice FROM consignment co
INNER JOIN customer cu ON co.customernumber = cu.customernumber
INNER JOIN address pickup ON co.addressnumber = pickup.addressnumber
ORDER BY co.consignmentnumber DESC;