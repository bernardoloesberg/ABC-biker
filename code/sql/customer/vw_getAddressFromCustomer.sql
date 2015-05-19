/*
 *@Author: Bernardo Loesberg
 */
use abcbiker;

DROP VIEW vw_getAddressFromCustomer;

CREATE VIEW vw_getAddressFromCustomer
AS
  SELECT A.*
  FROM AddressForCustomer AFC INNER JOIN Address A ON AFC.addressnumber = A.addressnumber