CREATE TABLE AccountInfo(
id int(11)  PRIMARY KEY AUTO_INCREMENT  comment '账户信息编号',
bankCardNum varchar(19)  comment '账户信息银行卡号',
name varchar(100)  comment '账户信息姓名',
bankAddress varchar(100)  comment '账户信息银行地址',
bankName varchar(100)  comment '账户信息开户银行',
path varchar(100)  comment '账户信息路径',
mark varchar(100)  comment '账户信息标志',
inserTime DATETIME  comment '账户信息添加时间',
updateTime DATETIME  comment '账户信息修改时间',
userInfo int(11)  comment '银行卡关联用户信息'
)
