CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255), -- user screen name - [a-z0-9_.]
    email VARCHAR(99),
    status ENUM('wait', 'open', 'stop'),
    passhash VARCHAR(40), -- hash of password
    UNIQUE INDEX (name),
    UNIQUE INDEX (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

