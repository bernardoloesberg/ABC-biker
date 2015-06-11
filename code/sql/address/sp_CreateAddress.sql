/*
 *@Author: Bernardo Loesberg, Tom Kooiman
 */

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
      IF EXISTS(SELECT 1 FROM address WHERE street = p_street AND zipcode = p_zipcode AND housenumber = p_housenumber AND city = p_city AND housenumberaddon = p_housenumberaddon)
        THEN
          SIGNAL SQLSTATE '45009'
            SET MESSAGE_TEXT = 'Adres staat al in de database';
          ROLLBACK;
      ELSEIF (p_street NOT REGEXP '[a-zA-Z ]')
        THEN
        SIGNAL SQLSTATE '45008'
          SET MESSAGE_TEXT = 'De straat mag alleen letters bevatten!';
        ROLLBACK ;
      ELSEIF (p_zipcode NOT REGEXP '^[1-9][0-9]{3}\s?[a-zA-Z]{2}$')
        THEN
        SIGNAL SQLSTATE '45010'
          SET MESSAGE_TEXT = 'Geen geldig postcode!';
        ROLLBACK ;
      ELSEIF (p_housenumber NOT REGEXP '[0-9]')
        THEN
        SIGNAL SQLSTATE '45011'
          SET MESSAGE_TEXT = 'Huisnummer mag alleen uit cijfers bestaan! Een toevoeging voor het huisnummer mag in het toevoegingsveld!';
        ROLLBACK ;
        ELSEIF (p_city NOT REGEXP '[a-zA-Z ]')
          THEN
        SIGNAL SQLSTATE '45012'
            SET MESSAGE_TEXT = 'De woonplaats mag alleen letters bevatten!';
        ROLLBACK ;
      ELSE
          INSERT INTO address
          (districtnumber, street, zipcode, housenumber, city, housenumberaddon)
          VALUES
          (p_districtnumber, p_street, p_zipcode, p_housenumber, p_city, p_housenumberaddon);

          /*SET p_addressnumber = LAST_INSERT_ID();*/
        COMMIT;
    END IF;
  END //
DELIMITER ;
