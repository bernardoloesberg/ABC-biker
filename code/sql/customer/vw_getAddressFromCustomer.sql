/*
 *@Author: Bernardo Loesberg
 */
use abcbiker;

DROP VIEW vw_getAddressFromCustomer;

CREATE VIEW vw_getAddressFromCustomer
AS
SELECT d.districtname ,af.customernumber, a.addressnumber, af.addressnumber AS addressnumberforcustomer, a.street, a.housenumber, a.zipcode, a.city, a.housenumberaddon
FROM addressforcustomer af INNER JOIN address a ON a.addressnumber = af.addressnumber
                           INNER JOIN district d ON a.districtnumber = d.districtnumber