/*
 *@Author: Bernardo Loesberg
 */
use abcbiker;

DROP VIEW vw_getAddressFromCustomer;

CREATE VIEW vw_getAddressFromCustomer
AS
SELECT * FROM addresforcustomer af
INNER JOIN address a ON a.addressnumber = af.addressnumber