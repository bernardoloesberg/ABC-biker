/*
 *@Author: Christiaan ten Voorde
 */
use `abcbiker`;

DROP procedure IF exists sp_DeleteBiker;

DELIMITER //
CREATE PROCEDURE sp_DeleteBiker(
  IN p_employeenumber int
)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
      DELETE FROM biker WHERE employeenumber = p_employeenumber;
  END //
DELIMITER ;