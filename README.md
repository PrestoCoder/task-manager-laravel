# Laravel Task Manager

A modern task management application built with Laravel, featuring drag-and-drop reordering, project organization, and AJAX interactions.

![Task Manager Screenshot](screenshot.png)

## Features

-   ✨ Create, edit, and delete tasks
-   🔄 Drag-and-drop task reordering
-   📁 Project organization
-   ⚡ AJAX operations (no page reloads)
-   🎨 Clean, responsive UI with Tailwind CSS
-   🏷️ Task prioritization
-   📱 Mobile-friendly design

## Requirements

-   PHP >= 8.1
-   Composer
-   MySQL/MariaDB
-   Node.js & NPM
-   Git

## Installation

1. Clone the repository

```bash
git clone https://github.com/yourusername/task-manager.git
cd task-manager
```

2. Install PHP dependencies

```bash
composer install
```

3. Install NPM dependencies

```bash
npm install
```

4. Create and configure environment file

```bash
cp .env.example .env
```

5. Configure your database in `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Generate application key

```bash
php artisan key:generate
```

7. Create the database

```sql
mysql -u root -p
CREATE DATABASE task_manager;
```

8. Run migrations

```bash
php artisan migrate
```

9. Seed sample projects (optional)

```bash
php artisan tinker
>>> App\Models\Project::create(['name' => 'Personal']);
>>> App\Models\Project::create(['name' => 'Work']);
```

## Running the Application

1. Start the Laravel development server

```bash
php artisan serve
```

2. In a separate terminal, start the Vite development server

```bash
npm run dev
```

3. Visit http://127.0.0.1:8000 in your browser

## Usage

### Managing Tasks

1. **Creating Tasks**

    - Enter task name in the input field
    - (Optional) Select a project from the dropdown
    - Click "Add Task"

2. **Editing Tasks**

    - Click the "Edit" button on any task
    - Modify the task details in the modal
    - Click "Save"

3. **Deleting Tasks**

    - Click the "Delete" button on any task
    - Confirm the deletion

4. **Reordering Tasks**
    - Drag and drop tasks using the ≡ handle
    - Priority updates automatically

### Project Management

1. **Filtering Tasks**
    - Select a project from the filter dropdown
    - View tasks specific to that project
    - Select "All Projects" to view everything

## Project Structure

```
task-manager/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── TaskController.php
│   └── Models/
│       ├── Task.php
│       └── Project.php
├── database/
│   └── migrations/
│       ├── create_projects_table.php
│       └── create_tasks_table.php
├── resources/
│   └── views/
│       └── tasks/
│           ├── index.blade.php
│           └── _list.blade.php
└── routes/
    └── web.php
```

## Key Technologies

-   [Laravel](https://laravel.com/) - PHP Framework
-   [MySQL](https://www.mysql.com/) - Database
-   [Tailwind CSS](https://tailwindcss.com/) - Styling
-   [SortableJS](https://sortablejs.github.io/Sortable/) - Drag and Drop
-   [jQuery](https://jquery.com/) - AJAX Operations

## Development

### Running Tests

```bash
php artisan test
```

### Code Style

```bash
# Fix code style
./vendor/bin/pint
```

### Development Server

```bash
php artisan serve
npm run dev
```

## Common Issues & Solutions

1. **CSRF Token Mismatch**

    - Ensure meta tag exists: `<meta name="csrf-token" content="{{ csrf_token() }}">`
    - Check jQuery AJAX setup has correct headers

2. **Database Connection**

    - Verify `.env` database credentials
    - Ensure database exists
    - Run `php artisan config:clear`

3. **Missing Views**
    - Check view files exist in correct locations
    - Run `php artisan view:clear`

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

-   [Laravel Documentation](https://laravel.com/docs)
-   [Tailwind CSS](https://tailwindcss.com/)
-   [SortableJS](https://sortablejs.github.io/Sortable/)

## Contact

Your Name - [@yourtwitter](https://twitter.com/yourtwitter)

Project Link: [https://github.com/yourusername/task-manager](https://github.com/yourusername/task-manager)
