[Установка Redis + Redis PHP + phpRedisAdmin на боевом сервере за 15 минут](http://habrahabr.ru/post/134974/)
========

###Собираем Redis:

* `antirez-redis-04bba69`: [https://github.com/antirez/redis/zipball/2.4.4](https://github.com/antirez/redis/zipball/2.4.4)
* `$ make` (sudo apt-get install gcc)
* `$ make test`: ([sudo apt-get install tcl8.5](http://askubuntu.com/questions/58869/how-to-sucessfully-install-redis-server-tclsh8-5-not-found-error))


###Уносим файлы Redis в /usr/bin/redis

* `antirez-redis-04bba69`: Мы все еще остаемся в папке, где лежат исходники
* `$ sudo mkdir /usr/bin/redis`
* `$ sudo cp src/redis-benchmark /usr/bin/redis`
* `$ sudo cp src/redis-check-aof /usr/bin/redis`
* `$ sudo cp src/redis-check-dump /usr/bin/redis`
* `$ sudo cp src/redis-cli /usr/bin/redis`
* `$ sudo cp src/redis-server /usr/bin/redis`


###Теперь нам нужно создать файл для запуска redis-server.

* `$ sudo vim /usr/bin/redis-server`
* `В файл вставляем`: cd /usr/bin/redis && ./redis-server redis.conf
* `Осталось взять redis.conf`: ([redis.conf](https://raw.githubusercontent.com/antirez/redis/unstable/redis.conf))


###Запуск!

Если все было сделано правильно, то запускаем сервер

* `$ redis-server`
* `$ telnet localhost 6379`


###Тестируем сервер

* `SET testkey testvalue`
* `KEYS *`: Получаем все ключи
* `GET testkey`: Сервер должен вернуть testvalue
* `QUIT`

###Redis + PHP5. Компилируем модуль для PHP ([Устанавливаем PhpRedis](http://anton.logvinenko.name/ru/blog/kak-ustanovit-redis-i-redis-php-klient.html) - собираем redis.so)

* `$ phpize`: ([apt-get install php5-dev](http://stackoverflow.com/questions/3108937/how-to-install-and-run-phpize))
* `$ ./configure CFLAGS="-O3"`
* `$ make clean all`
* `$ sudo cp modules/redis.so /usr/lib/php5/<date>`
* `sudo echo extension=redis.so > /etc/php5/conf.d/redis.ini`: Теперь необходимо добавить модуль в конфиг php для Ubuntu
* `перезапустить веб сервер`: sudo /etc/init.d/apache2 restart  ||  sudo /etc/init.d/nginx restart


[Применение redis в веб-приложениях](http://belyakov.su/praktika-ispolzovaniya-redis)
========

Redis - нереляционная высокопроизводительная СУБД, которая позволяет получать доступ к данным посредством ключа и умеет хранить массивы(наборы), словари, списки и строки. Конфигурирование редис также позволяет настроить хранение данных как в памяти, так и на диске + время жизни данных. Ограничение лишь в том, что объем хранимых данных не может привышать объём оперативной памяти, но нам это и ненужно.

###Перейдем к некоторым вариантам применения редис:

* `хранение сессий`
* `пользователи online`
* `очереди`
* `голосовалки`


###Еще ссылки:

* `Так для каких же целей можно использовать Redis?`:[ http://eax.me/redis/]( http://eax.me/redis/)
* `Установка Redis на Windows 7`: [http://webdraft.org/article/set-up-redis-on-windows-7](http://webdraft.org/article/set-up-redis-on-windows-7)
* `Redis для windows`: [http://zlob.in/2013/01/redis-dlya-windows/](http://zlob.in/2013/01/redis-dlya-windows/)
* `Predis`: [https://github.com/nrk/predis](https://github.com/nrk/predis)
* `how to install and run phpize`: [http://stackoverflow.com/questions/3108937/how-to-install-and-run-phpize](http://stackoverflow.com/questions/3108937/how-to-install-and-run-phpize)
* `How to sucessfully install redis-server, “tclsh8.5 not found” error`: [http://askubuntu.com/questions/58869/how-to-sucessfully-install-redis-server-tclsh8-5-not-found-error](http://askubuntu.com/questions/58869/how-to-sucessfully-install-redis-server-tclsh8-5-not-found-error)
* `Как установить Redis и Redis php клиент`: [http://anton.logvinenko.name/ru/blog/kak-ustanovit-redis-i-redis-php-klient.html](http://anton.logvinenko.name/ru/blog/kak-ustanovit-redis-i-redis-php-klient.html)
* `Практика использования Redis`: [http://belyakov.su/praktika-ispolzovaniya-redis](http://belyakov.su/praktika-ispolzovaniya-redis)
* `RedisDesktopManager Build on Linux`: [https://github.com/uglide/RedisDesktopManager/wiki/Build-from-source](https://github.com/uglide/RedisDesktopManager/wiki/Build-from-source)
* `Redis Desktop Manager`: [https://github.com/uglide/RedisDesktopManager](https://github.com/uglide/RedisDesktopManager)
* `Redis Desktop Manager - How to start using RDM`: [https://github.com/uglide/RedisDesktopManager/wiki/Quick-Start](https://github.com/uglide/RedisDesktopManager/wiki/Quick-Start)
* `How to Use Redis with PHP using PhpRedis with Examples`: [http://www.thegeekstuff.com/2014/02/phpredis/](http://www.thegeekstuff.com/2014/02/phpredis/)
