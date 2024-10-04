# Virtual Classroom System a.k.a Classifinity

## Overview

This is a Laravel-based Virtual Classroom system that allows teachers and students to interact in a learning environment with features like quizzes, assignments, study materials, and profile management, plus live classes and notification system . The system provides role-based access control for students, teachers, and admins.

## Features

- **User Registration and Login:**
  - OTP system to filter valid email during registration.
  
- **Roles:**
  - Admin, Teachers, and Students with different access levels.
  
- **Assignments:**
  - Teachers can create and manage assignments.
  - Students can submit assignments, and teachers can grade them.

- **Quizzes:**
  - Teachers can create, edit, and manage quizzes.
  - Students can take quizzes, view scores, and review their performance.
  
- **Study Materials:**
  - Teachers can upload study materials associated with specific subjects.
  - Students can view study materials for their courses.
  
- **Profile Management:**
  - Teachers and students can manage their profiles.
  - Admin can give access to the teachers and students.
  
- **Notifications:**
  - Real-time notifications for new assignments, quizzes, and announcements.
  
- **Security:**
  - Role-based access control to prevent unauthorized access.
  - All sensitive routes are protected by middleware.
  
- **Zoom API:**
  - Live classes through the Zoom API for online learning sessions.
  
## System Requirements

- PHP 8.x or higher
- Composer
- Laravel 8.x or higher
- MySQL/MariaDB
- Node.js (for frontend dependencies)
- Apache/Nginx

## Installation

1. **Download the repository:**
   ```bash
   And run the project folder "virtual_classroom" in preferred IDE. (VS Code recommended)
   ```

2. **Install dependencies:**
   - Run the following commands to install PHP dependencies:
     ```bash
     composer install
     ```
   - Install Node.js dependencies:
     ```bash
     npm install && npm run dev
     ```

3. **Environment setup:**
   - Copy `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update the database credentials in `.env`:
     ```bash
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_user
     DB_PASSWORD=your_database_password
     ```

    - **Mailer Setup:**
     - Update the mailer configuration in the `.env` file to ensure email functionality for notifications, password resets, and OTPs:
       ```bash
       MAIL_MAILER=smtp
       MAIL_HOST=smtp.gmail.com 
       MAIL_PORT=587            
       MAIL_USERNAME=zawlinnhtet5858@gmail.com (Can change your email)
       MAIL_PASSWORD=gjwfrertivlcocsa (Can change the password of your email)
       MAIL_ENCRYPTION=tls         
       MAIL_FROM_ADDRESS=noreply@classifinity.com
       MAIL_FROM_NAME="Classifinity"
       ```
      - For Gmail, make sure to enable "Less secure apps" or use an App Password if 2-step verification is enabled.

   - **Zoom API Setup:**
     - If you're integrating Zoom for live classes, you need to provide your Zoom API credentials in the `.env` file:
       ```bash
       ZOOM_CLIENT_ID=your_zoom_client_id
       ZOOM_CLIENT_SECRET=your_zoom_client_secret
       ZOOM_REDIRECT_URI=https://yourapp.com/zoom/callback
       ```
     - These credentials can be obtained by creating an app in the [Zoom Marketplace](https://marketplace.zoom.us/).

4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

5. **Run migrations and seeders:**
   ```bash
   php artisan migrate --seed
   ```

6. **Setup storage:**
   ```bash
   php artisan storage:link
   ```

7. **Run the application:**
   ```bash
   php artisan serve
   ```

## Usage

- Access the application at `http://localhost:8000`.
- Register some teachers and students.
- Login as an admin(the username that was seeded) and add those teachers or students to the lists in the system.