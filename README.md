# SpendLog (Expense Tracker)

## Overview
SpendLog is a simple and efficient web application designed for tracking daily expenses and incomes. The application helps users manage their budget effectively by setting category-wise spending limits and visualizing financial data through charts.

## Features

- **Authentication**: Secure user authentication and authorization.
- **Dashboard**: Provides an overview of income, expenses, savings, and budget limits.
- **Expense Tracking**: Users can log their daily expenses categorized by type.
- **Income Tracking**: Users can record their sources of income.
- **Budget Limits**: Set spending limits on categories to track expenses efficiently.
- **Reports & Charts**:
  - Bar charts for financial overview.
- **Recent Transactions**: Displays the latest income and expense transactions with pagination.
- **Dark Mode Support**: UI adapts to user preferences.

## Technologies Used

- **Laravel 11**: PHP framework for backend and routing.
- **MySQL**: Database for storing user financial data.
- **Blade**: Laravel templating engine for dynamic UI rendering.
- **Tailwind CSS**: For modern and responsive frontend design.
- **ApexCharts**: Used for visualizing financial trends with interactive charts.
- **Vite**: For frontend asset compilation and performance optimization.
- **NGINX**: Web server for serving the Laravel application.
- **AWS EC2**: Cloud server for hosting the application.

## Usage

- **Users**:
  - Log daily income and expenses.
  - Set and track spending limits on different categories.
  - View financial reports and insights.
  - Get alerts for exceeded category limits.

## Deployment Guide

1. Clone the repository:
   ```sh
   git clone https://github.com/MihirLakhamje/SpendLog.git
   ```
2. Navigate to the project directory:
   ```sh
   cd SpendLog
   ```
3. Install dependencies:
   ```sh
   composer install
   npm install
   ```
4. Configure environment variables:
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```
5. Run migrations and seed the database:
   ```sh
   php artisan migrate --seed
   ```
6. Build frontend assets:
   ```sh
   npm run build
   ```
7. Start the application:
   ```sh
   php artisan serve
   ```

## Policies and Security

- Uses Laravel’s authentication and authorization mechanisms.
- Data encryption ensures secure storage of user information.

## Future Enhancements

- Export reports to CSV and PDF formats.

