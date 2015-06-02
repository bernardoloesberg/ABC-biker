/*
 *@Author: Christiaan ten Voorde
 */
use `abcbiker`;

DROP VIEW vw_getEmployeeList

CREATE VIEW vw_getEmployeeList
AS
SELECT em.employeenumber, em.addressnumber, em.employeelastname, em.employeefirstname, em.bsn, em.cellphone, em.birthday, em.sex, ad.districtnumber, ad.street, ad.zipcode, ad.housenumber, ad.city, ad.housenumberaddon, vw_getBikers.rolename AS biker, vw_getBus.rolename AS bus, vw_getDispatcher.rolename AS dispatcher
FROM employee em
INNER JOIN address ad
ON em.addressnumber = ad.addressnumber
LEFT JOIN vw_getBikers
ON vw_getBikers.employeenumber = em.employeenumber
LEFT JOIN vw_getBus
ON vw_getBus.employeenumber = em.employeenumber
LEFT JOIN vw_getDispatcher
ON vw_getDispatcher.employeenumber = em.employeenumber
ORDER BY em.employeelastname ASC

