/*
 *@Author: Bernardo Loesberg
 */
use `database`;

DROP trigger IF exists trg_template;

DELIMITER $$
CREATE TRIGGER trg_template {BEFORE|AFTER} {INSERT|UPDATE|DELETE}
ON {table}
FOR EACH ROW
BEGIN

END
DELIMITER ;