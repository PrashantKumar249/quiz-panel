<<<<<<< HEAD
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
=======
# Online Quiz & Exam Management System

A role-based quiz and exam platform built with Laravel. Supports full
quiz lifecycle management for admins and a clean attempt-and-review
experience for students — including a timed engine that auto-submits
at the server level.

## Roles

### Admin
- Create, edit, and delete quizzes and their questions
- Manage registered users — view details, block or unblock accounts
- Track all quiz attempts across users, filter results by quiz,
  and drill into individual attempt details

### Student
- Browse available quizzes from a personal dashboard
- Attempt quizzes with a live countdown timer
- Get instant results immediately after submission
- Review past attempts and historical scores

## Tech Stack

**Backend**
- PHP 8.3+ / Laravel
- Laravel Breeze — authentication scaffolding
- MySQL via Eloquent ORM
- PHPUnit / Pest — backend testing

**Frontend**
- Blade — server-side templating
- Tailwind CSS — utility-first styling
- Alpine.js — lightweight interactivity (timer, modals, dropdowns)
- Axios — async requests for quiz submission without page reload

## Local Setup

1. Clone the repository
```bash
   git clone https://github.com/PrashantKumar249/Quiz_panel.git
>>>>>>> d5df3a89774cbf30e0d1a67accec8845dc56ce28
```
2. Install PHP dependencies
```bash
   composer install
```
3. Install frontend dependencies
```bash
   npm install && npm run build
```
4. Copy and configure environment file
```bash
   cp .env.example .env
   php artisan key:generate
```
5. Update `.env` with your database credentials, then run migrations
```bash
   php artisan migrate
```
6. Start the development server
```bash
   php artisan serve
```
7. Open your browser at `http://localhost:8000`

<<<<<<< HEAD
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
=======
## Key Design Decisions

- **Server-side timer enforcement:** Auto-submission on timeout is
  handled at the server level, not just the frontend — so students
  cannot bypass the timer by staying on the page or manipulating
  the browser.
- **Alpine.js over Vue/React:** Kept the frontend lightweight since
  the interactivity requirements didn't justify a full JS framework.

## What I learned building this

This was my first Laravel project using Breeze for auth scaffolding.
The interesting problem was the timer — a frontend countdown is easy,
but making sure the server rejects late submissions regardless of
client state required thinking about the flow differently. That
server-side enforcement is the part I'm most satisfied with.
>>>>>>> d5df3a89774cbf30e0d1a67accec8845dc56ce28
