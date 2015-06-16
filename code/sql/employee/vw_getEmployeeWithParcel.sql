/*
 *@Author: Christiaan ten Voorde
 */
use `abcbiker`;

DROP VIEW vw_getEmployeeWithParcel;

CREATE VIEW vw_getEmployeeWithParcel
AS
  Select employeenumber
  FROM Employee E
  WHERE EXISTS (SELECT * FROM Parcel WHERE E.employeenumber = pickupemployeenumber  OR E.employeenumber = deliveremployeenumber)
