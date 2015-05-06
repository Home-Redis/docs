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
* `Predis`: [https://github.com/nrk/predis](https://github.com/nrk/predis)


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
* `how to install and run phpize`: [http://stackoverflow.com/questions/3108937/how-to-install-and-run-phpize](http://stackoverflow.com/questions/3108937/how-to-install-and-run-phpize)
* `How to sucessfully install redis-server, “tclsh8.5 not found” error`: [http://askubuntu.com/questions/58869/how-to-sucessfully-install-redis-server-tclsh8-5-not-found-error](http://askubuntu.com/questions/58869/how-to-sucessfully-install-redis-server-tclsh8-5-not-found-error)
* `Как установить Redis и Redis php клиент`: [http://anton.logvinenko.name/ru/blog/kak-ustanovit-redis-i-redis-php-klient.html](http://anton.logvinenko.name/ru/blog/kak-ustanovit-redis-i-redis-php-klient.html)
* `Практика использования Redis`: [http://belyakov.su/praktika-ispolzovaniya-redis](http://belyakov.su/praktika-ispolzovaniya-redis)
* `RedisDesktopManager Build on Linux`: [https://github.com/uglide/RedisDesktopManager/wiki/Build-from-source](https://github.com/uglide/RedisDesktopManager/wiki/Build-from-source)
* `Redis Desktop Manager`: [https://github.com/uglide/RedisDesktopManager](https://github.com/uglide/RedisDesktopManager)
* `Redis Desktop Manager - How to start using RDM`: [https://github.com/uglide/RedisDesktopManager/wiki/Quick-Start](https://github.com/uglide/RedisDesktopManager/wiki/Quick-Start)
* `How to Use Redis with PHP using PhpRedis with Examples`: [http://www.thegeekstuff.com/2014/02/phpredis/](http://www.thegeekstuff.com/2014/02/phpredis/)


* `Масштабирование - приёмы работы с Apache Camel`: [http://habrahabr.ru/post/219629/](http://habrahabr.ru/post/219629/)
* `Краткий обзор MQ (Messages queue) для применения в проектах на РНР. Часть 1`: [http://habrahabr.ru/post/44907/](http://habrahabr.ru/post/44907/)
* `ApacheMQ`: [http://abrdev.com/wp-content/uploads/2008/11/apachemq.png](http://abrdev.com/wp-content/uploads/2008/11/apachemq.png)
* `RabbitMQ`: [http://abrdev.com/wp-content/uploads/2008/11/rabbitmqlogo.png](http://abrdev.com/wp-content/uploads/2008/11/rabbitmqlogo.png)
* `BerkeleyDB`: [http://abrdev.com/wp-content/uploads/2008/10/berkeleydb.png](http://abrdev.com/wp-content/uploads/2008/10/berkeleydb.png)
* `MemcacheDB и MemcacheQ — ключевые компоненты высокопроизводительной инфраструктуры`: [http://abrdev.com/?p=471](http://abrdev.com/?p=471)
* `Конфигурация кэша`: [https://laravel.ru/docs/v3/cache/config](https://laravel.ru/docs/v3/cache/config)
* `Установка и настройка Redis кеширования в Magento`: [http://isranet.livejournal.com/201915.html](http://isranet.livejournal.com/201915.html)
* `[https://toster.ru/q/61392](https://toster.ru/q/61392)`
* `Что из этих технологий для чего используется?`: [https://toster.ru/q/153123](https://toster.ru/q/153123)
* `'Microsoft Azure' - Как использовать кэш Azure Redis`: [http://azure.microsoft.com/ru-ru/documentation/articles/cache-dotnet-how-to-use-azure-redis-cache/](http://azure.microsoft.com/ru-ru/documentation/articles/cache-dotnet-how-to-use-azure-redis-cache/)


![Масштабирование](http://hsto.org/getpro/habr/post_images/649/5c7/dc1/6495c7dc17eb971feee08e7562e25cca.png)

![azure-redis-cache](https://acomdpsstorage.blob.core.windows.net/dpsmedia-prod/azure.microsoft.com/ru-ru/documentation/articles/cache-dotnet-how-to-use-azure-redis-cache/20150415100627/redis-cache-new-cache-menu.png)

![BerkeleyDB](http://abrdev.com/wp-content/uploads/2008/10/berkeleydb.png)

![ApacheMQ](http://abrdev.com/wp-content/uploads/2008/11/apachemq.png)

![RabbitMQ](http://abrdev.com/wp-content/uploads/2008/11/rabbitmqlogo.png)