/*
 *@Author: Christiaan ten Voorde
 */
use abcbiker;

DROP VIEW IF EXISTS vw_Districts;

CREATE VIEW vw_Districts
AS
SELECT * FROM District;