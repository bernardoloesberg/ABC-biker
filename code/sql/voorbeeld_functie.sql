/*
 *@Author: Bernardo Loesberg
 */
use `database`;

DROP function IF exists fn_template;

DELIMITER $$
CREATE FUNCTION fn_template()
	RETURNS {datatype}
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
		  RESIGNAL SQLSTATE '45000';
		  ROLLBACK;
    END;
	return;
END
DELIMITER ;
