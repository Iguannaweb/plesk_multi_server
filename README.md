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

## Data files
I just wanted to make things easy... so I decided to save data on files. One global and others separated.

- Data directory: ./igw-content/data/xxx
- Folder type (xxx): clients | domains | server | status
- Files (xxx).data: 
    - clients.data (serialized array of clients info) and clients.X.data (single serialized array of clients of one server)
    - domains.data (serialized array of domains info) and domains.X.data (single serialized array of domains of one server)
    - server.data (serialized array of server info) and server.X.data (single serialized array of one server info)
    - status.data (serialized array of status info) and status.X.data (single serialized array of service status of one server)

## Data saved in files (xxx).data

### server(x).data
```
"platform": "...",
"hostname": "...",
"guid": "...",
"panel_version": "...",
"panel_revision": "...",
"panel_build_date": "...",
"panel_update_version": "...",
"extension_version": "...",
"extension_release": "..."
```

### client(x).data
```
"id": x,
"created": "...",
"name":  "...",
"login":  "...",
"status": x,
"email":  "...",
"locale":  "...",
"guid":  "...",
"description":  "...",
"type":  "..."
```

### domains(x).data
```
"id": x,
"created": "...",
"name": "...",
"ascii_name": "...",
"base_domain_id": x,
"guid": "...",
"hosting_type": "...",
"www_root": "...",
"aliases": []
```

### status(x).data (xml file with status services)
```
<id>xxx</id>
<title>xxx</title>
<state>running/stopped/none</state>
```

## Cron setup to retrieve data every x minutes

Check that the time it takes to run the script is less than the time between one scheduled job and another. 5 minutes is a good time to time to check things. 

```
*/5 * * * * wget http://locahost/plesk_multi_server/update_data.php
```
