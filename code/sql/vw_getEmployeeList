/*
 *@Author: Christiaan ten Voorde
 */
use `abcbiker`;

DROP VIEW vw_getEmployeeList

CREATE VIEW vw_getEmployeeList
AS
SELECT em.employeenumber, em.addressnumber, em.employeelastname, em.employeefirstname, em.bsn, em.cellphone, em.birthday, em.sex, ad.districtnumber, ad.street, ad.zipcode, ad.housenumber, ad.city, ad.housenumberaddon
FROM employee em
INNER JOIN address ad
ON em.addressnumber = ad.addressnumber

