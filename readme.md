# Required to implement the chat on web sockets:

Requirements:
- the exchange of chat data should work through web sockets
- instant registration (for authorization, if the user does not exist in our database - create one)
- Collect the frontend using twitter bootstrap or zurb fundation (at the developer's choice)
- the interface should be responsive and change for mobile device
- the appearance of the interface at the discretion of the developer
- make the backend on the yii2 / laravel5 framework (to choose from)
- the administrator of the chat (the user with the corresponding property in the database), should be able to disable or ban the user
- the structure of the database to create migrations
- create the first user (administrator) with arbitrary login and password through migrations (or fixtures / seats)
- number of messages - up to 200 characters in 1 message, 15 seconds between messages of the same user
- the incoming user is assigned a random color of his nickname and the color of the message (choose a list of colors so that the text does not merge with the background)
- requirement for nickname - at least 3 characters, prohibition of special characters

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

```
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
```
