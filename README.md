# Laravel Task Manager

A modern task management system with drag-and-drop functionality and project organization.

## Setup with AWS Database

1. Clone the repository

```bash
git clone https://github.com/yourusername/task-manager.git
cd task-manager
```

2. Install dependencies

```bash
composer install
npm install
```

3. Configure environment

```bash
cp .env.example .env
```

4. Set up your AWS database credentials in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=52.87.148.108
DB_PORT=3306
DB_DATABASE=taskManager
DB_USERNAME=root
DB_PASSWORD=Chhibba/123456
```

5. Generate application key

```bash
php artisan key:generate
```

6. Start the application

```bash
# In one terminal
php artisan serve

# In another terminal
npm run dev
```

7. Visit http://127.0.0.1:8000 in your browser

## Database Visualization

You can view and interact with the database using any MySQL database viewer (like DBeaver):

1. Open DBeaver or your preferred MySQL viewer
2. Create a new MySQL connection with these credentials:
    - Host: 52.87.148.108
    - Port: 3306
    - Database: taskManager
    - Username: root
    - Password: Chhibba/123456

This will allow you to:

-   View table structures
-   Execute SQL queries
-   Monitor database changes
-   View relationships between tables

## Features

-   Create, edit, and delete tasks
-   Organize tasks by projects
-   Drag-and-drop task reordering
-   Real-time updates (no page reloads)
-   Project filtering

## Usage

### Managing Tasks

1. **Add Task**

    - Enter task name
    - Select project (optional)
    - Click "Add Task"

2. **Edit Task**

    - Click "Edit" on any task
    - Update details in the popup
    - Click "Save"

3. **Delete Task**

    - Click "Delete" on any task

4. **Reorder Tasks**
    - Drag tasks using the ≡ handle
    - Priority updates automatically

### Project Management

-   Use the project dropdown to filter tasks
-   Select "All Projects" to see everything

## License

MIT License
