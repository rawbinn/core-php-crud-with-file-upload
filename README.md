# PHP Basic CRUD Project (Modular Structure + File Upload)

This is a beginner-friendly PHP project demonstrating **CRUD operations (Create, Read, Update, Delete)** using **core PHP without OOP**, following a **clean and modular folder structure**, and now with **image upload support**.

Perfect for students learning PHP, SQL, secure database interaction, and handling file uploads using **mysqli prepared statements**.

---

## Features

- Modular folder structure (separation of logic and views)
- Secure database interactions using prepared statements
- Basic authentication: login, register, logout
- Course & User CRUD (Create, Read, Update, Delete)
- **User profile image upload** with image preview
- Simple configuration management (`config/` folder)
- No frameworks or OOP — purely procedural PHP for learning

---

## Folder Structure
## Folder Structure
```
project/
├── config/ # Configuration files (e.g., database settings)
│ └── database.php
├── core/ # Core shared logic (e.g., DB connection)
│ ├── db.php
│ └── auth.php
├── courses/ # Course module
│ ├── index.php
│ ├── create.php
│ ├── edit.php
│ └── actions/
│   ├── store.php
│   ├── update.php
│   └── delete.php
├── users/ # User module (similar structure)
│ ├── index.php
│ ├── create.php
│ ├── edit.php
│ └── actions/
│   ├── store.php
│   ├── update.php
│   └── delete.php
├── auth/ # Auth system
│ ├── login.php
│ ├── register.php
│ └── logout.php
├── uploads/ # Uploaded files (e.g., profile images)
│ └── users/
├── helpers/ # Reusable functions (if needed)
│ ├── course.php
│ └── user.php
├── migrations
│ ├── create_users_table.sql
│ └── create_courses_table.sql
└── index.php # Dashboard or home page
```

## Setup Instructions

1. **Clone this repo**  
   ```bash
   git clone https://github.com/rawbinn/core-php-crud-with-file-upload.git
   ```
2. **Run migration sql**
   Import sql present inside migrations directory
3. Configure your database credentials
   Update config/database.php:

  ```
    return [
        'db_host' => 'localhost',
        'db_user' => 'root',
        'db_pass' => '',
        'db_name' => 'your_database_name'
    ];
  ```

4.  **Start a local PHP server (from project root):**
```
php -S localhost:8000
```
5. **Access in browser:**
http://localhost:8000


# Educational Goals
This project is meant to teach:

- How to build real-world CRUD with PHP & MySQL
- Using mysqli prepared statements for secure database access
- Input validation & session management
- Handling file uploads in PHP
- Clean project organization without frameworks or OOP

# Ideal For
- Computer science students
- Beginner web developers
- Teachers demonstrating PHP/MySQL fundamentals
