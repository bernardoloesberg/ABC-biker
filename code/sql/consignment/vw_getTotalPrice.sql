/*
 *@Author: Bernardo Loesberg
 */
use `abcbiker`;

DROP VIEW vw_getTotalPrice;

CREATE VIEW vw_getTotalPrice
AS
SELECT sum(price) AS price, consignmentnumber FROM parcel