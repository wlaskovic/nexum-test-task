# Nexum project setup

## Introduction

This guide provides step-by-step instructions to set up and run this project.

## Prerequisites

Make sure you have the following installed on your machine:

- [Docker](https://www.docker.com/)

## Setup Steps

### 1. Clone the Repository

```bash
git clone https://github.com/wlaskovic/nexum-test-task
cd nexum-test-task
```

### 2. Set Up .env File based on docker-compose.yml
```
cp .env.example .env

```
I used **pgsql** for **DB_CONNECTION** and **DB_HOST**, and **5432** for **DB_PORT**, and setup **DB_PASSWORD**

### 3. Installing Composer Dependencies For Existing Applications
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

### 4. Start Sail Containers
```
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
sail up -d
```
If the **.env** was setup properly, this will create the database too.

### 5. Run Migrations
```
sail artisan migrate
```

### 6. Seed Database 
```
sail artisan db:seed --class=DatabaseSeeder
```

### 7. Compile Frontend Assets
Open new terminal
```
sail yarn install
sail yarn dev
```

### 8. Other commands to make the application work properly
```
sail php artisan key:generate
sail php artisan storage:link
```