/*
 *@Author: Bernardo Loesberg
 */
use `database`;

DROP procedure IF exists sp_DeleteConsignment;

DELIMITER //
CREATE PROCEDURE sp_DeleteConsignment
  (IN p_consignmentnumber       INT)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
      IF EXISTS()
      THEN
      END IF;
      IF NOT EXISTS(SELECT 1 FROM consignment WHERE consignmentnumber = p_consignmentnumber)
      THEN
        RESIGNAL SQLSTATE '45010'
        SET MESSAGE_TEXT = 'Er geen consignments gevonden';
        ROLLBACK;
      ELSE
        DELETE FROM parcel WHERE consignmentnumber = p_consignmentnumber;
        DELETE FROM consignment WHERE consignmentnumber = p_consignmentnumber;
      END IF;
    COMMIT;
  END //
DELIMITER ;

CALL sp_DeleteConsignment
(1);
