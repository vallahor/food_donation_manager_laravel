# Food Donation System Manager

This project is a basic implementation I developed while volunteering at a local church.  
It helps manage families, food packages, and items, and track deliveries.

## Capabilities

- **Add Families**  
- **Create Food Packages**  
- **Create Items** (food or hygiene products)  
- **Associate Food Packages with Items**  
- **Associate Families with Food Packages**, allowing you to track:
  - Delivery dates
  - Delivery status

## Tech Stack

- **Backend:** Laravel  
- **Frontend:** Vue.js with Inertia.js  
- **Database:** SQLite  

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/vallahor/food_donation_manager_laravel.git
cd food_donation_manager_laravel
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies

```bash
npm install
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Migrations

```bash
php artisan migrate
```

### 6. Serve the Application

```bash
composer run dev
```
