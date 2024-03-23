CREATE TABLE libros(  
    libros_id int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
    libros_desc VARCHAR(250) NOT NULL,
    libros_isbn VARCHAR(25) NOT NULL,
    libros_autor VARCHAR(250),
    libros_categoria CHAR(3) NOT NULL,
    libros_estado CHAR(3) NOT NULL
) COMMENT '';