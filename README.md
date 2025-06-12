# Cabin Booking System - Full Stack Application

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?logo=laravel)](https://laravel.com)
[![React](https://img.shields.io/badge/React-18.x-61DAFB?logo=react)](https://reactjs.org)
[![Sanctum](https://img.shields.io/badge/Laravel_Sanctum-3.x-FF2D20)](https://laravel.com/docs/sanctum)
[![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

A complete cabin booking system with secure multi-role authentication and admin management tools.

## ✨ Features

### 🔐 Authentication System
- **Multi-role authentication** (Admin/Guest) using Laravel Sanctum
- **Secure token-based authentication flow**
- **Role verification middleware** for protected routes
- **Session management** for different user types

### 🏡 Cabin Management
- **Full CRUD operations** for cabins
- **Advanced booking system** with availability checks
- **Image upload** and management

### 👨‍💻 Admin Dashboard
- **Comprehensive admin tools** for system management
- **User profile management**
- **System configuration settings**
- **Booking oversight** and modification capabilities

### ⚙️ Technical Implementation
- **RESTful API** with Laravel backend
- **Seamless React frontend integration**
- **Optimized database queries** with Eloquent
- **Scalable architecture** with clean code practices

## 🚀 Installation

### Backend Setup
```bash
# Clone repository
git clone https://github.com/yourusername/cabin-booking.git

# Install PHP dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Install Sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

# Run migrations
php artisan migrate --seed
