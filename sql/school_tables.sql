CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    master_id INT, -- invite user id
    name VARCHAR(255), -- user screen name - [a-z0-9_.]
    email VARCHAR(99),
    password_hash VARCHAR(40), -- hash of password
    status ENUM('wait', 'open', 'stop'),
    FOREIGN KEY (master_id) REFERENCES users (user_id),
    UNIQUE INDEX (user),
    UNIQUE INDEX (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO users
   SET master_id = NULL,
       name = 'system',
       email = 'system@videosharp.info',
       password_hash = '',
       status = 'stop';