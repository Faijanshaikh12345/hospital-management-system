# 🏥 Hospital Management System (Laravel)

A complete Hospital Management System built with Laravel to manage doctors, patients, appointments, medical records, prescriptions, medicines, admissions, and billing — with role-based access control and reporting through a powerful Admin Dashboard.

## 🚀 Features

- Role-based Dashboard (Admin / Doctor / Receptionist / Nurse / Patient)
- Doctor, Patient & Department Management
- Appointment Booking & Management
- Medical Records with Attachments
- Prescription Management
- Medicine Inventory with Stock & Expiry Tracking
- Patient Admissions (Ward, Bed, Admit/Discharge)
- Billing & Invoicing with Auto-Calculated Totals
- Reports with Filters and Excel Export
- User Management with Role-based Access Control
- Account Settings (Profile & Password Update)
- Secure Authentication

## 🛠️ Tech Stack

- Laravel
- PHP
- MySQL
- Blade Template Engine
- Font Awesome

## ⚙️ Project Setup (After Downloading from GitHub)

Follow these steps in order after downloading or cloning the project.

**✅ Step 1 — Open Project in VS Code**
Open the project folder and open the terminal inside it.

**✅ Step 2 — Create `.env` File**

cp .env.example .env


**✅ Step 3 — Install Vendor Packages**

composer install --ignore-platform-reqs


**✅ Step 4 — Generate Application Key**

php artisan key:generate


**✅ Step 5 — Configure Database**
Open the `.env` file and update the following values:

APP_NAME="Hospital Management System"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hospital_management_system
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=database


**✅ Step 6 — Run Migrations and Seed Demo Data**

php artisan migrate:fresh --seed


**✅ Step 7 — Start Laravel Development Server**

php artisan serve


**✅ Step 8 — Open in Browser**

http://127.0.0.1:8000


## 🔐 Default Login Credentials (Demo)

**Admin**

Email: admin@gmail.com
Password: password


## 👨‍💻 Author
Faijan Shaikh

## 📌 Note
This project was developed for learning and portfolio purposes using Laravel. If you encounter any issues during installation or setup, please create an issue in the repository or contact me. I will do my best to help.