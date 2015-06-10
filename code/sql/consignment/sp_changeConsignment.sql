/*
 * Author: Bernardo Loesberg
 */
DROP procedure IF exists sp_ChangeConsignment;

DELIMITER //
CREATE PROCEDURE sp_ChangeConsignment
  (IN p_consignmentnumber     INT,
    IN p_customernumber       INT,
    IN p_deliverstreet       VARCHAR(40),
    IN p_deliverzipcode      VARCHAR(6),
    IN p_deliverhousenumber  INT,
    IN p_delivercity         VARCHAR(40),
    IN p_deliverhousenumberaddon char(1),
    IN p_pickupstreet        VARCHAR(40),
    IN p_pickupzipcode       VARCHAR(6),
    IN p_pickuphousenumber   INT,
    IN p_pickupcity          VARCHAR(40),
    IN p_pickuphousenumberaddon char(1),
    IN p_districtnumber      INT,
    IN p_consignorname       VARCHAR(40))
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
      /* There is not customer */
      IF NOT EXISTS(SELECT 1 FROM customer WHERE customernumber = p_customernumber)
      THEN
        RESIGNAL SQLSTATE '45012'
        SET MESSAGE_TEXT = 'Er bestaat geen klant met de opgegeven nummer';
        ROLLBACK;
      END IF;

      /* The is already a adres */
      IF EXISTS(SELECT 1 FROM address WHERE street = p_street AND zipcode = p_zipcode AND housenumber = p_housenumber AND city = p_city AND housenumberaddon = p_housenumberaddon)
      THEN
        SIGNAL SQLSTATE '45009'
        SET MESSAGE_TEXT = 'Adres staat al in de database';
        ROLLBACK;
      END IF;

      /* Check if the deliveradres is in address */
      IF EXISTS(SELECT 1 FROM address WHERE street = p_deliverstreet AND zipcode = p_deliverzipcode AND housenumber = p_deliverhousenumber AND city = p_delivercity AND housenumberaddon = p_deliverhousenumberaddon)
      THEN
        CALL sp_CreateAddress
        (p_districtnumber ,p_deliverstreet,p_deliverzipcode,p_deliverhousenumber,p_delivercity,p_deliverhousenumberaddon);
      END IF;

      /* The zipcode isnt valid */
      IF (p_zipcode NOT REGEXP '^[1-9][0-9]{3}\s?[a-zA-Z]{2}$')
      THEN
        SIGNAL SQLSTATE '45010'
        SET MESSAGE_TEXT = 'Geen geldig postcode!';
      END IF;

      /* Check if the pickup is in address */
      IF EXISTS(SELECT 1 FROM address WHERE street = p_pickupstreet AND zipcode = p_pickupzipcode AND housenumber = p_pickuphousenumber AND city = p_pickupcity AND housenumberaddon = p_pickuphousenumberaddon)
      THEN
        CALL sp_CreateAddress
        (p_districtnumber ,p_pickupstreet,p_pickupzipcode,p_pickuphousenumber,p_pickupcity,p_pickuphousenumberaddon);
      END IF;

      /* Update consignment */
      SET FOREIGN_KEY_CHECKS=0;
       UPDATE consignment
         SET customernumber = p_customernumber,
             deliveraddressnumber = (SELECT addressnumber FROM address WHERE customernumber = p_customernumber AND street = p_deliverstreet AND zipcode = p_deliverzipcode AND housenumber = p_deliverhousenumber AND city = p_delivercity AND housenumberaddon = p_deliverhousenumberaddon),
             pickupaddressnumber = (SELECT addressnumber FROM address WHERE customernumber = p_customernumber AND street = p_pickupstreet AND zipcode = p_pickupzipcode AND housenumber = p_pickuphousenumber AND city = p_pickupcity AND housenumberaddon = p_pickuphousenumberaddon),
             consignorname = p_consignorname
         WHERE consignmentnumber = p_consignmentnumber;
      SET FOREIGN_KEY_CHECKS=1;
    COMMIT;
  END //
DELIMITER ;

CALL sp_ChangeConsignment
(2,1,'Eeshofstraat', '6825BV', 2, 'Arnhem', '','Zilverakkerweg', '6952DX', 59, 'Arnhem','', 1, 'Tom Kooiman')
