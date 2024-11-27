# Laravel Task Manager

A modern task management system using Laravel with server-side rendering and AJAX for dynamic updates. Features drag-and-drop functionality and project organization without any frontend build requirements.

## Setup with AWS Database

1. Clone the repository

```bash
git clone https://github.com/yourusername/task-manager.git
cd task-manager
```

2. Install PHP dependencies

```bash
composer install
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
php artisan serve
```

7. Visit http://127.0.0.1:8000 in your browser

## Technical Architecture

This application uses:

-   Server-side rendering with Laravel Blade templates
-   AJAX for dynamic updates without page reloads
-   jQuery for handling AJAX requests
-   SortableJS for drag-and-drop functionality
-   No frontend build process required

All interactions (create, update, delete, reorder) happen through AJAX calls, providing a smooth user experience while maintaining the simplicity of server-side rendering.

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
-   Real-time updates via AJAX
-   Project filtering
-   No page reloads required for any operation

## Usage

### Managing Tasks

1. **Add Task**

    - Enter task name
    - Select project (optional)
    - Click "Add Task"
    - Task appears instantly via AJAX

2. **Edit Task**

    - Click "Edit" on any task
    - Update details in the popup
    - Click "Save"
    - Changes update instantly

3. **Delete Task**

    - Click "Delete" on any task
    - Task removes instantly

4. **Reorder Tasks**
    - Drag tasks using the ≡ handle
    - Priority updates automatically via AJAX

### Project Management

-   Use the project dropdown to filter tasks
-   Select "All Projects" to see everything
-   Filtering happens instantly without page reload

## License

MIT License
