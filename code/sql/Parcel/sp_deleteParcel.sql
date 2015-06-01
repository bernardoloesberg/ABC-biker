/*
 *@Author: Bernardo Loesberg
 */
use `abcbiker`;

DROP procedure IF exists sp_deleteParcel;

DELIMITER //
CREATE PROCEDURE sp_deleteParcel
  (IN p_parcelnumber       INT)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
    /*Check if the consignment has parcels*/
    IF NOT EXISTS(SELECT 1 FROM parcel WHERE parcelnumber = p_parcelnumber)
    THEN
      RESIGNAL SQLSTATE '45015'
      SET MESSAGE_TEXT = 'Er geen consignments gevonden';
      ROLLBACK;
    END IF;

    /*Delete Parcel*/
    DELETE FROM parcel WHERE parcelnumber = p_parcelnumber;

    COMMIT;
  END //
DELIMITER ;

CALL sp_deleteParcel
(1);
