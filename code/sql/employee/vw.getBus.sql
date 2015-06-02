/*
 *@Author: Christiaan ten Voorde
 */
use `abcbiker`;

DROP VIEW vw_getBus

CREATE VIEW vw_getBus
AS
SELECT *
FROM RolesPerEmployee
WHERE rolename = 'Bus'

