# Laravel Product Management API

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About The Project

This is a Laravel-based REST API project that provides CRUD operations for product categories and products. The project is containerized using Docker for easy setup and deployment.

## Features

- **Product Categories Management**
  - Create new product categories
  - Read product categories
  - Update existing product categories
  - Delete product categories

- **Products Management**
  - Create new products
  - Read products
  - Update existing products
  - Delete products

## Requirements

- Docker
- Docker Compose

## Installation

1. Clone the repository
2. Navigate to the project directory
3. Run Docker containers:

   ```bash
   docker-compose up -d
   ```

4. Install dependencies:

   ```bash
   docker-compose exec app composer install
   ```

5. Copy the environment file:

   ```bash
   cp .env.example .env
   ```

6. Generate application key:

   ```bash
   docker-compose exec app php artisan key:generate
   ```

7. Run migrations:

   ```bash
   docker-compose exec app php artisan migrate
   ```

## API Endpoints

### Product Categories

- `GET /api/categoria-produto` - List all product categories
- `POST /api/categoria-produto` - Create a new product category
- `GET /api/categoria-produto/{id}` - Get a specific product category
- `PUT /api/categoria-produto/{id}` - Update a product category
- `DELETE /api/categoria-produto/{id}` - Delete a product category

### Products

- `GET /api/produto` - List all products
- `POST /api/produto` - Create a new product
- `GET /api/produto/{id}` - Get a specific product
- `PUT /api/produto/{id}` - Update a product
- `DELETE /api/produto/{id}` - Delete a product

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
