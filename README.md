<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a>

</p>

<h4 align="center">📱 Contact & 👨 Social</h4>
<p align="center">
<!-- <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a> -->
<a href="mailto:anthonyobah37@gmail.com"><img src="https://img.shields.io/badge/Gmail-D14836?style=for-the-badge&logo=gmail&logoColor=white"></a>
<a href="https://github.com/obahchimaobi"><img src="https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white"></a>
<a href="https://linkedin.com/in/obahchimaobi"><img src="https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white"></a>
</p>

<h4 align="center">🚀 Skills</h4>
<p align="center">
<a href=""><img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white"></a>
<a href=""><img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white"></a>
<a href=""><img src="https://img.shields.io/badge/Sass-CC6699?style=for-the-badge&logo=sass&logoColor=white"></a>
<a href="https://getbootstrap.com"><img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white"></a>
<a href="https://php.net"><img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"></a>
<a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white"></a>
<a href=""><img src="https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white"></a>
</p>

<h4 align="center">💻 OS</h4>
<p align="center">
<a href="https://fedoraproject.org/"><img src="https://img.shields.io/badge/Fedora-294172?style=for-the-badge&logo=fedora&logoColor=white"></a>
<a href="https://kali.org/"><img src="https://img.shields.io/badge/Kali_Linux-557C94?style=for-the-badge&logo=kali-linux&logoColor=white"></a>
</p>

# FilamentPHP Admin Panel

<img src="public/images/Screenshot From 2024-11-11 12-48-09.png">
<img src="public/images/Screenshot From 2024-11-11 13-17-15.png">
<img src="public/images/Screenshot From 2024-11-11 13-17-08.png">

This repository contains a custom-built admin panel created with [FilamentPHP](https://filamentphp.com/), offering a seamless and efficient experience for managing application data. The panel is enriched with powerful features like global search and integrated Google Analytics, making it a comprehensive tool for monitoring and managing key aspects of your application.

## Key Features

- **Global Search**: Quickly search across multiple resources and find records in real-time. This feature, contributed by [charrafimed](https://github.com/charrafimed), allows administrators to access data faster, improving workflow efficiency.
- **Google Analytics Integration**: Track real-time user interactions and site performance right from the admin dashboard, with easy integration provided by [BezhanSalleh](https://github.com/BezhanSalleh).
- **User-Friendly Interface**: Built with a clean, responsive design that makes navigating and managing content intuitive.
- **Role-Based Access Control**: Manage user roles and permissions to ensure secure access to sensitive data.

## Tech Stack

- **Backend**: Laravel
- **Admin Panel Framework**: FilamentPHP
- **Database**: MySQL
- **Front-End**: Tailwind CSS (via Filament)
  
## Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/obahchimaobi/admin-panel-with-filamentphp.git
   cd admin-panel-with-filamentphp
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Set Up Environment**
   - Copy the `.env.example` file to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update `.env` with your database credentials and other required environment settings.

4. **Run Migrations**
   ```bash
   php artisan migrate
   ```

5. **Serve the Application**
   ```bash
   php artisan serve
   ```

6. **Set Up Filament Admin**
   - Create an admin user:
     ```bash
     php artisan make:filament-user
     ```

## Usage

### Global Search
Easily accessible from the top navigation, global search allows you to search across all major resources in the system. Type in any keyword, and relevant records will appear instantly, saving time and enhancing productivity.

### Google Analytics Dashboard
The Google Analytics dashboard offers insights into your website’s performance, directly from the admin panel. You'll be able to track key metrics, including user sessions, page views, and real-time visitor activity.

## Contributing

If you'd like to contribute to this project, feel free to open a pull request. Whether it's fixing bugs, improving documentation, or adding new features, contributions are always welcome!

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---