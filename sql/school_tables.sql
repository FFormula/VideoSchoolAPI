CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user VARCHAR(255), -- user screen name - [a-z0-9_.]
    email VARCHAR(99),
    passw VARCHAR(40), -- md5 of password
    master_id INT, -- invite user id
    status ENUM('open', 'stop'),
    FOREIGN KEY (master_id) REFERENCES users (user_id),
    UNIQUE INDEX (user)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE packets (
    packet_id varchar(32) PRIMARY KEY,
    name VARCHAR(255),
    info TEXT,
    html TEXT,
    price DECIMAL(10,2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;