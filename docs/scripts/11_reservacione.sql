CREATE TABLE reservaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    hora VARCHAR(10) NOT NULL,
    estado ENUM('pendiente', 'confirmada') NOT NULL
);


-- Precedimiento
DELIMITER //

CREATE PROCEDURE BorrarReservacionesConfirmadas()
BEGIN
    DELETE FROM reservaciones 
    WHERE estado = 'confirmada'
    AND fecha < CURDATE();
END //

DELIMITER ;


-- Evento
CREATE EVENT IF NOT EXISTS BorrarReservacionesDiarias
ON SCHEDULE EVERY 1 DAY
STARTS '2024-10-17 00:00:00'
DO
CALL BorrarReservacionesConfirmadas();

