/*
 * Author: Bernardo Loesberg
 */
  DROP procedure IF exists sp_changeParcel;

  DELIMITER //
  CREATE PROCEDURE sp_changeParcel
    (IN p_parcelnumber          INT,
     IN p_consignmentnumber     INT,
     IN p_pickupemployeenumber  INT,
     IN p_deliveremployeenumber INT,
     IN p_street                VARCHAR(40),
     IN p_zipcode               VARCHAR(6),
     IN p_housenumber           INT,
     IN p_city                  VARCHAR(40),
     IN p_housenumberaddon      CHAR(1),
     IN p_weightingrams         INT,
     IN p_pickup                DATETIME,
     IN p_deliver               DATETIME,
     IN p_hqarrival             DATETIME,
     IN p_hqdeparmenture        DATETIME,
     IN p_comment               TEXT,
     IN p_price                 FLOAT,
     IN p_express               BOOLEAN)
    BEGIN
      DECLARE EXIT HANDLER FOR SQLEXCEPTION
      BEGIN
        RESIGNAL SQLSTATE '45000';
        ROLLBACK;
      END;
      START TRANSACTION;
        IF NOT EXISTS(SELECT 1 FROM parcel WHERE parcelnumber = p_parcelnumber)
        THEN
          RESIGNAL SQLSTATE '45012'
          SET MESSAGE_TEXT = 'Er bestaat geen pakket met de opgegeven nummer';
          ROLLBACK;
        END IF;

        /*Check if there is a pickup addres*/
        IF NOT EXISTS(SELECT 1 FROM address WHERE street = p_street AND zipcode = p_zipcode AND housenumber = p_housenumber AND city = p_city AND housenumberaddon = p_housenumberaddon)
        THEN
          CALL sp_createAddress
          (1, p_street, p_zipcode, p_housenumber, p_city, p_housenumberaddon);
        END IF;

        /*This is needed because cant update foreign keys*/
        SET FOREIGN_KEY_CHECKS=0;

        UPDATE parcel
        SET consignmentnumber = p_consignmentnumber,
            pickupemployeenumber = p_pickupemployeenumber,
            deliveremployeenumber = p_deliveremployeenumber,
            addressnumber = (SELECT addressnumber FROM address WHERE street = p_street AND zipcode = p_zipcode AND housenumber = p_housenumber AND city = p_city AND housenumberaddon = p_housenumberaddon),
            weightingrams = p_weightingrams,
            pickup = p_pickup,
            delivery = p_deliver,
            hqarrival = p_hqarrival,
            hqdeparture = p_hqdeparmenture,
            `comment` = p_comment,
            price = p_price,
            express = p_express
        WHERE parcelnumber = p_parcelnumber;

        /*This is needed because cant update foreign keys*/
        SET FOREIGN_KEY_CHECKS=1;
      COMMIT;
    END //
  DELIMITER ;

CALL sp_changeParcel
(1,6,2,2,'Twikkel straat', '6825BV', 1, 'Arnhem', '',1000,'2015-05-26 12:34:02','2015-05-26 12:34:02','2015-05-26 12:34:02','2015-05-26 12:34:02','test')