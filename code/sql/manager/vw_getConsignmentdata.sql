/*
 *@Author: Christiaan ten Voorde
 */
use `abcbiker`;

DROP VIEW vw_getConsignmentdata

CREATE VIEW vw_getConsignmentdata
AS
SELECT AS date(scheduledpickup), count(*) AS Aantal
FROM consignment
WHERE scheduledpickup IS NOT NULL
GROUP BY date(scheduledpickup)

