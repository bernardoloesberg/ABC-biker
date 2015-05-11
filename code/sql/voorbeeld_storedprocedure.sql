/*
 *@Author: Bernardo Loesbergsd
 */
use `database`;

DROP procedure IF exists prc_template;

DELIMITER //
CREATE PROCEDURE prc_template
  ()
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;

    COMMIT;
  END //
DELIMITER ;
//y//o;
