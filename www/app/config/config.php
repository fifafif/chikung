<?php die; ?>

; ini (in php file) for app configuration

; development configuration
[dev:domain=localhost]
db_host = localhost
db_name = 90days
db_username = root
db_password = 
root = /

[dev:domain=192.168.1.66]
db_host = localhost
db_name = 90days
db_username = root
db_password = 
root = /

; production configuration
[prod:domain=live.cz]
db_host = 
db_name = 
db_username = 
db_password = 
root = /
