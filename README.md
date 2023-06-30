## User Management

### Requirements

* Docker Compose version v2.15.1

* PHP 8.0.9

### Steps to run
* Start up database with Docker
```
docker-compose up
```
* Execute Database/schema.sql

* Start up the project from terminal, insert this line:
```
php -S localhost:8000 -t /path/to/project
```

* Go to [localhost:8000](http://localhost:8000) in browser

