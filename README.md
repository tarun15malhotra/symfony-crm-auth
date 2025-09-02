# Symfony Commands and Setup Guide

## 1. Cache Management

Clear Symfony cache:

```bash
php bin/console cache:clear
````

## 2. CRUD and Controller Generation

Generate CRUD for `User` entity:

```bash
php bin/console make:crud User
```

Generate a new controller:

```bash
php bin/console make:controller Api/UserController
```

## 3. Database Migrations

Create a new migration:

```bash
php bin/console make:migration
```

Run migrations:

```bash
php bin/console doctrine:migrations:migrate
```

Generate migration for specific tables:

```bash
php bin/console doctrine:migrations:diff --filter-expression="/^page_block$/"
```

Check generated migrations:

```bash
ls migrations/
```

Run migrations again (if needed):

```bash
php bin/console doctrine:migrations:migrate
```

## 4. Symfony Server

Start Symfony local server:

```bash
symfony server:start
```

## 5. Database Operations

### 5.1 Create Database

```bash
php bin/console doctrine:database:create
```

### 5.2 Load Fixtures

```bash
php bin/console doctrine:fixtures:load
```

### 5.3 PostgreSQL Commands

Connect as superuser:

```bash
sudo -u postgres psql
```

List active connections to `symfony` database:

```sql
SELECT pid, usename, datname, application_name, client_addr 
FROM pg_stat_activity 
WHERE datname = 'symfony';
```

Terminate active connections:

```sql
SELECT pg_terminate_backend(pid) 
FROM pg_stat_activity 
WHERE datname = 'symfony';
```

Terminate all connections except current:

```sql
SELECT pg_terminate_backend(pid)
FROM pg_stat_activity
WHERE datname = 'symfony' AND pid <> pg_backend_pid();
```

Drop database:

```bash
sudo -u postgres php bin/console doctrine:database:drop --force
```

Create database:

```bash
sudo -u postgres php bin/console doctrine:database:create
```

Generate fresh migration:

```bash
php bin/console doctrine:migrations:diff
```

Run migrations and fixtures:

```bash
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

### 5.4 PostgreSQL Setup Example

```sql
-- Login as postgres superuser
sudo -u postgres psql

-- Create user 'root' with password
CREATE USER root WITH PASSWORD 'root';

-- Give privileges on symfony database
GRANT ALL PRIVILEGES ON DATABASE symfony TO root;

-- Connect to symfony database
\c symfony;

-- Give schema privileges
GRANT ALL PRIVILEGES ON SCHEMA public TO root;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO root;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO root;

-- Optional: Make root the schema owner
ALTER SCHEMA public OWNER TO root;
```

## 6. Symfony Project Setup

Create new Symfony project:

```bash
composer create-project symfony/skeleton symfony-crm1
cd symfony-crm
```

Add WebApp dependencies:

```bash
composer require webapp
```

Start Symfony server:

```bash
symfony server:start
```

Install Security & Maker Bundles:

```bash
composer require security
composer require symfony/maker-bundle --dev
```

Create User entity:

```bash
php bin/console make:user
```

Generate Login Form Authenticator:

```bash
php bin/console make:security:form-login
```

## 7. Project Directory Structure

```
/symfony-crm
├── assets/                     
│   ├── styles/                 
│   ├── js/                     
│   └── images/
├── auth/
│   ├── assets/                 
│   │   ├── styles/             
│   │   ├── js/                 
│   │   └── images/
├── config/                     
│   ├── packages/               
│   └── routes/                 
├── public/                     
│   ├── build/                  
│   ├── uploads/                
│   └── index.php               
├── src/
│   ├── Controller/             
│   │   ├── Auth/               
│   │   ├── DashboardController.php
│   │   ├── LeadController.php
│   │   └── ...
│   ├── Entity/                 
│   ├── Repository/             
│   ├── Form/                   
│   ├── Security/               
│   ├── Service/                
│   └── EventListener/          
├── templates/                  
│   ├── base.html.twig          
│   ├── partials/               
│   ├── auth/                   
│   ├── dashboard/              
│   └── ...
├── translations/               
├── migrations/                 
├── var/                        
├── vendor/                     
├── .env                        
├── composer.json               
└── webpack.config.js / vite.config.js
```

