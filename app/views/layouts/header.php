<?php
/**
 * Shared <head> + opening chrome (preloader, cursor, navbar).
 * Expects: $pageTitle, $pageDescription, $canonical
 */
$pageTitle       = $pageTitle ?? 'Ade Dian Sukmana — Web Developer & UI Designer';
$pageDescription = $pageDescription ?? 'Web Developer & UI Designer based in Surabaya, Indonesia.';
$canonical       = $canonical ?? base_url('/');
$ogImage         = asset('images/og-cover.jpg');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e($pageDescription) ?>">
<link rel="canonical" href="<?= e($canonical) ?>">

<meta property="og:type" content="website">
<meta property="og:title" content="<?= e($pageTitle) ?>">
<meta property="og:description" content="<?= e($pageDescription) ?>">
<meta property="og:url" content="<?= e($canonical) ?>">
<meta property="og:image" content="<?= e($ogImage) ?>">
<meta property="og:locale" content="en_US">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= e($pageTitle) ?>">
<meta name="twitter:description" content="<?= e($pageDescription) ?>">
<meta name="twitter:image" content="<?= e($ogImage) ?>">

<meta name="theme-color" content="#050505">
<link rel="icon" href="<?= asset('icons/favicon.svg') ?>" type="image/svg+xml">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="<?= asset('css/variables.css') ?>">
<link rel="stylesheet" href="<?= asset('css/base.css') ?>">
<link rel="stylesheet" href="<?= asset('css/layout.css') ?>">
<link rel="stylesheet" href="<?= asset('css/components.css') ?>">
<link rel="stylesheet" href="<?= asset('css/animations.css') ?>">
<link rel="stylesheet" href="<?= asset('css/responsive.css') ?>">

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "Ade Dian Sukmana",
  "jobTitle": "Web Developer & UI Designer",
  "url": "<?= e($canonical) ?>",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Surabaya",
    "addressCountry": "ID"
  },
  "alumniOf": {
    "@type": "CollegeOrUniversity",
    "name": "Telkom University Surabaya"
  },
  "sameAs": [
    "https://id.linkedin.com/in/ade-dian-sukmana",
    "https://github.com/adedian"
  ]
}
</script>
</head>
<body class="is-loading">

<a href="#main" class="skip-link">Skip to content</a>

<div class="preloader" aria-hidden="true">
  <div class="preloader__name">ADE DIAN SUKMANA</div>
  <div class="preloader__bar"><div class="preloader__bar-fill"></div></div>
  <div class="preloader__count">000</div>
</div>

<div class="noise-overlay" aria-hidden="true"></div>
<div class="page-transition" aria-hidden="true"></div>

<div class="cursor" aria-hidden="true"></div>
<div class="cursor-ring" aria-hidden="true"><span class="cursor-ring__label"></span></div>

<header class="navbar">
  <div class="container navbar__inner">
    <a href="<?= base_url('/') ?>" class="navbar__logo" data-cursor="link" data-cursor-label="Home">
      <span class="navbar__logo-mark">AD</span>
      <span class="navbar__logo-text sr-only">Ade Dian Sukmana</span>
    </a>

    <nav class="navbar__menu" aria-label="Primary">
      <a href="<?= base_url('/#about') ?>" class="navbar__link">About</a>
      <a href="<?= base_url('/#experience') ?>" class="navbar__link">Experience</a>
      <a href="<?= base_url('/#work') ?>" class="navbar__link">Work</a>
      <a href="<?= base_url('/#skills') ?>" class="navbar__link">Skills</a>
      <a href="<?= base_url('/#contact') ?>" class="navbar__link">Contact</a>
    </nav>

    <a href="<?= base_url('/#contact') ?>" class="btn btn-outline navbar__cta magnetic" data-cursor="link">
      Let's Talk
    </a>

    <button class="navbar__toggle" aria-label="Toggle menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<div class="mobile-menu" id="mobile-menu">
  <ul class="mobile-menu__list">
    <li><a href="<?= base_url('/#about') ?>" class="mobile-menu__link">About</a></li>
    <li><a href="<?= base_url('/#experience') ?>" class="mobile-menu__link">Experience</a></li>
    <li><a href="<?= base_url('/#work') ?>" class="mobile-menu__link">Work</a></li>
    <li><a href="<?= base_url('/#skills') ?>" class="mobile-menu__link">Skills</a></li>
    <li><a href="<?= base_url('/#contact') ?>" class="mobile-menu__link">Contact</a></li>
  </ul>
  <div class="mobile-menu__footer">
    <span>Surabaya, ID</span>
    <span>&mdash;</span>
    <a href="mailto:adesukmana000@gmail.com">adesukmana000@gmail.com</a>
  </div>
</div>

<main id="main">
