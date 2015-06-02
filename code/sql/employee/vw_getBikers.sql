/*
 *@Author: Christiaan ten Voorde
 */
use `abcbiker`;

DROP VIEW vw_getBikers

CREATE VIEW vw_getBikers
AS
SELECT *
FROM RolesPerEmployee
WHERE rolename = 'Biker'

