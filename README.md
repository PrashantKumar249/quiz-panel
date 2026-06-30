# Quiz Panel

A comprehensive Quiz Management System built with Laravel. This application allows administrators to create and manage quizzes, and users to take quizzes, view their results, and track their quiz history.

## Tech Stack
- **Backend:** Laravel
- **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
- **Build Tool:** Vite

## Features

### Admin Features
- **Dashboard:** Overview of the system.
- **Quiz Management:** Create, edit, and delete quizzes.
- **Question Management:** Add, edit, and remove questions for specific quizzes.
- **User Management:** View registered users, check user details, and block/unblock users.
- **Results Management:** View results for all users, filter by quiz, and check specific attempt details.

### User Features
- **Authentication:** Secure login and registration.
- **Dashboard:** View available quizzes to take.
- **Quiz Attempt:** Interactive quiz interface with a timer.
- **Instant Results:** View score and result immediately after submission.
- **History:** Track past quiz attempts and scores.
- **Profile Management:** Update personal information.

## How to Setup and Run the Project

### Prerequisites (Things you need)
- **PHP >= 8.3**
- **Composer** (to install PHP packages)
- **Node.js & NPM** (to install frontend designs)
- **MySQL Database Server** (like Laragon or XAMPP)

---

### Step-by-Step Setup Guide

Open your terminal (CMD) inside the project folder and run these exact commands one by one:

#### 1. Copy the setup file
Run this command to create your configuration file:
```cmd
copy .env.example .env
```

#### 2. Create database and update `.env`
1. Open phpMyAdmin or Laragon database manager.
2. Create a new empty database named `quiz_panel`.
3. Open the `.env` file in a text editor (like Notepad or VS Code) and type your MySQL username and password:
   ```env
   DB_CONNECTION=mysql
   DB_DATABASE=quiz_panel
   DB_USERNAME=your_mysql_username
   DB_PASSWORD=your_mysql_password
   ```

#### 3. Install PHP packages
```cmd
composer install
```

#### 4. Create security key
```cmd
php artisan key:generate
```

#### 5. Create database tables and add sample data
```cmd
php artisan migrate --seed
```

#### 6. Install frontend packages and build designs
```cmd
npm install
npm run build
```

---

### How to Start the Project (Once Setup is Done)

Run these two commands in separate terminal windows to start the application:

1. **Start Laravel Server:**
   ```cmd
   php artisan serve
   ```
2. **Start Vite Server (for hot-reloading designs):**
   ```cmd
   npm run dev
   ```

*Open your web browser and go to `http://127.0.0.1:8000` to see the website.*




## Routes Overview
- `/` - Landing Page
- `/dashboard` - User Dashboard
- `/user/quiz/...` - Quiz attempt and submission flow
- `/admin/dashboard` - Admin Dashboard
- `/admin/quiz/...` - Admin Quiz Management
- `/admin/questions/...` - Admin Question Management

## License
This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
