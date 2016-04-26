CREATE TABLE user (
username VARCHAR(20) PRIMARY KEY,
user_type VARCHAR(20),
salt VARCHAR(20),
hashed_password VARCHAR(256));
