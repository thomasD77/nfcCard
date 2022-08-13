<?php
/**
 * head_start.php
 *
 * Author: pixelcave
 *
 * The first block of code used in every page of the template
 *
 */
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title><?php echo $one->title; ?></title>

    <meta name="description" content="<?php echo $one->description; ?>">
    <meta name="author" content="<?php echo $one->author; ?>">
    <meta name="robots" content="<?php echo $one->robots; ?>">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="<?php echo $one->title; ?>">
    <meta property="og:site_name" content="<?php echo $one->name; ?>">
    <meta property="og:description" content="<?php echo $one->description; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $one->og_url_site; ?>">
    <meta property="og:image" content="<?php echo $one->og_url_image; ?>">

      <!-- Favicons -->
      <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
      <link rel="manifest" href="/site.webmanifest">
      <meta name="msapplication-TileColor" content="#da532c">
      <meta name="theme-color" content="#ffffff">
    <!-- END Icons -->

    <!-- Stylesheets -->
