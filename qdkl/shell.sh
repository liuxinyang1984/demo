#!/bin/sh
#添加表头
sed -i '1 i 序号,昵称,绑定手机号,上级推荐人手机号,密码,余额,积分,佣金,数字币,总 业绩,小区业绩,团队级别' *.csv
#转码
find ./ -name '*.csv' -exec iconv -f utf-8 -t gb18030 {} -o gbk/{} \;

