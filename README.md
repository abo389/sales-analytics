# Sales Analytics

This repository contains a **Sales Analytics** application that helps you analyze sales data. It uses SQLite for the database, PHP for the backend, and a simple web interface for visualization.

---


## How to Use It

Follow these steps to set up and run the project locally.

### 1. Clone the Repository

First, clone the repository to your local machine:

```bash
git clone https://github.com/abo389/sales-analytics.git
cd sales-analytics
```

### 2. Set Up the Database

The project uses SQLite as the database. Run the following command to initialize the database using the provided `setup.sql` file:

```bash
sqlite3 backend/database/sales.db < backend/setup.sql
```

This will create the necessary tables and schema in the `sales.db` database.

### 3. Start the Backend Server

The backend is powered by PHP. Start the backend server by running:

```bash
php backend/socket.php
```

This will start the backend server, which handles data processing and analytics.

### 4. Start the Development Server

To view the application in your browser, start the PHP development server:

```bash
php -S localhost:8000 -t .
```

Once the server is running, open your browser and navigate to:

```
http://localhost:8000
```

### 5. Explore the Application

You can now explore the Sales Analytics application. The interface allows you to view and analyze sales data.

## How to Test It

You can test api by this commend:

```bash
php backend/vendor/bin/phpunit backend/Tests
```
