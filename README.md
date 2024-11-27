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

4. Set up these AWS database credentials in `.env`, the database is already hosted on AWS EC2, no need to create on local:

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

6. Since the database is already set up on AWS, you can skip migrations.

7. Start the application

```bash
# In one terminal
php artisan serve

# In another terminal
npm run dev
```

8. Visit http://127.0.0.1:8000 in your browser

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

## Troubleshooting

### Database Connection Issues

-   Ensure AWS security group allows connections from your IP
-   Verify the database credentials in `.env`
-   Check if you can connect using a MySQL client:

```bash
mysql -h 52.87.148.108 -u root -p
```

### Common Issues

1. "Unable to connect to database"

    - Check if AWS RDS instance is running
    - Verify network/firewall settings
    - Try connecting with a MySQL client

2. "CSRF token mismatch"
    - Clear browser cache
    - Refresh the page

## Need Help?

Check Laravel logs for errors:

```bash
tail -f storage/logs/laravel.log
```

## License

MIT License
