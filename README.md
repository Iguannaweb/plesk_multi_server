# Plesk MS - Multiserver Administration panel

Cluster solution for plesk multiserver administration.

<div style="min-height: 67px;width: 560px; max-width: 90%; border-radius: 12px; padding: 16px 22px 17px 20px; display: flex;align-items: center;background: #f2a600; color: #fff; font-family: Verdana; margin-left: 10px;"><strong>DO NOT USE THIS ON A PUBLIC SERVER, IT IS INTENDED TO RUN ONLY ON LOCALHOST. IF YOU RUN IT ON A PUBLIC SERVER WITHOUT HTACCESS PROTECTION, YOU ARE GIVING ACCESS TO YOUR PLESK SERVER TO THE PUBLIC</strong></div>


## Preliminar estructure.

- Server List with basic information
- Server information page with domains, clients, services and server info.

## Install instructions

1. Copy the repository on your server directory

```
git clone https://github.com/Iguannaweb/ples_multi_server.git
```

2. Run composer install to fetch dependencies
2. Fill data on ./igw-includes/config/config.example.php and rename to ./igw-includes/config/config.php (email, name and array data with host, user and passwords)

## Page information

### 1. Server list
### 2. Server info
### 3. Manual update data

## Cron setup to retrieve data every x minutes
    