<?php
require_once 'includes/config.php';

// Simple Email Sending Logic (No Database)
$success_message = '';
$error_message = '';

// PHPMailer Integration
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'includes/PHPMailer/Exception.php';
require 'includes/PHPMailer/PHPMailer.php';
require 'includes/PHPMailer/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_contact'])) {
  // CSRF Check
  if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
    $error_message = "Security verification failed. Please try again.";
  }
  // Rate Limit Check
  elseif (!check_rate_limit(60)) {
    $error_message = "Please wait before sending another inquiry.";
  } else {
    $name = trim(htmlspecialchars($_POST['name'] ?? ''));
    $email = trim(htmlspecialchars($_POST['email'] ?? ''));
    $company = trim(htmlspecialchars($_POST['company'] ?? ''));
    $spend = trim(htmlspecialchars($_POST['spend'] ?? ''));
    $message = trim(htmlspecialchars($_POST['message'] ?? ''));

    // Simple Validation
    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

      $mail = new PHPMailer(true);
      try {
        // Server settings
        if (DEV_MODE) {
          $mail->SMTPDebug = SMTP::DEBUG_OFF; // Set to DEBUG_SERVER for troubleshooting
        }
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = SMTP_AUTH;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASS;
        $mail->SMTPSecure = SMTP_ENCRYPTION === 'ssl' ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = SMTP_PORT;

        // Recipients
        $mail->setFrom(FROM_EMAIL, FROM_NAME);
        $mail->addAddress(CONTACT_EMAIL);
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(false);
        $mail->Subject = "AWS Cost Audit Request from $name ($company)";
        $body = "Name: $name\n";
        $body .= "Email: $email\n";
        $body .= "Company: $company\n";
        $body .= "Monthly Spend: $spend\n\n";
        $body .= "Message:\n$message";
        $mail->Body = $body;

        $mail->send();
        update_submission_time();
        $success_message = "Thank you! We'll be in touch shortly.";
      } catch (Exception $e) {
        // Log error in DEV_MODE if needed
        if (DEV_MODE) {
          $error_message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        } else {
          $success_message = "Thank you! Your inquiry has been received.";
        }
      }
    } else {
      $error_message = "Please fill in all fields correctly.";
    }
  }
}

$page_title = 'AWS Cost Optimization Consultants | Reduce Cloud Costs by 20-60%';
$page_description = 'Expert AWS cost optimization consultants helping startups and businesses save money on cloud infrastructure. Services include cost audits, architecture review, and reserved instance planning.';
$canonical_url = BASE_URL;

// Structured Data (JSON-LD)
$json_ld_schema = json_encode([
  "@context" => "https://schema.org",
  "@graph" => [
    [
      "@type" => "Person",
      "name" => "takshay bhalodiya",
      "jobTitle" => "AWS Certified Solutions Architect"
    ],
    [
      "@type" => "Person",
      "name" => "het bhalodiya",
      "jobTitle" => "Cloud Cost Specialist"
    ],
    [
      "@type" => "ProfessionalService",
      "name" => SITE_NAME,
      "url" => BASE_URL,
      "priceRange" => "$$",
      "description" => "Professional AWS cost reduction and optimization services by " . SITE_FOUNDERS,
      "address" => [
        "@type" => "PostalAddress",
        "addressCountry" => "US"
      ]
    ]
  ]
]);

include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- HERO SECTION -->
<section id="home" class="hero">
  <div class="container">
    <div class="hero-content">
      <h1 class="hero-title">
        Reduce Your AWS Cloud Cost by <span class="highlight hero-highlight">20–60%</span> Without
        Downtime
      </h1>
      <p class="hero-subtitle">
        Expert AWS cost optimization consultants helping startups and businesses eliminate cloud waste, right-size
        resources, and implement smart savings strategies.
      </p>
      <div class="hero-cta">
        <a href="#contact" class="btn btn-large btn-purple-gradient">Get Free Cost Audit</a>
        <a href="#services" class="btn btn-white btn-large">View Services</a>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES SECTION (Merged) -->
<section id="services" class="section section-light">
  <div class="container">
    <div class="section-header">
      <span class="section-label">What We Offer</span>
      <h2 class="section-title">Comprehensive Optimization Services</h2>
      <p class="section-description">
        End-to-end cloud cost management from initial audit to ongoing monitoring.
      </p>
    </div>

    <div class="grid grid-3">
      <!-- Service 1: Audit -->
      <div id="service-audit" class="card">
        <div class="card-icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </div>
        <h3 class="card-title">AWS Cost Audit</h3>
        <p class="card-description">
          Complete analysis of your AWS spending with detailed recommendations.
        </p>
      </div>

      <!-- Service 2: EC2 Right-Sizing -->
      <div id="service-sizing" class="card">
        <div class="card-icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="3"></circle>
            <path
              d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
            </path>
          </svg>
        </div>
        <h3 class="card-title">EC2 Right-Sizing</h3>
        <p class="card-description">
          Optimize instance types based on actual usage to eliminate over-provisioning.
        </p>
      </div>

      <!-- Service 3: S3 Optimization -->
      <div id="service-s3" class="card">
        <div class="card-icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path
              d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
            </path>
            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
            <line x1="12" y1="22.08" x2="12" y2="12"></line>
          </svg>
        </div>
        <h3 class="card-title">S3 Storage Optimization</h3>
        <p class="card-description">
          Lifecycle policies to move data to cheaper storage classes (IA, Glacier).
        </p>
      </div>

      <!-- Service 4: Cleanup -->
      <div id="service-cleanup" class="card">
        <div class="card-icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="3 6 5 6 21 6"></polyline>
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
          </svg>
        </div>
        <h3 class="card-title">Resource Cleanup</h3>
        <p class="card-description">
          Remove unused resources: stopped instances, unattached volumes, and old snapshots.
        </p>
      </div>

      <!-- Service 5: Savings Plans -->
      <div id="service-savings" class="card">
        <div class="card-icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
            <line x1="1" y1="10" x2="23" y2="10"></line>
          </svg>
        </div>
        <h3 class="card-title">Savings Plans</h3>
        <p class="card-description">
          Strategic purchase of RIs and Savings Plans for up to 72% discount.
        </p>
      </div>

      <!-- Service 6: Monitoring -->
      <div id="service-monitoring" class="card">
        <div class="card-icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
          </svg>
        </div>
        <h3 class="card-title">Monthly Monitoring</h3>
        <p class="card-description">
          Ongoing tracking and alerts to prevent cost anomalies.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ABOUT SECTION (Merged) -->
<section id="about" class="section">
  <div class="container">
    <div class="grid grid-2 grid-2-centered">
      <div>
        <span class="section-label">About Us</span>
        <h2 class="section-title section-title-left">Your Trusted Cloud Partners</h2>
        <p class="about-text">
          Founded by <strong>Het Bhalodiya</strong> and <strong>Takshay Bhalodiya</strong>, <?php echo SITE_NAME; ?>
          is a specialized cloud consultancy dedicated to helping startups and high-growth businesses
          eliminate AWS waste without compromising reliability.
        </p>
        <p class="about-text">
          Our mission is to ensure your cloud infrastructure is an asset, not a liability. We combine
          architectural expertise with financial shared responsibility to find every possible saving
          opportunity—from EC2 right-sizing to complex Savings Plan strategies.
        </p>

        <div class="mt-12">
          <div class="about-feature">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
              <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            <span>Team of AWS Certified Solutions Architects</span>
          </div>
          <div class="about-feature">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
              <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            <span>Managed $500k+ in Monthly AWS Cloud Spend</span>
          </div>
        </div>
      </div>

      <!-- Stats/Image Placeholder -->
      <div class="card card-glass">
        <div class="stats-container">
          <h3 class="stats-number">60%</h3>
          <p class="stats-label">Average Savings</p>

          <div class="stats-divider">
            <h3 class="stats-number-aws">$100k+</h3>
            <p class="stats-label">Wasted Cloud Spend Identified</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CONTACT SECTION -->
<section id="contact" class="section section-dark">
  <div class="container">
    <div class="section-header">
      <span class="section-label">Get Started</span>
      <h2 class="section-title">Ready to Stop Overpaying?</h2>
      <p class="section-description">
        Get a free cost audit or reach out directly using the button below.
      </p>
      <div class="contact-email-wrapper">
        <a href="mailto:<?php echo CONTACT_EMAIL; ?>" class="btn-email">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
          Direct Email Contact
        </a>
      </div>
    </div>

    <div class="contact-form-wrapper">

      <?php if ($success_message): ?>
        <div class="alert alert-professional alert-success-prof">
          <?php echo $success_message; ?>
        </div>
      <?php endif; ?>

      <?php if ($error_message): ?>
        <div class="alert alert-professional alert-error-prof">
          <?php echo $error_message; ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="#contact" class="card contact-form-card">
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

        <div class="grid grid-2 form-grid-no-margin">
          <div class="form-group">
            <label for="name" class="form-label">Your Name</label>
            <input type="text" id="name" name="name" class="form-input" placeholder="John Doe" required>
          </div>

          <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" id="email" name="email" class="form-input" placeholder="john@company.com" required>
          </div>
        </div>

        <div class="grid grid-2 form-grid-no-margin">
          <div class="form-group">
            <label for="company" class="form-label">Company Name</label>
            <input type="text" id="company" name="company" class="form-input" placeholder="Tech Solutions Inc.">
          </div>

          <div class="form-group">
            <label for="spend" class="form-label">Monthly AWS Spend</label>
            <select id="spend" name="spend" class="form-input">
              <option value="Under $1,000">Under $1,000 / month</option>
              <option value="$1,000 - $10,000">$1,000 - $10,000 / month</option>
              <option value="$10,000 - $50,000" selected>$10,000 - $50,000 / month</option>
              <option value="$50,000+">$50,000+ / month</option>
            </select>
          </div>
        </div>


        <div class="form-group">
          <label for="message" class="form-label">Specific Optimization Goals</label>
          <textarea id="message" name="message" class="form-textarea" rows="3"
            placeholder="Tell us about your current challenges..." required></textarea>
        </div>


        <button type="submit" name="submit_contact" class="btn btn-primary btn-large submit-btn-full">
          Get Free Cost Audit
        </button>
      </form>
    </div>
  </div>
</section><?php include 'includes/footer.php'; ?>