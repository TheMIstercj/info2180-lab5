-- Run in phpMyAdmin after importing world.sql.
-- Local-development credentials only; not for a public server.
CREATE USER IF NOT EXISTS 'lab5_user'@'localhost' IDENTIFIED BY 'password123';
ALTER USER 'lab5_user'@'localhost' IDENTIFIED BY 'password123';
GRANT ALL PRIVILEGES ON world.* TO 'lab5_user'@'localhost';
