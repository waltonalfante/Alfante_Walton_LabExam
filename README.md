# University of Mindanao - Login System

A PHP-based authentication system for the University of Mindanao College of Computing Education.

## Features

- User Registration with validation
- User Login with password hashing
- Session management
- Dashboard after successful login
- Secure logout functionality
- Responsive design with UM branding

## Technologies Used

- PHP 8.x
- HTML5
- CSS3
- JSON (for user data storage)

## Setup Instructions

### Prerequisites

You need either:
- **XAMPP** (recommended) - [Download here](https://www.apachefriends.org/)
- **PHP 8.x or higher** - [Download here](https://windows.php.net/download/)

---

### Option 1: Using XAMPP (Recommended)

1. **Install XAMPP** if you haven't already

2. **Copy the project folder** to XAMPP's htdocs directory:
   ```
   C:\xampp\htdocs\Lab EXAm\
   ```

3. **Start Apache** from XAMPP Control Panel

4. **Open your browser** and navigate to:
   ```
   http://localhost/Lab%20EXAm/Register.php
   ```

---

### Option 2: Using PHP Built-in Server

1. **Extract the project** to any folder

2. **Open Command Prompt or PowerShell** in the project folder

3. **Run the PHP server**:
   ```bash
   php -S localhost:8000
   ```

4. **Open your browser** and navigate to:
   ```
   http://localhost:8000/Register.php
   ```

---

## How to Use

1. **Register a new account**:
   - Go to `Register.php`
   - Fill in all required fields
   - Click "Register"

2. **Login**:
   - Go to `login.php`
   - Enter your username and password
   - Click "Login"

3. **Dashboard**:
   - After successful login, you'll be redirected to the dashboard
   - View your account information

4. **Logout**:
   - Click the "Logout" button in the dashboard

---

## Project Structure

```
Lab EXAm/
│
├── Register.php         # User registration page
├── login.php           # User login page
├── dashboard.php       # User dashboard (after login)
├── logout.php          # Logout handler
├── users.json          # User data storage (auto-generated)
├── photos/
│   └── CCE LOGO.png    # UM College logo
└── README.md           # This file
```

---

## Features Details

### Registration
- First name validation
- Email validation
- Username uniqueness check
- Password hashing (for security)
- Minimum 6 characters password requirement

### Login
- Username/password verification
- Secure password comparison
- Session creation on successful login
- Redirect to dashboard

### Dashboard
- Display user information
- Protected route (requires login)
- Logout functionality

### Security
- Passwords are hashed using PHP's `password_hash()`
- Session-based authentication
- XSS protection with `htmlspecialchars()`

---

## Notes

- The `users.json` file will be created automatically on first registration
- Make sure the project folder has write permissions for `users.json`
- For XAMPP users: Ensure Apache is running on port 80

---

## Author

Created for University of Mindanao - College of Computing Education

---

## Support

If you encounter any issues:
1. Make sure PHP is installed and accessible
2. Check that the web server is running
3. Verify file permissions for writing `users.json`
4. Ensure the `photos/` folder contains the logo file

---

© 2025 University of Mindanao. All rights reserved.
