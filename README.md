# Laravel Product Management API

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200" alt="Laravel Logo"></a></p>

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

## Installation

1. Clone the repository
2. Navigate to the project directory
3. Run Docker containers:

   ```bash
   docker compose up -d
   ```

4. Install dependencies:

   ```bash
   docker exec join-php bash -c 'composer install"
   ```

5. Copy the environment file:

   ```bash
   cp .env.example .env
   ```

6. Generate application key:

   ```bash
   docker exec join-php bash -c "php artisan key:generate"
   ```

7. Run migrations:

   ```bash
   docker exec join-php bash -c "php artisan migrate"
   ```

8. Seed the database:

   ```bash
   docker exec join-php bash -c "php artisan db:seed"
   ```

## API Endpoints

### Product Categories

- `GET /api/categorias` - List all product categories
- `POST /api/categorias` - Create a new product category
- `GET /api/categorias/{id}` - Get a specific product category
- `PUT /api/categorias/{id}` - Update a product category
- `DELETE /api/categorias/{id}` - Delete a product category

### Products

- `GET /api/produtos` - List all products
- `POST /api/produtos` - Create a new product
- `GET /api/produtos/{id}` - Get a specific product
- `PUT /api/produtos/{id}` - Update a product
- `DELETE /api/produtos/{id}` - Delete a product

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
