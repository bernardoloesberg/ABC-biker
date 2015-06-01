/*
 *@Author: Tom Kooiman
 */
use abcbiker;

DROP VIEW vw_CustomerList;

CREATE VIEW vw_CustomerContactList
AS
SELECT * FROM CustomerContact;