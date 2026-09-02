# 🎓 Campus Lost & Found Portal

<p align="center">
  <strong>A modern, secure, and responsive Lost & Found management platform for university campuses.</strong>
</p>

<p align="center">
  <a href="https://campus-lost-found-portal-production.up.railway.app/">🌐 Live Demo</a>
  •
  <a href="https://github.com/monami2005/campus-lost-found-portal">📂 GitHub Repository</a>
</p>

---

## 📌 About the Project

**Campus Lost & Found Portal** is a full-stack web application designed to simplify the process of reporting, searching, claiming, and managing lost and found items within a university campus.

The platform provides a centralized system where students can report lost or found belongings, search through available listings, submit claims, and receive notifications, while administrators can efficiently manage users, items, claims, and platform activity.

---

## ✨ Key Features

### 👤 Authentication & User Management

* Secure user registration and login
* Password reset functionality
* Email verification
* Profile management
* Password change functionality
* Role-based access control

### 🔎 Lost & Found Management

* Report lost items
* Report found items
* Create, edit, view, and delete listings
* Search items quickly
* Filter by category, location, and status
* Pagination for item listings
* Item image uploads with previews

### 🤝 Claim Management

* Submit claims for found items
* Manage claim requests
* Admin-controlled claim verification
* Claim status management

### 📊 Admin Dashboard

* Overview of platform activity
* Dashboard analytics
* User management
* Item management
* Claim management
* Interactive charts using Chart.js

### 🔔 Additional Features

* Notifications
* FAQ section
* Contact form
* Responsive design
* Interactive UI components
* Confirmation alerts
* Image preview and placeholder handling

---

## 🛠️ Tech Stack

| Technology         | Purpose                 |
| ------------------ | ----------------------- |
| **Laravel 12**     | Backend framework       |
| **PHP 8.3+**       | Server-side programming |
| **Blade**          | Frontend templating     |
| **Bootstrap 5.3**  | Responsive UI           |
| **JavaScript**     | Frontend interactions   |
| **SQLite / MySQL** | Database                |
| **Font Awesome**   | Icons                   |
| **SweetAlert2**    | Alerts & notifications  |
| **AOS**            | Scroll animations       |
| **Chart.js**       | Dashboard analytics     |
| **Git & GitHub**   | Version control         |
| **Railway**        | Deployment              |

---

## 🏗️ Application Architecture

The application follows the **Laravel MVC architecture**:

```text
User
 │
 ▼
Routes
 │
 ▼
Controllers
 │
 ├── Authentication
 ├── Item Management
 ├── Claims
 ├── Notifications
 └── Admin Management
 │
 ▼
Models & Policies
 │
 ▼
Database
```

---

## 📂 Project Structure

```text
Campus-Lost-Found-Portal/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   └── Policies/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│   ├── css/
│   ├── js/
│   └── storage/
│
├── resources/
│   └── views/
│       ├── auth/
│       ├── admin/
│       ├── items/
│       └── layouts/
│
├── routes/
│   └── web.php
│
├── storage/
│
├── Dockerfile
├── railway.toml
├── composer.json
└── README.md
```

---

## 🚀 Getting Started

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/monami2005/campus-lost-found-portal.git
cd campus-lost-found-portal
```

### 2️⃣ Install Dependencies

```bash
composer install
```

### 3️⃣ Configure Environment

Create your environment file:

```bash
cp .env.example .env
```

For Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

### 4️⃣ Generate Application Key

```bash
php artisan key:generate
```

### 5️⃣ Configure Database

Configure your database settings inside `.env`.

For a simple local setup, SQLite can be used.

```bash
php artisan migrate --seed
```

### 6️⃣ Create Storage Link

```bash
php artisan storage:link
```

### 7️⃣ Start the Application

```bash
php artisan serve
```

The application will be available at:

```text
http://127.0.0.1:8000
```

---

## 🌐 Live Demo

🚀 **Try the deployed application:**

**https://campus-lost-found-portal-production.up.railway.app/**

The application is deployed using **Railway** and configured for production deployment.

---

## 🔐 Security

The application includes several security mechanisms provided through Laravel:

* Authentication & authorization
* CSRF protection
* Password hashing
* Role-based permissions
* Policy-based access control
* Form validation
* Protected routes
* Secure session handling

---

## 📱 Responsive Design

The interface is designed to work across:

* 💻 Desktop
* 💻 Laptop
* 📱 Mobile
* 📟 Tablet

Bootstrap's responsive grid system is used to provide a consistent experience across different screen sizes.

---

## 📊 Admin Analytics

The admin dashboard provides visual insights into platform activity using **Chart.js**, helping administrators understand:

* Lost item reports
* Found item reports
* Item status
* Claim activity
* Overall platform usage

---

## 🧪 Database & Demo Data

The project includes Laravel migrations and seeders for quickly setting up the application with sample data.

Run:

```bash
php artisan migrate --seed
```

This creates the required database structure and populates the application with demo records.

---

## ☁️ Deployment

The project is configured for cloud deployment using:

* **Railway**
* **Docker**
* **PHP 8.3+**
* **Laravel production configuration**

Deployment-related files include:

```text
Dockerfile
railway.toml
docker-entrypoint.sh
```

---

## 🔮 Future Improvements

Possible future enhancements include:

* 📧 Email notifications
* 🔔 Real-time notifications
* 📍 Interactive campus map
* 🤖 AI-powered item matching
* 📷 Image-based item search
* 📱 Progressive Web App (PWA)
* 🔎 Advanced search recommendations
* 📈 More detailed analytics

---

## 👩‍💻 Author

**Monami Sadhu**

B.Tech Computer Science & Engineering Student

### Connect

* 💻 GitHub: [@monami2005](https://github.com/monami2005)

---

## 📄 License

This project is licensed under the **MIT License**.

---

<p align="center">
  ⭐ If you find this project useful, consider giving it a star!
</p>

<p align="center">
  Built with ❤️ using Laravel
</p>
