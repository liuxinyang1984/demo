-- 清空数据;
TRUNCATE TABLE user_old ;

-- 导入会员数据;

LOAD DATA LOCAL INFILE '/www/user.csv'
INTO TABLE user_old
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(inviter_name,inviter_id,inviter_phone,id,name,phone,LEVEL) ;


-- 查询实际推荐人,信息为空的数据
SELECT uo.id AS 用户id,uo.name AS 用户名称 ,uo.phone AS 电话,uo.inviter_id AS 数据推荐人id,uo2.id AS 推荐人id,uo.inviter_phone AS 数据推荐人电话 ,uo2.phone AS 推荐人电话 ,uo.inviter_name AS 数据推荐人名称,uo2.name AS 推荐人名称 FROM user_old uo LEFT JOIN user_old uo2 ON uo.inviter_id = uo2.id WHERE uo2.phone= '' and uo2.name = '';


-- 查询姓名和电话都为空 共934
SELECT COUNT(*)  FROM user_old uo  WHERE uo.name = '' AND uo.phone = '';
SELECT * FROM user_old uo WHERE uo.name='' AND uo.phone = '';


SELECT count(*) FROM user_old uo ;
-- 查询电话为空的数据  共990
SELECT COUNT(*)  FROM user_old uo  WHERE uo.phone = '';
SELECT * FROM user_old uo WHERE uo.phone='';

-- 电话为空,但姓名不为空  共56
SELECT COUNT(*)  FROM user_old uo  WHERE uo.phone = '' AND uo.name !='';
SELECT * FROM user_old uo WHERE uo.phone='' AND uo.name != '';

--
-- 查询姓名为空的数据 共1390
SELECT COUNT(*)  FROM user_old uo  WHERE uo.name = '';
SELECT * FROM user_old uo WHERE uo.name='';

-- 查询姓名为空的数据 ,但电话不为空 456
SELECT COUNT(*)  FROM user_old uo  WHERE uo.name = '' AND uo.phone !='';
SELECT * FROM user_old uo WHERE uo.name='';

-- 查询重复数据
SELECT uo.phone AS 电话,count (uo.phone) FROM user_old uo GROUP BY uo.phone  ORDER BY count(uo.phone) DESC;

SELECT * FROM user_old uo ORDER BY id DESC LIMIT 1;


DESC user_old;

-- 新建中间表
CREATE TABLE middle_table(
	id int NOT NULL PRIMARY KEY auto_increment,
	name varchar(128),
	phone varchar(64),
	inviter_id int,
	inviter_name varchar(128),
	inviter_phone varchar(64)
) comment "中间表";
