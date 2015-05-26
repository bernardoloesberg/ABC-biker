/*
 *@Author: Bernardo Loesberg
 */
use `abcbiker`;

DROP VIEW vw_getConsignmentHistory;

CREATE VIEW vw_getConsignmentHistory
AS
SELECT ch.historynumber, ch.consignmentnumber, ch.employeenumber, ch.comment, em.employeefirstname, em.employeelastname, em.bsn, em.cellphone, em.birthday, em.sex, em.password FROM consignmenthistory ch
INNER JOIN consignment co ON co.consignmentnumber = ch.consignmentnumber
INNER JOIN employee em ON em.employeenumber = ch.employeenumber