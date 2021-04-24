CREATE TABLE Address (
    id int PRIMARY KEY AUTO_INCREMENT,
    user_id int,
    address varchar(255),
    crypto_currency_code int,
    insertTime DATETIME,
    updateTime DATETIME
)