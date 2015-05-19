/*
 *@Author: Bernardo Loesberg
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
        SET MESSAGE_TEXT = 'Bericht';
      ROLLBACK;
    END;
    START TRANSACTION;

    COMMIT;
  END //
DELIMITER ;
