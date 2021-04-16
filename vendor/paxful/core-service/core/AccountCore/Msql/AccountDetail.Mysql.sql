CREATE TABLE AccountDetail(
id int(11)  PRIMARY KEY AUTO_INCREMENT  comment '账户明细编号',
money float(11)  comment '账户明细金额',
notes varchar(200)  comment '账户明细备注',
picture varchar(200)  comment '账户明细凭证',
userInfo int(11)  comment '账户明细用户',
classification int(11)  comment '账户明细分类',
path varchar(200)  comment '账户明细路径',
transactionNumber varchar(50)  comment '账户明细交易号',
insertTime DATETIME  comment '账户明细添加时间',
updateTime DATETIME  comment '账户明细修改时间',
mark varchar(100)  comment '账户明细标志',
status int(11)  comment '账户流水状态'
)
