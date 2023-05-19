# Movie API Livewire and Laravel App 🎥🌐🚀

This is a Livewire and Laravel application that consumes a movie API. It is designed to work with Traefik and uses Docker Compose for easy deployment. By following the instructions below, you can run the application on your local machine.

## Prerequisites

Before running this application, make sure you have the following installed:

- Docker and Docker Compose 🐳
- A domain name with a valid SSL certificate 🔒

## Configuration

To configure the application, follow these steps:

1. Clone this repository to your local machine: 📥

git clone https://github.com/Slourp/movies.git

2. Create a file called .env in the root directory of the repository and set the following environment variables: 🛠️

```shell
# docker
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

3. Modify the docker-compose.dev.yml file to suit your needs. You can change the Traefik version, port mappings, environment variables, and other settings.

4. Run the following command to start the application: 🏃

docker-compose -f docker-compose.dev.yml up -d

5. Install the project dependencies by running the following command: 📦

docker exec -ti MOVIES_LARAVEL_PHP composer install

This command will install all the necessary dependencies for the Laravel application.

## Accessing the Application

Once the application is up and running, you can access it using the domain name you specified in the .env file. In this case, the application will be accessible at https://movies.traefik.me. 🌐🔐

## Project Overview ℹ️

Provide a brief overview of the project, its purpose, and key features.

## Project Structure 📁

Explain the organization and structure of the project. Describe the main directories, files, and their purposes.

## Dependencies 📦

List any external dependencies or libraries used in the project. Include their names, versions, and any necessary installation or setup instructions.

## Usage Examples 💡

Include some usage examples or code snippets to demonstrate how to use the application.

## Troubleshooting ❗

Provide a troubleshooting section that addresses common issues users may encounter and suggests potential solutions.

## Contributing 🤝

If you're open to contributions from the community, provide guidelines for contributing to the project.

## License 📝

Specify the license under which the project is distributed.

## Maintenance

To stop and remove the application, run the following command: ⛔🧹

docker-compose -f docker-compose.dev.yml down

## Need Help? Contact the Developer! 🙋‍♂️

If you have any questions, issues, or feature requests, feel free to contact the developer of this project.

- Name: David V.
- Email: davidvanmak+laravel_app@gmail.com
- GitHub: https://github.com/Slourp/

The developer is always happy to help! 😊