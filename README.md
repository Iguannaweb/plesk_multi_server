# Plesk MS - Multiserver Administration panel

Cluster solution for plesk multiserver administration.

| :exclamation:  DO NOT USE THIS ON A PUBLIC SERVER, IT IS INTENDED TO RUN ONLY ON LOCALHOST. IF YOU RUN IT ON A PUBLIC SERVER WITHOUT HTACCESS PROTECTION, YOU ARE GIVING ACCESS TO YOUR PLESK SERVER TO THE PUBLIC   |
|-----------------------------------------|


## Preliminar estructure.

- Server List with basic information
- Server information page with domains, clients, services and server info.

## Install instructions

1. Copy the repository on your server directory

```
git clone https://github.com/Iguannaweb/ples_multi_server.git
```

2. Run composer install to fetch dependencies
2. Fill data on ./igw-includes/config/config.example.php (email, name and array data with host, user and passwords) and rename to ./igw-includes/config/config.php 

## Page information

### 1. Server list
### 2. Server info
### 3. Manual update data

## Cron setup to retrieve data every x minutes
    