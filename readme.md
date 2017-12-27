# Требуется реализовать чат на веб-сокетах:

Требования:
- обмен данными чата должен работать через веб-сокеты
- мгновенная регистрация (при авторизации, если пользователя в нашей бд не существует - создать)
- фронтенд собрать с использованием twitter bootstrap или zurb fundation (на выбор разработчика)
- интерфейс должен быть респонсивным и изменяться под мобильное устройство
- внешний вид интерфейса на усмотрение разработчика
- бэкенд сделать на фреймворке yii2/laravel5 (на выбор)
- администратор чата (пользователь с соответствующим свойством в бд), должен иметь возможность отключать или банить пользователя
- структуру бд создать миграцями
- создать первого пользователя (админа) с произвольным логином и паролем через миграции (или фикстуры/сиды)
- ограничения сообщений - до 200 символов в 1 сообщении, 15 секунд между сообщениями одного пользователя
- зашедшему пользователю присваивается случайный цвет его ник-нейма и цвету сообщения (подобрать список цветов, чтобы текст не сливался с фоном)
- требование к ник-нейму - минимум 3 символа, запрет спец.символов


# To start:
- php artisan serve
- php artisan chat_server:serve (to start websokets)


# Create virtual host: 
- /etc/hosts (add new link 127.0.0.1)
- cp & edit chat.conf /etc/apache2/site-available/chat.conf
- a2ensite chat.conf
- service apache2 restart
- chmod -R 755 /path/chat.loc
- chown -R www-data:www-data /path/chat.loc

<VirtualHost *:80>
        ServerAdmin webmaster@localhost
        ServerName  chat.loc
        DocumentRoot /home/itdev/projects/chat/public
	<Directory />
            Options FollowSymLinks
            AllowOverride None
        </Directory>
        <Directory /home/itdev/projects/chat/>
                Options FollowSymLinks MultiViews
                AllowOverride All
                Order allow,deny
                allow from all
		Require all granted
       </Directory>
        ScriptAlias /cgi-bin/ /usr/lib/cgi-bin/
        <Directory "/usr/lib/cgi-bin">
                AllowOverride None
                Options +ExecCGI -MultiViews +SymLinksIfOwnerMatch
                Order allow,deny
                Allow from all
        </Directory>
        ErrorLog ${APACHE_LOG_DIR}/chat.error.log
        # Possible values include: debug, info, notice, warn, error, crit,
        # alert, emerg.
        LogLevel warn
        CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
