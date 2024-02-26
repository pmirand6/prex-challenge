# GIPHY API Integration Challenge

## Description

This project integrates with the GIPHY API to develop a custom REST API that exposes a set of services with OAuth2.0 authentication.
It is designed to demonstrate the ability to interact with external APIs, authenticate users securely, and provide a simple, efficient interface for retrieving and manipulating data.

## Requirements

- Docker
- Docker Compose
- Git
- Postman (for API testing)

## Getting Started

### Installation

1. **Clone the Repository**

   First, clone this repository to your local machine using Git:

   ```
   git clone https://github.com/pmirand6/prex-challenge
   cd prex-challenge
   ```

2. **Create the containers**

    Run the following command to build and start the Docker containers:

   ```
   docker compose up -d --build
   ```

3. **Install Dependencies**

   After the containers are running, you can install the project dependencies using Composer:

   ```
   docker exec -it prex-challenge-app composer install
   ```

4. **Run Migrations and Seeders**

   Run the following commands to create the database tables and seed the database with sample data:

   ```
   docker exec -it prex-challenge-app php artisan migrate
   docker exec -it prex-challenge-app php artisan db:seed
   ```

5. **Generate Passport Keys**

   Run the following command to generate the keys required for OAuth2.0 authentication:

   ```
   docker exec -it prex-challenge-app php artisan passport:install
   ```

### Usage

After starting the Docker container, your API is accessible at `http://localhost:8498` (or whichever port you mapped to the container's port 80).
#### The user credentials for the seeded user are as follows:
````
email = test@prex-challenge.com
password = password
````
#### API Endpoints
TODO: Add API documentation

#### Testing
TODO: Add testing instructions

## Documentation

TODO: Add API documentation