# FYP Management System (CodeIgniter 4)

This project is a Final Year Project (FYP) management system built with CodeIgniter 4, running on XAMPP for Windows.

## Features

- **User Authentication**
  - Login, registration, password management, and two-factor authentication for students and lecturers.
  - Role-based access (Student, Lecturer, Admin).

- **Dashboard**
  - Personalized dashboards for students and lecturers.
  - Internship week tracking and statistics.
  - Recent tasks and remarks overview.

- **Profile Management**
  - Edit and view user profiles.
  - Password strength validation.

- **Internship Details**
  - Students can submit and update internship details (dates, location, supervisor info).

- **Logbook**
  - Students can add, edit, and view daily/weekly internship tasks.
  - Lecturers can review and remark on logbook entries.
  - Paginated task lists.

- **Task Management**
  - Create, edit, and view tasks.
  - Lecturer remarks and feedback.

- **Audit Log**
  - Admins can view system audit logs.

- **Chat System**
  - Real-time messaging between students and lecturers.
  - Notification sound on new messages.

- **User Lists**
  - Admin views for student and lecturer lists.

- **Navigation & Layout**
  - Responsive navbar and template layout.
  - Role-based menu options.

- **Error Handling**
  - Custom error pages for CLI and HTML.

## Folder Structure

- `app/Views/`  
  Contains all view files, organized by feature:
  - `admin/` – Audit log, dashboard, user lists
  - `auth/` – Login, registration, password, 2FA
  - `chat/` – Chat interface and view
  - `dashboard/` – Student and lecturer dashboards, internship details
  - `Logbook/` – Logbook entry, view, lecturer review
  - `profile/` – Profile view and edit
  - `task/` – Task creation, editing, viewing
  - `layout/` – Navbar and template
  - `errors/` – Error pages

## Getting Started

1. **Install dependencies**
   ```sh
   composer install
   ```

2. **Set writable permissions**
   Ensure the `writable/` directory is writable.

3. **Configure your environment**
   Copy `.env.example` to `.env` and update settings.

4. **Run the development server**
   ```sh
   php spark serve
   ```

## Requirements

- PHP 8.x
- XAMPP (Apache, MySQL)
- Composer

## Documentation

Refer to the [CodeIgniter 4 User Guide](https://codeigniter4.github.io/CodeIgniter4/index.html) for framework details.

---

For more details, see the code in