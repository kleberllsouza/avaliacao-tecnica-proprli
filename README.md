
# Laravel Proprli Project

## Step by Step

Clone Repository

```sh
git clone https://github.com/kleberllsouza/avaliacao-tecnica-proprli.git
```

Create the .env File

```sh
cp .env.example .env
```

Update the environment variables in the .env file

```dosini
APP_NAME="Projeto Laravel Proprli"
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

Start the project’s containers

```sh
docker-compose up -d
```

Access the container

```sh
docker-compose exec app bash
```

Install the project’s dependencies

```sh
composer install
```

Generate the Laravel project key

```sh
php artisan key:generate
```

Access the project
Open your browser and go to [http://localhost:8989](http://localhost:8989)
