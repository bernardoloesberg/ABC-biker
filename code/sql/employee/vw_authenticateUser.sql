/*
 *@Author: Bernardo Loesberg
 */
use `abcbiker`;

DROP VIEW vw_authenticateUser

CREATE VIEW vw_authenticateUser
AS
SELECT *
FROM Employee e
INNER JOIN RolesPerEmployee rpe
ON rpe.employeenumber = e.employeenumber
INNER JOIN Role r
ON r.employeenumber = rpe.employeenumber

