CREATE TABLE AccountClassification(
id int(11)  PRIMARY KEY AUTO_INCREMENT  comment '账户分类编号',
name varchar(50)  comment '账户分类名称',
icon varchar(200)  comment '账户分类图标',
path varchar(200)  comment '账户分类路径',
insertTime DATETIME  comment '账户分类添加时间',
updateTime DATETIME  comment '账户分类修改时间',
mark varchar(100)  comment '账户分类标志'
)
