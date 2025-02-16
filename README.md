# Sales Analytics

This repository contains a **Sales Analytics** application that helps you analyze sales data. It uses SQLite for the database, PHP for the backend, and a simple web interface for visualization.

---

## Manual Implementation Details

The following parts of the project were implemented manually, ensuring custom logic, scalability, and maintainability:

### 1. **WebSocket Logic and Functionality**
   - **Real-Time Communication**: Implemented WebSocket functionality to enable real-time data updates and bidirectional communication between the client and server.
   - **Event Handling**: Custom logic for handling WebSocket events, such as connection establishment, message broadcasting, and disconnection.
   - **Scalability**: Designed the WebSocket server to handle multiple concurrent connections efficiently, with proper error handling and connection management.

### 2. **API Endpoints and Routing Logic**
   - **RESTful API Design**: Created structured and intuitive API endpoints following REST principles for seamless integration with the frontend and third-party services.
   - **Route Definitions**: Manually defined routes for CRUD operations, ensuring proper HTTP methods (GET, POST, PUT, DELETE) are used.
   - **Middleware Integration**: Implemented custom middleware for authentication, request validation, and logging to enhance security and reliability.

### 3. **Database Queries and Joins**
   - **Complex Queries**: Wrote optimized SQL queries for fetching, filtering, and aggregating data, ensuring high performance even with large datasets.
   - **Database Relationships**: Established and utilized relationships (e.g., one-to-many, many-to-many) to structure data effectively.
   - **Joins and Indexing**: Implemented advanced joins (e.g., inner, left, right) and applied indexing strategies to improve query performance.
   - **Data Integrity**: Ensured data consistency and integrity through constraints, transactions, and proper error handling.

### 4. **AI Integrations and Response Handling**
   - **AI Model Integration**: Integrated third-party AI APIs (e.g., OpenAI, TensorFlow) for features like recommendations, predictions, and natural language processing.
   - **Custom Response Parsing**: Developed logic to parse and process AI-generated responses, ensuring compatibility with the application’s data format.
   - **Error Handling**: Implemented robust error handling for AI API failures, including retry mechanisms and fallback responses.
   - **Data Privacy**: Ensured secure handling of sensitive data sent to and received from AI services, adhering to privacy regulations.

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

## How to Use It

You can test api by this commend:

```bash
php backend/vendor/bin/phpunit backend/Tests
```
