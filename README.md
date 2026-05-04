# ITI Blog MVC

A modern, feature-rich blogging platform built with **Laravel 13**, **Vue.js**, and **Tailwind CSS**. This application demonstrates a complete MVC implementation with user authentication, post management, and commenting system.

## 🌟 Features

- **User Authentication**
    - Traditional email/password authentication
    - GitHub OAuth integration via Laravel Socialite
    - User profile management

- **Blog Management**
    - Create, read, update, and delete blog posts
    - Auto-generated URL slugs for SEO-friendly links
    - Image upload support for posts
    - Soft delete functionality for post recovery
    - UUID-based post identification

- **Comments System**
    - Add comments to blog posts
    - Edit and delete own comments
    - User-friendly comment interface

- **Modern Tech Stack**
    - Laravel 13 (latest PHP framework)
    - Tailwind CSS for styling
    - Vue.js for interactive components
    - Vite for fast development and building
    - Alpine.js for lightweight interactivity

## 🚀 Quick Start

### Prerequisites

- PHP 8.3 or higher
- Composer
- Node.js 16+ and npm
- Git

### Installation

1. **Clone the repository**

```bash
git clone https://github.com/ARabee3/ITIBlog-MVC.git
cd ITIBlog-MVC
```

2. **Install PHP dependencies**

```bash
composer install
```

3. **Install Node dependencies**

```bash
npm install
```

4. **Create environment file**

```bash
cp .env.example .env
```

5. **Generate application key**

```bash
php artisan key:generate
```

6. **Configure database**
    - Update `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env`
    - Default SQLite configuration is available out of the box

7. **Run database migrations**

```bash
php artisan migrate
```

8. **Seed the database (optional)**

```bash
php artisan db:seed
```

9. **Build frontend assets**

```bash
npm run build
```

### Development Server

Run both Laravel and Vite dev servers:

```bash
# Terminal 1: Start Laravel development server
php artisan serve

# Terminal 2: Start Vite dev server
npm run dev
```

The application will be available at `http://localhost:8000`

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/      # Request handlers
│   └── Requests/         # Form validation
├── Models/               # Eloquent models (User, Post, Comment)
└── Providers/            # Service providers

database/
├── migrations/           # Database schema
├── factories/            # Model factories for testing
└── seeders/              # Database seeders

resources/
├── css/                  # Tailwind CSS
├── js/                   # Vue components and app.js
└── views/                # Blade templates

routes/
├── web.php              # Web routes
├── auth.php             # Authentication routes
└── console.php          # Console commands

tests/                    # Pest tests
```

## 🔐 Authentication

### Email Authentication

- Register with email and password
- Login with credentials
- Email verification (configurable)

### GitHub Authentication

1. Register a GitHub OAuth application
2. Add `GITHUB_CLIENT_ID` and `GITHUB_CLIENT_SECRET` to `.env`
3. Users can login via "Login with GitHub"

```env
GITHUB_CLIENT_ID=your_github_client_id
GITHUB_CLIENT_SECRET=your_github_client_secret
```

## 📝 Database Schema

### Users Table

- id, name, email, password
- GitHub integration fields: `github_id`, `github_token`, `github_refresh_token`

### Posts Table

- uuid (primary key)
- title, slug, content
- image (optional)
- user_id (author)
- soft delete timestamps

### Comments Table

- uuid (primary key)
- content
- post_uuid, user_id
- timestamps

## 🧪 Testing

Run tests using Pest:

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/PostTest.php

# Generate coverage report
php artisan test --coverage
```

## 📦 Key Dependencies

| Package                    | Purpose                          |
| -------------------------- | -------------------------------- |
| `laravel/framework`        | Web framework                    |
| `laravel/socialite`        | OAuth authentication             |
| `spatie/laravel-sluggable` | Automatic slug generation        |
| `tailwindcss`              | Utility-first CSS                |
| `vue`                      | Progressive JavaScript framework |
| `vite`                     | Build tool                       |
| `pestphp/pest`             | Testing framework                |

## 🎨 Styling

This project uses **Tailwind CSS** for styling with pre-built components:

- Forms with Tailwind Forms plugin
- Responsive layouts
- Dark mode support ready

To customize Tailwind configuration, edit `tailwind.config.js`

## 🔧 Configuration

Key configuration files:

- `.env` - Environment variables
- `config/app.php` - Application settings
- `config/database.php` - Database configuration
- `config/auth.php` - Authentication settings

## 📚 API Endpoints

### Posts

- `GET /posts` - List all posts
- `GET /posts/{uuid}` - View post details
- `POST /posts` - Create new post (authenticated)
- `PUT /posts/{uuid}` - Update post (authenticated)
- `DELETE /posts/{uuid}` - Delete post (authenticated)
- `PATCH /posts/{uuid}/restore` - Restore soft-deleted post (authenticated)

### Comments

- `POST /posts/{post:uuid}/comments` - Add comment (authenticated)
- `PUT /comments/{uuid}` - Update comment (authenticated)
- `DELETE /comments/{uuid}` - Delete comment (authenticated)

### Authentication

- `GET /auth/github` - GitHub login redirect
- `GET /auth/github/callback` - GitHub callback handler

## 🚀 Deployment

1. Set up a production server with PHP 8.3+
2. Clone repository and install dependencies
3. Create `.env` file with production settings
4. Run migrations: `php artisan migrate --force`
5. Build assets: `npm run build`
6. Set up web server (Nginx/Apache) to point to `public/` directory
7. Configure caching and queue workers as needed

## 📖 Learning Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Guide](https://tailwindcss.com/docs)
- [Vue.js Documentation](https://vuejs.org/guide/)
- [Vite Guide](https://vitejs.dev/guide/)

## 📄 License

This project is open-source software licensed under the [MIT license](LICENSE).

## 👤 Author

Created as an ITI learning project demonstrating Laravel MVC architecture best practices.

## 🤝 Contributing

Contributions are welcome! Feel free to:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📞 Support

For issues and questions, please open an issue on GitHub.

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
