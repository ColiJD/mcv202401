-- Creación de la tabla CarWash
CREATE TABLE CarWash (
    lavado_Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key', -- Identificador único para cada lavado
    lavado_Nombre VARCHAR(60) NOT NULL, -- Nombre del cliente
    lavado_Apellido VARCHAR(60) NOT NULL, -- Apellido del cliente
    lavado_Token VARCHAR(15) NOT NULL, -- Token único para la reservación
    lavado_Reservacion VARCHAR(50), -- Información adicional sobre la reservación
    lavado_Tipo VARCHAR(50) NOT NULL, -- Tipo de servicio de lavado
    lavado_Img BLOB NOT NULL COMMENT 'Imagen del recibo de pago' ,-- Imagen del recibo de pago
    lavado_Telefono VARCHAR(8) NOT NULL,
    total DOUBLE NOT NULL
) COMMENT 'Tabla para almacenar información de las reservaciones del carwash';

-- Agregar restricción de unicidad para el campo lavado_Token
ALTER TABLE carwash
ADD CONSTRAINT unique_reservation UNIQUE (lavado_Token);

-- Verificar si el Event Scheduler está habilitado
SHOW VARIABLES LIKE 'event_scheduler';

-- Si no está habilitado, activarlo
SET GLOBAL event_scheduler = ON;

DELIMITER / /

-- Crear un procedimiento almacenado para eliminar todos los registros de la tabla CarWash
CREATE PROCEDURE borrar_carwash()
BEGIN
  DELETE FROM CarWash; -- Eliminar todos los registros
END //

DELIMITER;

-- Crear un evento programado que llama al procedimiento borrar_carwash diariamente
-- Crear un evento programado que llama al procedimiento borrar_carwash diariamente
CREATE EVENT IF NOT EXISTS ejecutar_borrar_carwash_diario
ON SCHEDULE EVERY 1 DAY STARTS '2024-10-22 00:00:00'  -- Ajusta la fecha de inicio
DO
BEGIN
    CALL borrar_carwash();  -- Asegúrate de que el procedimiento existe y está correcto
END;
