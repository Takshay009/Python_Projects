# AWS Cost Optimization Portfolio Website

A professional service-based portfolio website for AWS Cost Optimization consulting services. Built with HTML, CSS, JavaScript, and PHP with MySQL backend.

## 🎯 Features

- **Modern, Responsive Design**: AWS-themed colors with mobile-first approach
- **5 Complete Pages**: Home, Services, Cost Optimization, About, Contact
- **Contact Form**: Full PHP backend with database storage and email notifications
- **Conversion-Focused**: Strong CTAs, testimonials, and trust-building elements
- **SEO Optimized**: Proper meta tags, semantic HTML, and structured content
- **Secure Backend**: PDO prepared statements, input validation, XSS prevention

## 📁 Project Structure

```
aws-cost-optimization/
├── index.php                    # Home page with hero and services overview
├── services.php                 # Detailed service catalog
├── aws-cost-optimization.php    # Educational content page
├── about.php                    # About the consultants
├── contact.php                  # Contact form with PHP processing
├── database_setup.sql           # Database creation script
├── assets/
│   ├── css/
│   │   └── style.css           # Complete design system
│   └── js/
│       └── main.js             # Interactive functionality
└── config/
    └── db.php                  # Database configuration
```

## 🚀 Installation & Setup

### Prerequisites

- **PHP 7.4+** (with PDO MySQL extension)
- **MySQL 5.7+** or **MariaDB 10.2+**
- **Web Server** (Apache, Nginx, or PHP built-in server)
- **XAMPP/WAMP/MAMP** (recommended for local development)

### Step 1: Database Setup

1. Start your MySQL server (via XAMPP/WAMP or standalone)

2. Import the database:
   ```bash
   mysql -u root -p < database_setup.sql
   ```
   
   Or manually run the SQL commands in `database_setup.sql` using phpMyAdmin or MySQL Workbench.

3. Verify the database was created:
   ```sql
   SHOW DATABASES;
   USE aws_cost_optimizer;
   SHOW TABLES;
   ```

### Step 2: Configure Database Connection

1. Open `config/db.php`

2. Update the database credentials:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'aws_cost_optimizer');
   define('DB_USER', 'root');        // Your MySQL username
   define('DB_PASS', '');            // Your MySQL password
   ```

### Step 3: Configure Email (Optional)

1. Open `contact.php`

2. Update the email address on line 52:
   ```php
   $to = 'your-email@example.com';  // Change to your email
   ```

3. **Note**: PHP's `mail()` function requires proper server configuration. For local testing:
   - Use a service like **Mailtrap** or **MailHog** for testing
   - For production, use **SMTP** (Gmail, SendGrid, etc.) with PHPMailer library

### Step 4: Start the Server

#### Option A: PHP Built-in Server (Quick Testing)
```bash
cd aws-cost-optimization
php -S localhost:8000
```
Then visit: http://localhost:8000

#### Option B: XAMPP/WAMP
1. Copy the `aws-cost-optimization` folder to `htdocs` (XAMPP) or `www` (WAMP)
2. Start Apache and MySQL
3. Visit: http://localhost/aws-cost-optimization

#### Option C: Production Server
1. Upload files to your web server
2. Ensure PHP and MySQL are configured
3. Update `config/db.php` with production credentials
4. Set proper file permissions (755 for directories, 644 for files)

## 🎨 Customization

### Update Personal Information

1. **Contact Details** (in all pages):
   - Email: Search for `contact@cloudcostsolution.gt.tc` and replace
   - WhatsApp: Search for `1234567890` and replace with your number

2. **About Page** (`about.php`):
   - Update the consultant name and background
   - Add real certifications and experience
   - Customize the mission statement

3. **Testimonials** (`index.php`):
   - Replace dummy testimonials with real client feedback
   - Or remove the section if you don't have testimonials yet

### Branding

1. **Logo**: Update the emoji icon `☁️` in all pages
2. **Colors**: Modify CSS variables in `assets/css/style.css`:
   ```css
   :root {
     --aws-orange: #FF9900;
     --aws-blue: #232F3E;
     /* ... */
   }
   ```

## 🔒 Security Considerations

### Current Security Features
- ✅ PDO prepared statements (SQL injection prevention)
- ✅ Input sanitization with `htmlspecialchars()`
- ✅ Email validation
- ✅ XSS prevention
- ✅ Error logging (not displayed to users)

### Production Recommendations
1. **Environment Variables**: Store credentials in `.env` file (not in code)
2. **HTTPS**: Always use SSL/TLS in production
3. **Rate Limiting**: Add CAPTCHA or rate limiting to contact form
4. **CSRF Protection**: Add CSRF tokens to forms
5. **Database User**: Create a dedicated MySQL user (not root)
6. **File Permissions**: Set restrictive permissions on `config/db.php`
7. **Error Handling**: Disable error display in production PHP settings

## 📧 Email Configuration

### For Local Development (Testing)

Use **Mailtrap** (free):
1. Sign up at https://mailtrap.io
2. Install PHPMailer: `composer require phpmailer/phpmailer`
3. Update contact form to use SMTP instead of `mail()`

### For Production

Use **SMTP** with Gmail or SendGrid:
```php
// Example with PHPMailer and Gmail
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'your-email@gmail.com';
$mail->Password = 'your-app-password';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
```

## 📊 Database Management

### View Contact Submissions
```sql
SELECT * FROM contact_leads ORDER BY created_at DESC;
```

### Export Leads to CSV
```sql
SELECT name, email, company, message, created_at 
INTO OUTFILE '/tmp/leads.csv'
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
FROM contact_leads;
```

### Backup Database
```bash
mysqldump -u root -p aws_cost_optimizer > backup.sql
```

## 🌐 Deployment

### AWS EC2 Deployment (Recommended)
1. Launch Ubuntu EC2 instance
2. Install LAMP stack:
   ```bash
   sudo apt update
   sudo apt install apache2 mysql-server php php-mysql
   ```
3. Upload files to `/var/www/html/`
4. Configure Apache virtual host
5. Set up SSL with Let's Encrypt

### Shared Hosting
1. Upload files via FTP/cPanel File Manager
2. Import database via phpMyAdmin
3. Update `config/db.php` with hosting credentials

## 🐛 Troubleshooting

### Database Connection Failed
- Verify MySQL is running
- Check credentials in `config/db.php`
- Ensure database `aws_cost_optimizer` exists
- Check PHP PDO MySQL extension is enabled

### Contact Form Not Working
- Check database connection
- Verify table `contact_leads` exists
- Check PHP error logs
- Ensure proper file permissions

### Email Not Sending
- PHP `mail()` requires server configuration
- Use SMTP for reliable email delivery
- Check spam folder
- Verify email credentials

## 📝 License

This is a custom-built portfolio website. Feel free to customize and use for your own consulting business.

## 🤝 Support

For questions or issues:
- Email: contact@cloudcostsolution.gt.tc
- WhatsApp: +91 63520 01097

---

**Built with ❤️ for AWS Cost Optimization Consultants**
