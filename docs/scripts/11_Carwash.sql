CREATE TABLE CarWash(  
    lavado_Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
    lavado_Nombre VARCHAR(60) NOT NULL,
    lavado_Apellido VARCHAR(60) NOT NULL,
    lavado_Token VARCHAR(15) NOT NULL,
    lavado_Reservacion VARCHAR(50),
    lavado_Tipo VARCHAR(50) NOT NULL,
    lavado_Img BLOB NOT NULL COMMENT 'Imagen del resivo de pago' 
) COMMENT 'Tabla para almacenar información de las reservaciones del carwash';
