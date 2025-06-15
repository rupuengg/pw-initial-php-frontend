<?php
  define('HOST', 'https://panacheworld.in');
  define('API_HOST', 'https://panacheworld.in/api');
  // define('HOST', 'http://localhost:8070');
  // define('API_HOST', 'http://localhost:8090');

  // error_reporting(E_ALL);
  define('ROOT_PATH', dirname(__DIR__) . '/');

  include ROOT_PATH.'src/DB/SelectQuery.php';

  //  Get home menu route
  $route = getHomeMenuRoute();

  $requestUri = $_SERVER['REQUEST_URI'] === '/' ? $route : $_SERVER['REQUEST_URI'];

  define('REQUEST_URI', trim($requestUri));

  $seo = getSiteConfig(REQUEST_URI);

  $pagePath = getPagePath(REQUEST_URI);

  if($pagePath === "") {
    header('Location: '.HOST);
  }

  define('PAGE_PATH', $pagePath);
?>
<!doctype html>
<html lang="en">
  <head>
    <link rel="icon" href="/favicon.png" />
    <meta name="language" content="English" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="google-site-verification" content="z_5HlCkpyxt7dVxFX-65bH-qVoqJc-b-Vvz0mED9j9k" />
    <meta data-hid="robots" name="robots" content="index,follow" />
    <link rel="apple-touch-icon" href="/logo.png" />
    <link rel="manifest" href="/manifest.json" />
    <base href="/" />
    <?php include ROOT_PATH.'src/metaTag.php'; ?>
    <link href="/style.css" rel="stylesheet">
  </head>
  <body>
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root"><?php include ROOT_PATH.'src/layouts/index.php'; ?></div>
  </body>
</html>
