/*
 *@Author: Tom Kooiman
 */
use abcbiker;

DROP view IF exists vw_AddressList;

CREATE VIEW vw_AddressList
AS
SELECT * FROM Address;