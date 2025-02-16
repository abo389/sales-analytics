# Sales Analytics

This repository contains a **Sales Analytics** application that helps you analyze sales data. It uses SQLite for the database, PHP for the backend, and a simple web interface for visualization.

Based on the **Advanced Real-Time Sales Analytics System** task description, here’s the enhanced **Manual Implementation Details** section tailored to the requirements and your repository:

---

## Manual Implementation Details

The following parts of the project were implemented manually:

### 1. **API Endpoints for Orders and Analytics**
   - **POST /orders**: Implemented logic to add new orders to the database. Each order includes fields such as `product_id`, `quantity`, `price`, and `date`. Validation ensures all required fields are present and correctly formatted.
   - **GET /analytics**: Developed logic to provide real-time sales insights, including:
     - **Total Revenue**: Calculated by summing the revenue (`price * quantity`) of all orders.
     - **Top Products by Sales**: Identified by aggregating sales data and sorting by revenue or quantity.
     - **Revenue Changes in the Last 1 Minute**: Calculated by comparing the current revenue with the revenue from one minute ago.
     - **Count of Orders in the Last 1 Minute**: Determined by counting orders with timestamps within the last minute.

### 2. **Real-Time Reporting with WebSockets**
   - **WebSocket Server**: Implemented a WebSocket server to enable real-time communication between the backend and frontend.
   - **Real-Time Updates**: Logic was added to publish updates to connected clients whenever:
     - A new order is added (`POST /orders`).
     - Analytics data changes (e.g., revenue or order count updates).
   - **Frontend Subscription**: Developed logic for the frontend to subscribe to WebSocket channels for real-time updates.

### 3. **AI Integration for Recommendations**
   - **GET /recommendations**: Implemented an endpoint to send recent sales data to an AI system (e.g., ChatGPT or Gemini) and receive actionable recommendations.
     - **AI Prompt**: Example prompt: *"Given this sales data, which products should we promote for higher revenue?"*
     - **Response Handling**: Custom logic was added to parse and format AI-generated recommendations for the frontend.
   - **Dynamic Recommendations**: Integrated weather data (via OpenWeather API) to adjust recommendations based on weather conditions (e.g., promoting cold drinks on hot days or hot drinks on cold days).

### 4. **External API Integration**
   - **Weather API Integration**: Integrated the OpenWeather API to fetch real-time weather data and adjust product recommendations dynamically.
   - **Dynamic Pricing Logic**: Added logic to suggest pricing adjustments based on weather or seasonal trends.

### 5. **Database Queries and Logic**
   - **Manual Queries**: Wrote custom SQL queries for:
     - Fetching and aggregating sales data.
     - Calculating revenue, top products, and recent order counts.
   - **Database Structure**: Designed and implemented the database schema manually, including tables for `orders`, `products`, and `analytics`.
   - **Data Integrity**: Ensured data consistency through manual validation and error handling.

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
