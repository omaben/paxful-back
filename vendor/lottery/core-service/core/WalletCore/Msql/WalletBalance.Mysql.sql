CREATE TABLE WalletBalance (
    id int PRIMARY KEY AUTO_INCREMENT,
    user_id int,
    balance int,
    incoming_amount int,
    address int,
    balance_escrow int,
    insertTime DATETIME,
    updateTime DATETIME
)