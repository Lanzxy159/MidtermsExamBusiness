CREATE TABLE business_admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    username VARCHAR(50),
    password VARCHAR(50)
);

CREATE TABLE business_application (
    business_cat_id INT AUTO_INCREMENT PRIMARY KEY,
    business_cat VARCHAR(50),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_by INT,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    updated_by INT
);

CREATE TABLE business_details (
    business_id INT AUTO_INCREMENT PRIMARY KEY,
    business_owner VARCHAR(50),
    business_name VARCHAR(50),
    branch VARCHAR(50),
    business_cat_id INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_by INT,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    updated_by INT
);
