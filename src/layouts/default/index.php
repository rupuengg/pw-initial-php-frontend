<?php
if(strpos(REQUEST_URI, '/projects') !== false) {
  if(REQUEST_URI === '/projects') include_once ROOT_PATH.'src/pages/Projects.php';
  else {
    include_once ROOT_PATH.'src/pages/Project.php';
  }
} else {
  switch(REQUEST_URI){
    case '':
    case '/best-interior-designer-noida':
      include_once ROOT_PATH.'src/pages/Home.php';
      break;
    case '/about':
      include_once ROOT_PATH.'src/pages/About.php';
      break;
    case '/services':
    case '/services/all':
    case '/services/residences':
    case '/services/recreation':
    case '/services/modular-kitchen':
    case '/services/livingroom':
      include_once ROOT_PATH.'src/pages/Services.php';
      break;
    case '/projects':
      include_once ROOT_PATH.'src/pages/Projects.php';
      break;
    case '/gallery':
      include_once ROOT_PATH.'src/pages/Gallery.php';
      break;
    case '/contact':
      include_once ROOT_PATH.'src/pages/Contact.php';
      break;
    case '/faq':
      include_once ROOT_PATH.'src/pages/Faq.php';
      break;
    case '/blog':
      include_once ROOT_PATH.'src/pages/Blogs.php';
      break;
    case '/blog/journey-into-interior-design':
    case '/blog/panacheworld-journey-into-interior-design':
      include_once ROOT_PATH.'src/pages/Blog.php';
      break;
    default:
      header('Location: '.HOST.'/best-interior-designer-noida');
      exit;
      break;
  }
}