# Movie API Livewire and Laravel App 🎥🌐🚀

This is a Livewire and Laravel application that consumes a movie API. It is designed to work with Traefik and uses Docker Compose for easy deployment. By following the instructions below, you can run the application on your local machine.

## Prerequisites

Before running this application, make sure you have the following installed:

- Docker and Docker Compose 🐳
- A domain name with a valid SSL certificate 🔒
- [nvm (Node Version Manager)](https://github.com/nvm-sh/nvm#installing-and-updating)

## Initial Setup

1. Clone the traefik setup project to your local machine:

```shell
git clone git@github.com:Slourp/traefik.git
```

2. Run the traefik project with your user ID and group ID:

```shell
USER=$USER USER_ID=$(id -u) GROUP_ID=$(id -g) docker-compose -f docker-compose.dev.yml up -V -d --build
```

If you don't have a docker network called 'dev', create one:

```shell
docker network create dev
```

## Configuration

To configure the application, follow these steps:

1. Clone this repository to your local machine:

```shell
git clone https://github.com/Slourp/movies.git
```

2. Create a file called .env in the root directory of the repository and set the following environment variables:

```shell
# Docker
# Network variables
NETWORK_NAME=dev

# Project variables
PROJECT_NAME=MOVIES_LARAVEL

DOMAIN_NAME=movies
DOMAIN=movies.traefik.me

# Service variables
NGINX_VERSION=latest
MARIADB_VERSION=latest

# Database variables
MYSQL_PASSWORD=password
MYSQL_USER=user
MYSQL_DATABASE=main

# Domain variables
XDEBUG_MODE=on
BUILD_TARGET=app
```

3. Modify the `docker-compose.dev.yml` file to suit your needs. You can change the Traefik version, port mappings, environment variables, and other settings.

4. update settins in the app's .env file ( secret token ).

5. Run the following command to start the application:

```shell
USER=$USER USER_ID=$(id -u) GROUP_ID=$(id -g) docker-compose -f docker-compose.dev.yml up -V -d --build 
```

5. Enter the Docker container for the project:

```shell
docker exec -ti MOVIES_LARAVEL_PHP bash
```

6. Run the initialization script `./init.sh`. If Node.js is not installed, it will install the LTS version:

```shell
./init.sh
```

If there's any doubt if nvm is installed or not, you can run the script again.

7. Install Node.js and PHP dependencies:

```shell
npm install
composer install
```

8. Finally, run Laravel migrations and compile assets:

```shell
php artisan migrate
npm run dev 
```

## Accessing the Application

Once the application is up and running, you can access it using the domain name you specified in the .env file. In this case, the application will be accessible at https://movies.traefik.me.

For further details, like project overview, structure, dependencies, usage examples, troubleshooting, contributing, and licensing, please refer to the corresponding sections of this document.

## Useful Commands 🛠️

During the operation of the application, you might find the following commands useful:

### Running the Queue

When you click on 'Add to Database,' all the actions are pushed to a queue for execution. You can run the queue with the following command:

```shell
docker exec -ti MOVIES_LARAVEL_PHP php artisan queue:clear --queue=film_requests
```

### Populating the Database

To populate the database with all movies from the first page of 'Trending' and 'Awesome Movies,' use this command:

```shell
docker exec -ti MOVIES_LARAVEL_PHP films:resync
```

These commands help manage and control the data flow within the application, ensuring that the database remains up-to-date with the latest movie information.

## Maintenance

To stop and remove the application, run the following command:

```shell
docker-compose -f docker-compose.dev.yml down
```

## Need Help? Contact the Developer! 🙋‍♂️

If you have any questions, issues, or feature requests, feel free to contact the developer of this project.

- Name: David V.
- Email: davidvanmak+laravel_movie@gmail.com
- GitHub: [Slourp](https://github.com/Slourp/)

The developer is always happy to help! 😊