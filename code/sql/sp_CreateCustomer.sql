/*
 *@Author: Bernardo Loesberg
 */
use `database`;

DROP procedure IF exists ps_CreateCustomer;

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
