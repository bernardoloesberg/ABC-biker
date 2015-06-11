/*
 *@Author: Bernardo Loesberg
 */

DROP procedure IF exists sp_changeConsignment;

DELIMITER //
CREATE PROCEDURE sp_changeConsignment
  (IN p_consignmentnumber    INT,
    IN p_customernumber      INT,
    IN p_pickupstreet        VARCHAR(40),
    IN p_pickupzipcode       VARCHAR(6),
    IN p_pickuphousenumber   INT,
    IN p_pickupcity          VARCHAR(40),
    IN p_pickuphousenumberaddon char(1),
    IN p_consignorname       VARCHAR(40),
    IN p_completed           BOOLEAN,
    IN p_scheduledpickup     DATETIME,
    IN p_scheduleddelivery   DATETIME,
    IN p_price               FLOAT(6,2),
    IN p_totalprice          FLOAT(6,2),
    IN p_employeenumber      INT,
    IN p_comment             TEXT
  )
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;

    /*Check if the employee exists*/
    IF NOT EXISTS(SELECT 1 FROM employee WHERE employeenumber = p_employeenumber)
    THEN
      RESIGNAL SQLSTATE '45012'
      SET MESSAGE_TEXT = 'Er bestaat geen employee met de opgegeven nummer';
      ROLLBACK;
    END IF;
    /*Check if the customer exists*/
    IF NOT EXISTS(SELECT 1 FROM customer WHERE customernumber = p_customernumber)
    THEN
      RESIGNAL SQLSTATE '45013'
      SET MESSAGE_TEXT = 'Er bestaat geen klant met de opgegeven nummer';
      ROLLBACK;
    END IF;

    /*Check if there is a pickup addres*/
    IF NOT EXISTS(SELECT 1 FROM address WHERE street = p_pickupstreet AND zipcode = p_pickupzipcode AND housenumber = p_pickuphousenumberaddon AND city = p_pickupcity AND housenumberaddon = p_pickuphousenumberaddon)
    THEN
      CALL sp_createAddress
      (1, p_pickupstreet, p_pickupzipcode, p_pickuphousenumberaddon, p_pickupcity, p_pickuphousenumberaddon);
    END IF;

    /*Insert a new row to history to see what has been changed*/
    INSERT INTO consignmenthistory
    (consignmentnumber,employeenumber,`comment`)
    VALUES
    (p_consignmentnumber,p_employeenumber,p_comment);

    /*This is needed because cant update foreign keys*/
    SET FOREIGN_KEY_CHECKS=0;

    /*Update the consignment*/
    UPDATE consignment
    SET customernumber = p_customernumber,
        addressnumber = (SELECT addressnumber FROM address WHERE street = p_pickupstreet AND zipcode = p_pickupzipcode AND housenumber = p_pickuphousenumberaddon AND city = p_pickupcity AND housenumberaddon = p_pickuphousenumberaddon),
        consignorname = p_consignorname,
        completed = p_completed,
        scheduledpickup = p_scheduledpickup,
        scheduleddelivery = p_scheduleddelivery,
        price = p_price,
        totalprice = p_totalprice
    WHERE consignmentnumber = p_consignmentnumber;

    /*Reactivate the foreign key checks*/
    SET FOREIGN_KEY_CHECKS=1;
  END //
DELIMITER ;