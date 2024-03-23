CREATE TABLE pulseras(  
    sku VARCHAR(32) NOT NULL PRIMARY KEY,
    nombre VARCHAR(128) NOT NULL,
    precio DECIMAL(13,2) NOT NULL,
    colorDominante VARCHAR(32) not NULL DEFAULT('blanco')
) COMMENT 'Tabla de Pulseras';