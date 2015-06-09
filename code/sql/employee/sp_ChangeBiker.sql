/*
 *@Author: Christiaan ten Voorde
 */
use `abcbiker`;

DROP procedure IF exists sp_ChangeBiker;

DELIMITER //
CREATE PROCEDURE sp_ChangeBiker(
  IN p_employeenumber int,
  IN p_express bit,
  IN p_maxdeliveries int
)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    IF((Select employeenumber FROM Biker WHERE employeenumber = p_employeenumber) IS NULL) THEN
      INSERT INTO biker(employeenumber, express, maxdeliveries)
      VALUES (p_employeenumber, p_express, p_maxdeliveries);
    ELSE
    UPDATE Biker SET express = p_express, maxdeliveries = p_maxdeliveries WHERE employeenumber = p_employeenumber;
    END IF;
  END //
DELIMITER ;