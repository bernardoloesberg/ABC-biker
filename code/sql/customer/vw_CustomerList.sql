/*
 *@Author: Tom Kooiman
 */
use abcbiker;

DROP VIEW vw_CustomerList;

CREATE VIEW vw_CustomerList
AS
SELECT * FROM Customer;