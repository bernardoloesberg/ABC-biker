/*
 *@Author: Bernardo Loesberg
 */
use `abcbiker`;

DROP VIEW vw_getParcelList

CREATE VIEW vw_getParcelList
AS
SELECT parcelnumber,consignmentnumber,pickupemployeenumber,deliveremployeenumber,tracking,weightingrams,pickuptime,delivertime FROM parcel