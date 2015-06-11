/*
 *@Author: Bernardo Loesberg
 */
use `database`;

DROP procedure IF exists sp_biker_hqarrival;

DELIMITER //
CREATE PROCEDURE sp_biker_hqarrival
  (IN p_parcelnumber         INT,
   IN p_employeenumber       INT)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
    /* The employee is not the one that can pickup the parcel */
    IF NOT EXISTS (SELECT 1 FROM parcel WHERE parcelnumber = p_parcelnumber AND pickupemployeenumber = p_employeenumber)
    THEN
      SIGNAL SQLSTATE '45012'
      SET MESSAGE_TEXT = 'Er is al een datum ingevuld voor het ophalen.';
      ROLLBACK;
    /* There is already a date for the pickup. Cant set a new one */
    ELSEIF((SELECT hqarrival FROM parcel WHERE parcelnumber = p_parcelnumber AND  pickupemployeenumber = p_employeenumber) IS NOT NULL)
      THEN
        SIGNAL SQLSTATE '45012'
        SET MESSAGE_TEXT = 'Je mag dit pakket niet ophalen!';
        ROLLBACK;
    ELSE
    /* Update Parcel */
    UPDATE parcel
    SET hqarrival = NOW()
    WHERE parcelnumber = p_parcelnumber
    AND pickupemployeenumber = p_employeenumber;

    COMMIT;
    END IF;
  END //
DELIMITER ;

CALL sp_biker_hqarrival(6,3)