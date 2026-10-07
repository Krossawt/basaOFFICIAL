# BASA — Basically A School App

> A batteries-included academic ERP system designed to run the entire operations of a school or educational institution from a single platform.

BASA covers student and staff lifecycle, academics, finance, operations, communication, and analytics — everything a modern school needs without stitching together multiple disconnected tools.

---

## Vision

Schools should not need 10 different softwares to manage students, fees, attendance, exams, hostels, and parent communication.  
BASA aims to be the **single source of truth** — powerful for administrators, simple for teachers, and transparent for parents.

---

## TECH STACK

| Layer | Technology |
|---|---|
| Backend | Laravel 11 |
| Admin Panel | Filament 3 |
| Styling | Tailwind CSS |
| Database | Supabase (PostgreSQL) |
| File Storage | Supabase Storage |
| Queues & Scheduler | Laravel Queues + Scheduler |
| Auth & RBAC | Laravel + Spatie Laravel-Permission / Filament Shield |
| Frontend (Portals) | Livewire / Inertia.js + Tailwind |

---

## Core Modules

| # | Module | Description |
|---|---|---|
| 1 | Student Management | Complete student profiles, admissions, records |
| 2 | Staff Management | Teachers, non-teaching staff, roles & hierarchy |
| 3 | Class Management | Classes, sections, academic years |
| 4 | Subjects & Curriculums | Subjects, syllabus, curriculum mapping |
| 5 | Attendance Management | Daily attendance, reports, analytics |
| 6 | Exam Management | Exams, marks entry, report cards, grading |
| 7 | Fee & Finance | Fee structures, payments, invoices, expenses |
| 8 | Timetable Management | Class & teacher timetables |
| 9 | Communication Management | SMS, email, in-app notifications, announcements |
| 10 | Hostel & Transport | Hostel allocation, transport routes & tracking |
| 11 | RBAC | Fine-grained role-based access control |
| 12 | Library Management | Books, issue/return, fines |
| 13 | Alumni Management | Alumni database & engagement |
| 14 | Event Management | School events, calendars, registrations |
| 15 | Grievance & Complaint | Complaint tracking & resolution |
| 16 | Online Admissions | Public admission portal & application workflow |
| 17 | Discipline & Behavior | Incident tracking, behavior records |
| 18 | Extracurricular / Clubs | Clubs, activities, memberships |
| 19 | Homework / Assignments | Assignment creation, submission, grading |
| 20 | PTA Meetings | Parent-teacher meeting scheduling & notes |
| 21 | Inventory / Assets | Asset tracking, inventory management |
| 22 | Analytics Dashboard | Institutional insights & reports |
| 23 | Audit Trails | Complete activity logging |
| 24 | CRON Jobs | Scheduled tasks & background processing |

---

## Prerequisites

- PHP 8.2 or higher
- Composer 2.x
- Node.js 20+ and npm
- Git
- A Supabase account (free tier is fine to start)

---

## Local Development Setup

### 1. Clone the repository

```bash
git clone <repository-url> basa
cd basa
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install Node dependencies

```bash
npm install
```

### 4. Environment configuration

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure Supabase

Go to **Project Settings → Database** and copy the connection string. Update your `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=db.<your-project-ref>.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=<your-supabase-db-password>
```

**(Optional) Configure Supabase Storage:**

```env
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=<supabase-storage-access-key>
AWS_SECRET_ACCESS_KEY=<supabase-storage-secret-key>
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=<your-bucket>
AWS_ENDPOINT=https://<your-project-ref>.supabase.co/storage/v1/s3
AWS_USE_PATH_STYLE_ENDPOINT=true
```

### 6. Run migrations & seeders

```bash
php artisan migrate --seed
```

### 7. Create storage link

```bash
php artisan storage:link
```

### 8. Build frontend assets

```bash
npm run build
# or for development
npm run dev
```

### 9. Start the development server

```bash
php artisan serve
```

The application will be available at **http://localhost:8000**.

### 10. (Optional) Run queue worker & scheduler

In separate terminals:

```bash
php artisan queue:work
php artisan schedule:work
```

---

## Filament Admin Panel

Once the application is running, the Filament admin panel is available at:

**http://localhost:8000/admin**

Default credentials (after seeding) will be documented in the seeder or `.env.example`.

---

## Project Structure

```
basa/
├── app/
│   ├── Filament/          # Filament resources, pages, widgets
│   ├── Models/            # Eloquent models
│   ├── Modules/           # Domain modules (Student, Fee, etc.)
│   ├── Policies/          # Authorization policies
│   └── Services/          # Business logic services
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
├── routes/
└── ...
```

---

## Development Guidelines

- Follow Laravel & Filament best practices.
- Keep business logic in **Services** or **Actions**, not in Controllers/Resources.
- Use **Form Requests** for validation.
- Write **policies** for every sensitive model.
- Prefer Filament resources for admin CRUD.
- All significant actions must be **audit-logged**.
- Use Laravel's scheduler for recurring jobs instead of external cron where possible.

---

## Roadmap Status

This project is currently in the **foundation phase**.  
Core architecture, authentication, RBAC, and the first modules are being built.

---

## License

**Proprietary** — All rights reserved.

---

*BASA — Basically A School App. Built for schools that want one system that actually works.*
