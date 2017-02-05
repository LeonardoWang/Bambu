# [Bambu](http://www.thebambu.com), your idle item trading app

![Bambu](https://github.com/LeonardoWang/Bambu/blob/master/public/img/favicon.ico)
---

Bambu is a idle item trading platform. Here you can sell your idle items or find useful stuffs and take them home! 

### Our website
[www.thebambu.com](http://www.thebambu.com) 


###Requirements
apache 2.x, php 5.x+, mysql, laravel 5.x, node.js, socket.io, redis

*[使用事件广播进行通讯](https://segmentfault.com/a/1190000002921506)*


####
installation of node.js, socket.io, redis

#####
node.js
sudo apt install nodejs-legacy
node chat.js

#####
socket.io installation

npm install socket.io -save //需要将socket.io 的依赖关系加入package.json中 
npm install ioredis -save//同理将依赖关系加入package.json中 

#####
redis installation
brew/apt-get

#####
redis usage

使用redis-server 启动redis 
如果想要关闭redis-server 请在另一个terminal中输入redis-cli 登录redis的客户端，之后输入shutdown 关闭redis-server: redis-cli shutdown
如果shutdown失败，请使用 ps -ef |grep redis

检测并查看后台redis信息，之后使用 kill -9 PID 强行将redis关闭 

当redis开启后，就可以打开本地的websocket服务器 

#####
Other useful instructions:
php artisan migrate:refresh
composer dump-autoload

### developer:
1. [Marc Wong](https://github.com/MarcWong) 
	* Front end enginer
2. [Leonardo Wang](https://github.com/LeonardoWang)
	* Back end enginer

### Contact us
[contact bambu](mailto:brucewayne@pku.edu.cn) 
