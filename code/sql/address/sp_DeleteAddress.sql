/*
 *@Author: Christiaan ten Voorde
 */
use `abcbiker`;

DROP procedure IF exists sp_DeleteAddress;

DELIMITER //
CREATE PROCEDURE sp_DeleteAddress(
  IN p_addressnumber int
)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
      IF NOT EXISTS(SELECT 1 FROM address WHERE addressnumber = p_addressnumber)
      THEN
        RESIGNAL SQLSTATE '45000';
        ROLLBACK;
      ELSE
        DELETE FROM address WHERE addressnumber = p_addressnumber;
      END IF;
    COMMIT;
  END //
DELIMITER ;