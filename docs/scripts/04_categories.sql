CREATE TABLE categories(  
    category_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
    category_name VARCHAR(128) NOT NULL COMMENT 'Category Name',
    category_small_desc VARCHAR(255),
    category_status CHAR(3) DEFAULT 'ACT' COMMENT 'Status',
    create_time DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Create Time',
    update_time DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Update Time'
) COMMENT 'Table for Category';
