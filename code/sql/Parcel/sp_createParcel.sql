/*
 * Author: Bernardo Loesberg
 */
DROP procedure IF exists sp_createParcel;

DELIMITER //
CREATE PROCEDURE sp_createParcel
  (IN p_consignmentnumber     INT,
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
   IN p_comment               TEXT)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;

    CALL sp_CreateAddress
    (1,p_street,p_housenumber,p_zipcode,p_city,p_housenumberaddon);

    INSERT INTO parcel
    (consignmentnumber,pickupemployeenumber,deliveremployeenumber,addressnumber,weightingrams,pickup,delivery,hqarrival,hqdeparture,`comment`)
    VALUES
    (p_consignmentnumber,p_pickupemployeenumber,p_deliveremployeenumber,(SELECT addressnumber FROM address WHERE street = p_street AND zipcode = p_zipcode AND housenumber = p_housenumber AND city = p_city AND housenumberaddon = p_housenumberaddon), p_weightingrams,p_pickup,p_deliver,p_hqarrival,p_hqdeparmenture,p_comment);

    COMMIT;
  END //
DELIMITER ;

CALL sp_createParcel
(6,2,2,'Twikkel straat', '6825BV', 1, 'Arnhem', '',1000,'2015-05-26 12:34:02','2015-05-26 12:34:02','2015-05-26 12:34:02','2015-05-26 12:34:02','test')