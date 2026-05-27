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
