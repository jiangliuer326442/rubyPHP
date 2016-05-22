@echo off
echo 正在从服务器上下载数据文件
mysqldump -h 121.41.21.58 -uroot -pFangha326442 rubyphp> db.sql
echo 正在恢复本地数据库
mysql -uroot -p123456 rubyphp < db.sql
echo 删除数据文件
del db.sql
REM Pause