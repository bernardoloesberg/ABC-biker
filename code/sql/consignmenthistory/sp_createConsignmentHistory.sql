DROP procedure IF exists sp_createConsignmentHistory;

DELIMITER //
CREATE PROCEDURE sp_createConsignmentHistory
  (IN p_consignmentnumber       INT,
    IN p_employeenumber        VARCHAR(40),
    IN p_comment       VARCHAR(6))
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
    /*Check if the customer exists*/
    IF NOT EXISTS(SELECT 1 FROM consignment WHERE consignmentnumber = p_consignmentnumber)
    THEN
      RESIGNAL SQLSTATE '45012'
      SET MESSAGE_TEXT = 'Er bestaat geen zending';
      ROLLBACK;
    END IF;

    /*Check if the employee exists*/
    IF NOT EXISTS(SELECT 1 FROM employee WHERE employeenumber = p_employeenumber)
    THEN
      RESIGNAL SQLSTATE '45012'
      SET MESSAGE_TEXT = 'Er bestaat geen werknemmer.';
      ROLLBACK;
    END IF;

    /*Insert a new row to history to see what has been changed*/
    INSERT INTO consignmenthistory
    (consignmentnumber,employeenumber,`comment`)
    VALUES
    (p_consignmentnumber,p_consignmentnumber,p_comment);

    COMMIT;
  END //
DELIMITER ;