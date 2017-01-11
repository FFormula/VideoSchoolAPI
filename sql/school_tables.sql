create table packets (
	packet_id varchar(32) primary key,
	name varchar(255),
	info text,
	html text,
	price decimal(10,2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;