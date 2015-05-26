/*
 * Author: Bernardo Loesberg
 */
DROP procedure IF exists sp_changeParcel;

DELIMITER //
CREATE PROCEDURE sp_changeParcel
  (IN p_parcelNumber     INT)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;

    COMMIT;
  END //
DELIMITER ;

CALL sp_ChangeConsignment
(2,1,'Eeshofstraat', '6825BV', 2, 'Arnhem', '','Zilverakkerweg', '6952DX', 59, 'Arnhem','', 1, 'Tom Kooiman')
