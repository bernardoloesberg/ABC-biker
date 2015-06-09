/*
 *@Author: Bernardo Loesberg
 */
use `abcbiker`;

DROP VIEW vw_authenticateUser;

CREATE VIEW vw_authenticateUser
AS
SELECT e.employeenumber, e.addressnumber, e.employeelastname, e.employeefirstname, e.bsn, e.cellphone, e.birthday, e.sex,e.email, e.password, rpe.rolename
FROM Employee e
INNER JOIN RolesPerEmployee rpe
ON rpe.employeenumber = e.employeenumber;
