/*
 * Author: Bernardo Loesberg, Tom Kooiman
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
   IN p_comment               TEXT,
   IN p_price                 FLOAT,
   IN p_express               BOOLEAN)
  BEGIN
    DECLARE fullcomment TEXT;
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;

    IF (p_weightingrams NOT REGEXP '[0-9]')
      THEN
        SIGNAL SQLSTATE '45014'
          SET MESSAGE_TEXT = 'Gewicht mag alleen uit getallen bestaan!';
        ROLLBACK ;
    ELSE
    /*Check if there is a pickup addres*/
    IF NOT EXISTS(SELECT 1 FROM address WHERE street = p_street AND zipcode = p_zipcode AND housenumber = p_housenumber AND city = p_city AND housenumberaddon = p_housenumberaddon)
    THEN
      CALL sp_createAddress
      (1, p_street, p_zipcode, p_housenumber, p_city, p_housenumberaddon);
    END IF;
      IF (p_weightingrams >= 25000)
        THEN
          SET fullcomment = 'Bus ' + p_comment;
        END IF;

    INSERT INTO parcel
    (consignmentnumber,pickupemployeenumber,deliveremployeenumber,addressnumber,weightingrams,pickup,delivery,hqarrival,hqdeparture,`comment`,price,express)
    VALUES
    (p_consignmentnumber,p_pickupemployeenumber,p_deliveremployeenumber,(SELECT addressnumber FROM address WHERE street = p_street AND zipcode = p_zipcode AND housenumber = p_housenumber AND city = p_city AND housenumberaddon = p_housenumberaddon), p_weightingrams,p_pickup,p_deliver,p_hqarrival,p_hqdeparmenture,fullcomment,p_price,p_express);

    COMMIT;
    END IF;
  END //
DELIMITER ;

CALL sp_createParcel
(6,2,2,'Twikkel straat', '6825BV', 1, 'Arnhem', '',1000,'2015-05-26 12:34:02','2015-05-26 12:34:02','2015-05-26 12:34:02','2015-05-26 12:34:02','test',10,1)