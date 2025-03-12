# Full Stack Product Management System

![Laravel Logo](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)
![Next.js Logo](https://raw.githubusercontent.com/vercel/next.js/canary/docs/public/images/next.svg)

## About The Project

This is a full-stack web application for product management, featuring:

- **Backend**: A Laravel-based REST API that provides CRUD operations for product categories and products
- **Frontend**: A modern web interface built with Next.js 14 and TypeScript, offering a responsive and type-safe user experience

The entire project is containerized using Docker for easy setup and deployment.

## Technical Stack

### Backend

- Laravel 10 (PHP 8.2)
- MySQL 8.0
- RESTful API architecture
- Docker containerization

### Frontend

- Next.js 14
- TypeScript
- Material-UI (MUI)
- React Query for API state management
- Docker containerization

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
3. Set up environment files:

   ```bash
   # Backend environment
   cp app-backend/.env.example app-backend/.env
   
   # Frontend environment
   cp app-frontend/.env.example app-frontend/.env
   ```

4. Start all containers:

   ```bash
   docker compose up -d
   ```

5. Set up the Laravel application:

   ```bash
   docker exec join-php bash -c 'composer install'
   docker exec join-php bash -c "php artisan key:generate"
   docker exec join-php bash -c "php artisan migrate"
   docker exec join-php bash -c "php artisan db:seed"
   ```

The application will be available at:

- Frontend: [http://localhost:3000](http://localhost:3000)
- Backend API: [http://localhost:8083](http://localhost:8083)

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
