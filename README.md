# 🚀 Laravel Tailwind Starter Kit

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

**Package starter-kit Laravel berbasis Tailwind CSS untuk membuat layout dashboard profesional dengan komponen UI lengkap, DataTables, modal actions, icon library, SweetAlert2, dan dokumentasi interaktif.**

[Features](#-features) • [Installation](#-installation) • [Usage](#-usage) • [Documentation](#-documentation) • [Contributing](#-contributing)

</div>

---

## ✨ Features

### 🎨 **Modern UI Components**
- ✅ **Dashboard Layout** - Responsive sidebar, navbar, dan footer
- ✅ **User Management** - CRUD lengkap dengan DataTables
- ✅ **Modal System** - Create, Edit, Delete, Reset Password
- ✅ **Alert Components** - Success, Warning, Danger, Info
- ✅ **Stat Cards** - Dashboard statistics cards
- ✅ **Form Components** - Input, Select, Checkbox, Radio
- ✅ **Badges & Labels** - Status indicators dengan berbagai style
- ✅ **Buttons** - Primary, Outline, Icon, Loading states
- ✅ **Typography** - Heading hierarchy dan text utilities

### 🛠️ **Developer Tools**
- ✅ **Lucide Icons** - 1000+ beautiful icons
- ✅ **DataTables** - Sorting, searching, pagination
- ✅ **SweetAlert2** - Beautiful alerts dan confirmations
- ✅ **Interactive Documentation** - Live examples dan code snippets
- ✅ **Route Management** - Auto-configured routes

### 📱 **Responsive Design**
- ✅ Mobile-first approach
- ✅ Tablet optimized
- ✅ Desktop enhanced
- ✅ Touch-friendly interactions

---

## 📦 Installation

### Requirements

- PHP 8.2 or higher
- Laravel 11.x
- Composer
- Node.js & NPM (for Tailwind CSS)

### Step 1: Install Package

#### Via Composer (Local Development)

```bash
# Add local repository
composer config repositories.laravel-starter-kit path "../laravel-starter-kit"

# Install package
composer require mwy/laravel-starter-kit:@dev
```

#### Via Composer (Production)

```bash
composer require mwy/laravel-starter-kit
```

### Step 2: Run Installer

```bash
# Recommended command
php artisan starter-kit:install

# Alternative (backward compatibility)
php artisan stater-kit:install

# With options
php artisan starter-kit:install --force
php artisan starter-kit:install --without-route
php artisan starter-kit:install --stack=tailwind
```

#### Installation Options

| Option | Description |
|--------|-------------|
| `--force` | Overwrite existing files |
| `--without-route` | Skip route registration |
| `--stack=tailwind` | Specify UI stack (only tailwind supported) |

### Step 3: Setup Database

```bash
# Run migrations
php artisan migrate
```

### Step 4: Compile Assets

```bash
# Install dependencies
npm install

# Build for development
npm run dev

# Build for production
npm run build
```

---

## 🎯 Usage

### Access Pages

After installation, you can access:

- **Users Management**: `http://your-app.test/users`
- **Documentation**: `http://your-app.test/documentation`

### Installed Files

The installer focuses on starter-kit UI files only:

- `app/Http/Controllers/UserController.php`
- `resources/views/layouts/tailwind/**`
- `resources/views/users/index.blade.php`
- `resources/views/documentation/index.blade.php`
- Starter Kit routes appended to `routes/web.php`

No package configuration file is copied or merged during installation.

### User Management Features

The `/users` page includes:

- ✅ **Create User** - Add new users with email verification
- ✅ **Edit User** - Update user information
- ✅ **Reset Password** - Reset user passwords
- ✅ **Delete User** - Remove users from database
- ✅ **Bulk Actions** - Reset all data
- ✅ **DataTables** - Search, sort, and paginate
- ✅ **Statistics** - Total users, verified, recent

### Using Components

#### Alert Component

```blade
@include('layouts.tailwind.components.alert', [
    'type' => 'success',
    'title' => 'Success!',
    'content' => 'Your data has been saved.'
])
```

#### Stat Card Component

```blade
@include('layouts.tailwind.components.stat-card', [
    'label' => 'Total Users',
    'value' => $totalUsers,
    'icon' => 'users'
])
```

#### Modal System

```blade
<button onclick="window.StarterKit.openModal('myModal')">
    Open Modal
</button>

<div id="myModal" data-starter-modal>
    <!-- Modal content -->
</div>
```

#### SweetAlert2

```javascript
// Toast notification
window.StarterKit.toast('Success', 'Data saved successfully');

// Confirmation dialog
Swal.fire({
    icon: 'warning',
    title: 'Are you sure?',
    text: 'This action cannot be undone',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!'
});
```

---

## 📁 Package Structure

```text
laravel-starter-kit/
├── database/
│   └── seeders/
│       └── UserSeeder.php           # Optional sample user seeder
├── resources/
│   ├── stubs/
│   │   └── app/
│   │       └── Http/
│   │           └── Controllers/
│   │               └── UserController.php
│   └── views/
│       └── tailwind/
│           ├── documentation/
│           │   └── index.blade.php  # Interactive documentation
│           ├── layouts/
│           │   └── tailwind/
│           │       ├── app.blade.php
│           │       ├── components/
│           │       │   ├── alert.blade.php
│           │       │   └── stat-card.blade.php
│           │       └── partials/
│           │           ├── footer.blade.php
│           │           ├── navbar.blade.php
│           │           ├── sidebar.blade.php
│           │           ├── scripts.blade.php
│           │           └── styles.blade.php
│           └── users/
│               └── index.blade.php  # User management page
├── src/
│   ├── Console/
│   │   ├── InstallCommand.php       # Main install command
│   │   └── StaterKitInstallCommand.php
│   ├── Providers/
│   │   └── LaravelStarterKitServiceProvider.php
│   ├── Services/
│   │   └── StarterKitInstaller.php  # Installation service
│   ├── Support/
│   │   ├── LegacyAliases.php        # Backward compatibility aliases
│   │   └── Stack.php                # Stack management
│   ├── Traits/
│   │   └── InstallsFiles.php        # File installation utilities
├── composer.json
└── README.md
```

---

## 📚 Documentation

### Interactive Documentation

Visit `/documentation` after installation to see:

- 🎨 **22 Component Sections** - Complete UI component library
- 💡 **Live Examples** - Interactive component demonstrations
- 📝 **Code Snippets** - Copy-paste ready code
- 🎯 **Best Practices** - Usage guidelines and tips

### Component Categories

1. **Overview** - Package introduction
2. **Icons** - Lucide icon library (28+ icons)
3. **Colors** - Color palette and usage
4. **Typography** - Text styles and hierarchy
5. **Buttons** - Button variations and states
6. **Badges** - Status badges and labels
7. **Alerts** - Alert components
8. **Cards** - Stat cards and containers
9. **Modal** - Modal system
10. **Table** - Static tables
11. **DataTables** - Interactive tables
12. **Forms** - Form components
13. **Form Validation** - Validation patterns
14. **SweetAlert2** - Alert library
15. **Loading States** - Loading indicators
16. **Avatars** - User avatars
17. **Breadcrumbs** - Navigation breadcrumbs
18. **Pagination** - Pagination components
19. **Tabs** - Tab navigation
20. **Tooltips** - Tooltip system
21. **Progress Bars** - Progress indicators
22. **Routes** - Route configuration

---

## 🔧 Optional Publishing

### Publish Views

```bash
php artisan vendor:publish --tag=laravel-starter-kit-views
```

### Publish Controller Stub

```bash
php artisan vendor:publish --tag=laravel-starter-kit-stubs
```

### Publish Seeders

```bash
php artisan vendor:publish --tag=laravel-starter-kit-seeders
```

---

## 🎨 Customization

### Extending Layouts

Create your own layout extending the base:

```blade
@extends('layouts.tailwind.app')

@section('title', 'My Custom Page')

@section('content')
    <!-- Your content here -->
@endsection
```

### Custom Components

Add your components in `resources/views/components/`:

```blade
<!-- resources/views/components/my-component.blade.php -->
<div class="my-custom-component">
    {{ $slot }}
</div>
```

### Styling

Customize Tailwind configuration in `tailwind.config.js`:

```javascript
module.exports = {
    theme: {
        extend: {
            colors: {
                primary: '#your-color',
            },
        },
    },
};
```

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Coding Standards

- Follow PSR-12 coding standards
- Add PHPDoc blocks for all methods
- Write descriptive commit messages
- Add tests for new features

---

## 📝 License

This package is open-sourced software licensed under the [MIT license](LICENSE).

---

## 👨‍💻 Author

**Winnicode**

- GitHub: [@winnicode](https://github.com/winnicode)
- Email: support@winnicode.com

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS framework
- [Lucide Icons](https://lucide.dev) - Beautiful icon library
- [DataTables](https://datatables.net) - Table plugin
- [SweetAlert2](https://sweetalert2.github.io) - Beautiful alerts

---

## 📞 Support

If you encounter any issues or have questions:

- 📧 Email: support@winnicode.com
- 🐛 Issues: [GitHub Issues](https://github.com/winnicode/laravel-starter-kit/issues)
- 📖 Documentation: `/documentation` page after installation

---

<div align="center">

**Made with ❤️ by Winnicode**

⭐ Star this repository if you find it helpful!

</div>
