/*
 *@Author: Bernardo Loesberg
 */
use `database`;

DROP procedure IF exists sp_CreateAddress;

DELIMITER //
CREATE PROCEDURE sp_CreateAddress
  (IN p_districtnumber INT,
    IN p_street       VARCHAR(40),
    IN p_zipcode      VARCHAR(6),
    IN p_housenumber  INT,
    IN p_city         VARCHAR(40),
    IN p_housenumberaddon char(1)
    /*OUT p_addressnumber      INT*/)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
      IF NOT EXISTS(SELECT 1 FROM address WHERE street = p_street AND zipcode = p_zipcode AND housenumber = p_housenumber AND city = p_city AND housenumberaddon = p_housenumberaddon)
        THEN
          INSERT INTO address
          (districtnumber, street, zipcode, housenumber, city, housenumberaddon)
          VALUES
          (p_districtnumber, p_street, p_zipcode, p_housenumber, p_city, p_housenumberaddon);

          /*SET p_addressnumber = LAST_INSERT_ID();*/
      END IF;
      COMMIT;
  END //
DELIMITER ;

CALL sp_CreateAddress
(1,'Eeshofstraat','2','6825BV','Arnhem','');
