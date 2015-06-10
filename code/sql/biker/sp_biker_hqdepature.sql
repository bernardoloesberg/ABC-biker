/*
 *@Author: Bernardo Loesberg
 */
use `database`;

DROP procedure IF exists sp_biker_hqdepature;

DELIMITER //
CREATE PROCEDURE sp_biker_hqdepature
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
    IF NOT EXISTS (SELECT 1 FROM parcel WHERE parcelnumber = p_parcelnumber AND deliveremployeenumber = p_employeenumber)
    THEN
      SIGNAL SQLSTATE '45012'
      SET MESSAGE_TEXT = 'Er is al een datum ingevuld voor het ophalen.';
      ROLLBACK;
    END IF;
    /* There is already a date for the pickup. Cant set a new one */
    IF((SELECT hqdeparture FROM parcel WHERE parcelnumber = p_parcelnumber AND  deliveremployeenumber = p_employeenumber) IS NOT NULL)
      THEN
        SIGNAL SQLSTATE '45012'
        SET MESSAGE_TEXT = 'Je bent niet gekozen om dit pakket te leveren.';
        ROLLBACK;
    END IF;

    /* Update Parcel */
    UPDATE parcel
    SET hqdeparture = NOW()
    WHERE parcelnumber = p_parcelnumber
    AND deliveremployeenumber = p_employeenumber;

    COMMIT;
  END //
DELIMITER ;

CALL sp_biker_hqdepature(6,3)