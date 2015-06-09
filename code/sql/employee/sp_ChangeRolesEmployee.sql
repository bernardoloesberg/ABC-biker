/*
 *@Author: Christiaan ten Voorde
 */
use `abcbiker`;

DROP procedure IF exists sp_ChangeRolesEmployee;

DELIMITER //
CREATE PROCEDURE sp_ChangeRolesEmployee(
  IN p_employeenumber int,
  IN p_biker bit,
  IN p_bus bit,
  IN p_dispatcher bit
)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    IF(p_biker) THEN
      IF((Select employeenumber FROM rolesperemployee WHERE employeenumber = p_employeenumber AND rolename = 'biker') IS NULL) THEN
        INSERT INTO rolesperemployee(employeenumber, rolename)
        VALUES (p_employeenumber, 'biker');
      END IF;
    ELSEIF(!p_biker) THEN
      DELETE FROM rolesperemployee WHERE employeenumber = p_employeenumber AND rolename = 'biker';
    END IF;
    IF(p_bus) THEN
      IF((Select employeenumber FROM rolesperemployee WHERE employeenumber = p_employeenumber AND rolename = 'bus') IS NULL) THEN
        INSERT INTO rolesperemployee(employeenumber, rolename)
        VALUES (p_employeenumber, 'bus');
      END IF;
    ELSEIF(!p_bus) THEN
      DELETE FROM rolesperemployee WHERE employeenumber = p_employeenumber AND rolename = 'bus';
    END IF;
    IF(p_dispatcher) THEN
      IF((Select employeenumber FROM rolesperemployee WHERE employeenumber = p_employeenumber AND rolename = 'dispatcher') IS NULL) THEN
        INSERT INTO rolesperemployee(employeenumber, rolename)
        VALUES (p_employeenumber, 'dispatcher');
      END IF;
    ELSEIF(!p_dispatcher) THEN
      DELETE FROM rolesperemployee WHERE employeenumber = p_employeenumber AND rolename = 'dispatcher';
    END IF;
  END //
DELIMITER ;