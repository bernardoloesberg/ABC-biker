CREATE PROCEDURE sp_changeCustomer(IN customer INT, IN lastname VARCHAR(40),IN firstname VARCHAR(40),IN phone DECIMAL(14,0),IN sexin CHAR(1),IN company VARCHAR(40),IN emailaddress VARCHAR(50))
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
    UPDATE customer
      SET customerlastname = lastname, customerlastname = lastname, phonenumber = phone, sex = sexin, companyname = company, email = emailaddress
      WHERE customernumber = customer;
      COMMIT;
  END