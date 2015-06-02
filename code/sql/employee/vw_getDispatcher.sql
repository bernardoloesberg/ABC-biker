/*
 *@Author: Christiaan ten Voorde
 */
use `abcbiker`;

DROP VIEW vw_getDispatcher

CREATE VIEW vw_getDispatcher
AS
SELECT *
FROM RolesPerEmployee
WHERE rolename = 'Dispatcher'

