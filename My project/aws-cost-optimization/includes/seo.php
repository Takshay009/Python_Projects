<?php
// Default values if not set
$page_title = isset($page_title) ? $page_title : 'AWS Cost Optimization Consultants | Reduce Cloud Costs by 20-60%';
$page_description = isset($page_description) ? $page_description : 'Reduce your AWS cloud costs by 20-60% without downtime. Expert AWS cost optimization consultants helping startups and businesses save money on cloud infrastructure.';
$page_keywords = isset($page_keywords) ? $page_keywords : 'AWS cost optimization, cloud cost reduction, AWS consulting, EC2 optimization, S3 storage optimization';
$canonical_url = isset($canonical_url) ? $canonical_url : BASE_URL . 'index.php';
$og_type = isset($og_type) ? $og_type : 'website';
$og_image = isset($og_image) ? $og_image : BASE_URL . 'assets/images/og-home.jpg';
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
<meta name="keywords" content="<?php echo htmlspecialchars($page_keywords); ?>">
<title>
    <?php echo htmlspecialchars($page_title); ?>
</title>

<!-- Canonical URL -->
<link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="<?php echo htmlspecialchars($og_type); ?>">
<meta property="og:url" content="<?php echo htmlspecialchars($canonical_url); ?>">
<meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars($page_description); ?>">
<meta property="og:image" content="<?php echo htmlspecialchars($og_image); ?>">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?php echo htmlspecialchars($canonical_url); ?>">
<meta property="twitter:title" content="<?php echo htmlspecialchars($page_title); ?>">
<meta property="twitter:description" content="<?php echo htmlspecialchars($page_description); ?>">
<meta property="twitter:image" content="<?php echo htmlspecialchars($og_image); ?>">

<!-- Structured Data (JSON-LD) -->
<?php if (isset($json_ld_schema)): ?>
    <script type="application/ld+json">
                                <?php echo $json_ld_schema; ?>
                                </script>
<?php endif; ?>

<!-- Favicon -->
<link rel="icon" type="image/svg+xml"
    href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 36 36'><rect width='36' height='36' rx='8' fill='%230073BB'/><path d='M8 22C8 22 10.5 14 18 14C25.5 14 28 22 28 22' stroke='%23FFFFFF' stroke-width='2.5' stroke-linecap='round'/><path d='M6 25C6 25 9.5 18 18 18C26.5 18 30 25 30 25' stroke='rgba(255,255,255,0.5)' stroke-width='2' stroke-linecap='round'/><circle cx='18' cy='13' r='2.5' fill='%23FFFFFF'/></svg>">

<!-- Stylesheets -->
<link rel="stylesheet" href="assets/css/style.css?v=1.0.2">