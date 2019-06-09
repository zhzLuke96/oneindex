# Docker-oneindex

## 运行：
```
git clone https://github.com/zhzLuke96/oneindex.git --depth=1; \
cd oneindex; \
docker-compose up -d

```
## 变量：

- `TZ`：时区，默认`Asia/Shanghai`
- `PORT`：服务监听端口，默认为80
- `DISABLE_CRON`：是否禁用crontab自动刷新缓存，设置任意值则不启用
- `REFRESH_TOKEN`：使用crontab进行token更新，默认`0 * * * *`，即每小时更新一次
- `REFRESH_CACHE`：使用crontab进行缓存更新，默认`*/10 * * * *`，即每10分钟更新一次
- `SSH_PASSWORD`：sshd用户密码，用户名为`root`，若不设置则不启用sshd

## 持久化：

- `/var/www/html/cache`：缓存存储目录
- `/var/www/html/config`：配置文件存储目录
