🎫 HelpDesk Support Ticket System (Laravel)

A complete HelpDesk Support Ticket System built with Laravel to manage support tickets between Users, Agents, and Admins — with departments, categories, canned responses, and reports through a powerful Admin Dashboard.

🚀 Features

Dashboard
* Role-based Dashboard (Admin / Agent / User)
* Ticket Statistics (Total, Open, In Progress, Resolved/Closed)
* Recent Tickets Overview

Ticket Management
* Create Ticket (User)
* Edit Ticket (User, while Open)
* Delete Ticket (User, while Open)
* View Ticket Details
* Reply / Conversation Thread on Ticket
* Update Ticket Status (Open → In Progress → Resolved → Closed)
* Assign Ticket to Agent (Admin)
* Filter Tickets by Status

User Management (Admin)
* Add User / Agent / Admin Account
* Edit User
* Delete User
* Role-based Access Control

Agent Management
* View All Agents
* Assigned Ticket Count per Agent

Department & Category Management
* Add / Edit / Delete Departments
* Add / Edit / Delete Categories
* Assign Department & Category to Tickets

Canned Responses
* Add / Edit / Delete Canned Responses
* Quick-Insert Canned Response into Ticket Reply

Reports
* Ticket Reports (Status, Priority, Department breakdown with charts)
* Agent Reports (Assigned, Resolved, Resolution Rate)

Account Settings
* Update Profile (Name, Email)
* Change Password

Authentication
* Secure Login
* Register (User)
* Role-based Access Control (Admin / Agent / User)
* Logout Functionality

🛠️ Tech Stack
* Laravel
* PHP
* MySQL
* Blade Template Engine
* Bootstrap
* Chart.js
* JavaScript
* Font Awesome

⚙️ Project Setup (After Downloading from GitHub)

Follow these steps in order after downloading or cloning the project.

✅ Step 1 — Open Project in VS Code
Open the project folder and open the terminal inside it.

✅ Step 2 — Create `.env` File
Run:
```
cp .env.example .env
```

✅ Step 3 — Install Vendor Packages
```
composer install --ignore-platform-reqs
```

✅ Step 4 — Generate Application Key
```
php artisan key:generate
```

✅ Step 5 — Configure Database
Open the `.env` file and update the following values:
```
APP_NAME="HelpDesk"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=helpdesk
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=database
```

✅ Step 6 — Run Migrations and Seed Demo Data
```
php artisan migrate:fresh --seed
```

✅ Step 7 — Start Laravel Development Server
```
php artisan serve
```

✅ Step 8 — Open in Browser
```
http://127.0.0.1:8000
```

🔐 Default Login Credentials (Demo)

Use the following credentials after running the seeders:

Admin
```
Email: admin@gmail.com
Password: password
```

Agent
```
Email: agent@gmail.com
Password: password
```

User
```
Email: user@gmail.com
Password: password
```

📂 Project Modules
* Dashboard
* Tickets (Create, Edit, Delete, View, Reply, Status, Assign)
* Users
* Agents
* Departments
* Categories
* Canned Responses
* Ticket Reports
* Agent Reports
* Settings
* Authentication

👥 Roles Overview

Admin
* Full access to all modules
* Manage Users, Agents, Departments, Categories, Canned Responses
* Assign tickets to agents
* View Ticket & Agent Reports

Agent
* View and manage tickets assigned to them
* Update ticket status
* Reply to tickets using canned responses

User
* Create support tickets
* Edit / Delete own tickets (while Open)
* Track ticket status and replies

👨‍💻 Author
Faijan Shaikh

📌 Note
This project was developed for learning and portfolio purposes using Laravel.
If you encounter any issues during installation or setup, please create an issue in the repository or contact me. I will do my best to help.
