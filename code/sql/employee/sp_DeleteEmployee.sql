/*
 *@Author: Christiaan ten Voorde
 */
use `abcbiker`;

DROP procedure IF exists sp_DeleteEmployee;

DELIMITER //
CREATE PROCEDURE sp_DeleteEmployee(
  IN p_employeenumber int
)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
      IF NOT EXISTS(SELECT 1 FROM employee WHERE employeenumber = p_employeenumber)
      THEN
        RESIGNAL SQLSTATE '45000';
        ROLLBACK;
      ELSE
        DELETE FROM employee WHERE employeenumber = p_employeenumber;
      END IF;
    COMMIT;
  END //
DELIMITER ;