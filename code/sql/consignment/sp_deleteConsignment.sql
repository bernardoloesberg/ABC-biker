f/*
 *@Author: Bernardo Loesberg
 */
use `abcbiker`;

DROP procedure IF exists sp_deleteConsignment;

DELIMITER //
CREATE PROCEDURE sp_deleteConsignment
  (IN p_consignmentnumber       INT)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
    /*Check if the consignment exists*/
    IF NOT EXISTS(SELECT 1 FROM consignment WHERE consignmentnumber = p_consignmentnumber)
    THEN
      SIGNAL SQLSTATE '45018'
      SET MESSAGE_TEXT = 'Er geen consignments gevonden';
      ROLLBACK;
    END IF;

    /*Check if the consignment has parcels*/
    IF EXISTS(SELECT 1 FROM parcel WHERE consignmentnumber = p_consignmentnumber)
    THEN
      SIGNAL SQLSTATE '45015'
      SET MESSAGE_TEXT = 'Er geen consignments gevonden';
      ROLLBACK;
    END IF;

    /*Delete consignment*/
    DELETE FROM consignment WHERE consignmentnumber = p_consignmentnumber;

    COMMIT;
  END //
DELIMITER ;

CALL sp_DeleteConsignment
(1);
