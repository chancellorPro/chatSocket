# Chat on web sockets: (laravel & Ratchet)

Requirements:
- The exchange of chat data should work through web sockets
- Instant registration (for authorization, if the user does not exist in database - create one)
- Design the frontend using twitter bootstrap or zurb fundation (at the developer's choice)
- The interface should be responsive and change for mobile device
- The appearance of the interface at the discretion of the developer
- Make the backend on the yii2 / laravel5 framework (to choose from)
- The administrator of the chat (the user with the corresponding property in the database), should be able to disable or ban the user
- The structure of the database to create migrations
- Create the first user (administrator) with arbitrary login and password through migrations (or fixtures / seats)
- Number of messages - up to 200 characters in 1 message, 15 seconds between messages of the same user
- The incoming user is assigned a random color of his nickname and the color of the message (choose a list of colors so that the text does not merge with the background)
- Requirement for nickname - at least 3 characters, prohibition of special characters

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
