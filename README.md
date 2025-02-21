# Gestion Bibliotheque
This project is aimed at creating a simple yet effective library management system with Laravel, where users can manage their library collection, browse books, check out books.
## ⚙️ Prerequisites

Before setting up the project, ensure you have the following installed:

🐘 PHP 8+

🛢 PostgreSQL

🖥 Composer

📦 Node.js & npm

🔧 Laravel Installer (optional but recommended)

🛠 Installation & Setup

Run the following commands to set up the project:

# Clone the repository
```
git clone https://github.com/Youcode-Classe-E-2024-2025/achraf_sikal-Gestion-Bibliotheque.git
cd achraf_sikal-Gestion-Bibliotheque

# Install dependencies
composer install
npm install

# Create environment file
cp .env .env

# Generate application key
php artisan key:generate

# Configure database in .env file, then run migrations
php artisan migrate --seed

# Start the development server
php artisan serve
```

🚀 Running the Project

Visit http://127.0.0.1:8000 in your browser.

To watch frontend assets during development, run:

```
npm run dev
```
# 📌 Project Work Report

## 📅 February 17, 2025
- 🚀 **Project Initialization:** Set up a Laravel project and configured TailwindCSS along with Vite for asset management.
- 🔑 **User Authentication:** Developed the sign-up, login, and logout functionality with proper validation.
- 🎨 **Frontend Setup:** Created the project landing page, navbar layout, and authentication-related views.
- 🗄 **Database Migration:** Created the initial `books` table migration.

## 📅 February 18, 2025
- 🖼 **User Profile Enhancements:** Added avatar upload functionality during user signup.
- 🔄 **Routing Improvements:** Passed data to the home view using Laravel’s `compact` method for efficient handling.

## 📅 February 19, 2025
- 👤 **Profile Page:** Completed the avatar upload feature and designed the user profile page.
- 📄 **Documentation:** Read the official Laravel documentation for more clarity and to get some context.

## 📅 February 20, 2025
- 📚 **Book Management System:** Developed CRUD operations for books, implemented the `BookController`, and created necessary table migrations.
- 🚀 **Feature Enhancements:** 
  - 📖 Designed and implemented the book details page.
  - ⭐ Completed the featured books section.
  - ✏️ Modified the book creation functionality.
  - 🔒 Restricted access to the "My Books" page.
  - 🌍 Designed and implemented the "Explore Books" page with pagination.
  - 🎨 Enhanced the book edit page UI and optimized frontend components.
  - 📂 Increased the maximum file size allowed for PDF uploads.

## 📅 February 21, 2025
- 📊 **Pagination & UI Improvements:** Adjusted pagination configurations and refined grid layouts for better display.
- 🔗 **Navigation & Borrowed Books Page:**
  - 📌 Created a dedicated page for borrowed books.
  - 🔄 Updated navigation links and dropdown menu for better accessibility.

## 📜 Summary
📌 Over the past few days, The primary focus was on authentication, book management, user profile customization. The implementation of pagination and optimized layouts with blade templating engine improved the overall user experience. The latest updates included a dedicated borrowed books page and refined navigation elements for smoother functionality.
