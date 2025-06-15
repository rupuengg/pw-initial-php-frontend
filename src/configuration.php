<?php
include_once 'seo.php';

$str = file_get_contents('./photos.json');
$json = json_decode($str, true);

$requestUri = $_SERVER['REQUEST_URI'];

$allRoutes = [
  '/',
  '/services',
  '/about',
  '/services',
  '/services/all',
  '/services/residences',
  '/services/recreation',
  '/services/modular-kitchen',
  '/services/livingroom',
  '/projects',
  '/projects/000_f_142_gulshan_bellina',
  '/projects/053_t7_1906_exotica_dreamVelli',
  '/projects/012_f_123_gulshan_bellina',
  '/projects/016_f_044_gulshan_bellina',
  '/projects/031_f_154_gulshan_bellina',
  '/projects/043_110_dhurva_apartment_delhi',
  '/projects/049_j_061_gulshan_bellina',
  '/projects/034_g_3052_gaur_city_14_avenue',
  '/projects/013_g_1004_samridhi',
  '/projects/029_a_183_gulshan_belolina',
  '/projects/011_g_044_gulshan_bellina',
  '/gallery',
  '/contact',
  '/faq',
];

function setOpenGraphData($seo, $siteTitle, $pageUrl, $pageTitle, $description, $type, $homepageUrl, $locale, $localeAlternate1, $localeAlternate2) {
  $seo->setOG(new OG(
    $siteTitle,
    $pageUrl,
    $pageTitle,
    $description,
    $type,
    $homepageUrl,
    $locale,
    $localeAlternate1,
    $localeAlternate2
  ));
}

function setOpenGraphImage($seo, $mime, $width, $height, $url, $secure_url, $alt) {
  $seo->setOGImage(new OGImage(
    $mime,
    $width,
    $height,
    $url,
    $secure_url,
    $alt
  ));
}

function getProjectDetailFromJson($json, $projectId, $seo) {
  $page = array_values(array_filter($json, function($value) use($projectId) {
    return isset($value['customMetadata']) && isset($value['customMetadata']['galleryId']) && $value['customMetadata']['galleryId'] === $projectId;
  }));

  $data = count($page) > 0 ? array_filter($page, function($p){
    return isset($p['customMetadata']) && isset($p['customMetadata']['cover']) && $p['customMetadata']['cover'] !== '0' && $p['customMetadata']['cover'] === true;
  })[0] : $json[0];

  setOpenGraphData(
     $seo,
    'PanacheWorld - India', // siteTitle
    'https://panacheworld.in/' . $_SERVER['REQUEST_URI'], // pageUrl
    'Best Interior Designers in Noida for Home Design - PanacheWorld', // pageTitle
    'Interior Designers in Noida Greater Noida - Looking for home interior designer in Noida? PanacheWorld company offers the best interior design offering comprehensive design services. Redefine your home with tailor made best interior design solutions.', // description
    'website', // type
    'https://panacheworld.in', // homepageUrl
    'en_IN', // locale
    'es_ES', // locale alternate
    '' // locale alternate 2
  );

  setOpenGraphImage(
     $seo,
    $data['mime'], // mime
    '400', // width
    '300', // height
    $data['url'], // url
    $data['url'], // secure_url
    $data['customMetadata']['galleryName'] // alt
  );
}

function _init($json, $requestUri) {
  $title = 'Best Interior Designers in Noida for Home Design - PanacheWorld';
  $description = 'Interior Designers in Noida Greater Noida - Looking for home interior designer in Noida? PanacheWorld company offers the best interior design offering comprehensive design services. Redefine your home with tailor made best interior design solutions';
  $keywords = 'interior designer in noida, home design, home design specilist, designer noida, best interior designer noida, best interior designer in noida, interior design noida, interiors in noida, home interior designers in noida, home interiors noida, home interior design in noida';

  $seo = new SEO(
    $title, 
    $description, 
    $keywords
  );

  if($requestUri === '/' || $requestUri === '/home_interior_design_in_noida') {
    setOpenGraphData(
      $seo,
      'PanacheWorld - India', // siteTitle
      'https://panacheworld.in/', // pageUrl
      'Best Interior Designers in Noida for Home Design - PanacheWorld', // pageTitle
      'Interior Designers in Noida Greater Noida - Looking for home interior designer in Noida? PanacheWorld company offers the best interior design offering comprehensive design services. Redefine your home with tailor made best interior design solutions', // description
      'website', // type
      'https://panacheworld.in', // homepageUrl
      'en_IN', // locale
      'es_ES', // locale alternate
      '' // locale alternate 2
    );

    setOpenGraphImage(
      $seo,
      'image/jpeg', // mime
      '400', // width
      '300', // height
      'https://panacheworld.in/static/media/logo-grayscale-inverted.png', // url
      'https://panacheworld.in/static/media/logo-grayscale-inverted.png', // secure_url
      'PanacheWorld - India' // alt
    );
  } elseif ($requestUri === '/about') {
    setOpenGraphData(
      $seo,
      'PanacheWorld - India', // siteTitle
      'https://panacheworld.in/about', // pageUrl
      'About Us', // pageTitle
      'PanacheWorld provides one-stop interior design and renovation services for residential and commercial projects in India. With the aim of providing the most satisfactory design for clients to enjoy their lives, we will take into consideration our client’s needs, preferences and living habits. With this information, we’ll work together with each client, giving them professional advice and helping them create their ideal house.', // description
      'website', // type
      'https://panacheworld.in', // homepageUrl
      'en_IN', // locale
      'es_ES', // locale alternate
      '' // locale alternate 2
    );

    setOpenGraphImage(
      $seo,
      'image/jpeg', // mime
      '400', // width
      '300', // height
      'https://panacheworld.in/static/media/logo-grayscale-inverted.png', // url
      'https://panacheworld.in/static/media/logo-grayscale-inverted.png', // secure_url
      'About Us' // alt
    );
  } elseif ($requestUri === '/services') {
    setOpenGraphData(
      $seo,
      'PanacheWorld - India', // siteTitle
      'https://panacheworld.in/services', // pageUrl
      'Services - All Services', // pageTitle
      'Interior Designers in Noida Greater Noida - Looking for home interior designer in Noida? PanacheWorld company offers the best interior design offering comprehensive design services. Redefine your home with tailor made best interior design solutions', // description
      'website', // type
      'https://panacheworld.in', // homepageUrl
      'en_IN', // locale
      'es_ES', // locale alternate
      '' // locale alternate 2
    );

    setOpenGraphImage(
      $seo,
      'image/jpeg', // mime
      '400', // width
      '300', // height
      'https://panacheworld.in/static/media/logo-grayscale-inverted.png', // url
      'https://panacheworld.in/static/media/logo-grayscale-inverted.png', // secure_url
      'Services - All Services' // alt
    );
  } elseif ($requestUri === '/services/all') {
    setOpenGraphData(
      $seo,
      'PanacheWorld - India', // siteTitle
      'https://panacheworld.in/services/all', // pageUrl
      'Services - All Services', // pageTitle
      'Interior Designers in Noida Greater Noida - Looking for home interior designer in Noida? PanacheWorld company offers the best interior design offering comprehensive design services. Redefine your home with tailor made best interior design solutions', // description
      'website', // type
      'https://panacheworld.in', // homepageUrl
      'en_IN', // locale
      'es_ES', // locale alternate
      '' // locale alternate 2
    );

    setOpenGraphImage(
      $seo,
      'image/jpeg', // mime
      '400', // width
      '300', // height
      'https://panacheworld.in/static/media/logo-grayscale-inverted.png', // url
      'https://panacheworld.in/static/media/logo-grayscale-inverted.png', // secure_url
      'Services - All Services' // alt
    );
  } elseif ($requestUri === '/services/residences') {
    setOpenGraphData(
      $seo,
      'PanacheWorld - India', // siteTitle
      'https://panacheworld.in/services/residences', // pageUrl
      'Services - Residences', // pageTitle
      'Interior Designers in Noida Greater Noida - Looking for home interior designer in Noida? PanacheWorld company offers the best interior design offering comprehensive design services. Redefine your home with tailor made best interior design solutions', // description
      'website', // type
      'https://panacheworld.in', // homepageUrl
      'en_IN', // locale
      'es_ES', // locale alternate
      '' // locale alternate 2
    );

    setOpenGraphImage(
      $seo,
      'image/jpeg', // mime
      '400', // width
      '300', // height
      'https://panacheworld.in/static/media/logo-grayscale-inverted.png', // url
      'https://panacheworld.in/static/media/logo-grayscale-inverted.png', // secure_url
      'Services - Residences' // alt
    );
  } elseif ($requestUri === '/services/recreation') {
    setOpenGraphData(
      $seo,
      'PanacheWorld - India', // siteTitle
      'https://panacheworld.in/services/recreation', // pageUrl
      'Services - Recreation', // pageTitle
      'Interior Designers in Noida Greater Noida - Looking for home interior designer in Noida? PanacheWorld company offers the best interior design offering comprehensive design services. Redefine your home with tailor made best interior design solutions', // description
      'website', // type
      'https://panacheworld.in', // homepageUrl
      'en_IN', // locale
      'es_ES', // locale alternate
      '' // locale alternate 2
    );

    setOpenGraphImage(
      $seo,
      'image/jpeg', // mime
      '400', // width
      '300', // height
      'https://panacheworld.in/static/media/logo-grayscale-inverted.png', // url
      'https://panacheworld.in/static/media/logo-grayscale-inverted.png', // secure_url
      'Services - Recreation' // alt
    );
  } elseif ($requestUri === '/services/modular-kitchen') {
    setOpenGraphData(
      $seo,
      'PanacheWorld - India', // siteTitle
      'https://panacheworld.in/services/modular-kitchen', // pageUrl
      'Services - Modular Kitchen', // pageTitle
      'Interior Designers in Noida Greater Noida - Looking for home interior designer in Noida? PanacheWorld company offers the best interior design offering comprehensive design services. Redefine your home with tailor made best interior design solutions', // description
      'website', // type
      'https://panacheworld.in', // homepageUrl
      'en_IN', // locale
      'es_ES', // locale alternate
      '' // locale alternate 2
    );

    setOpenGraphImage(
      $seo,
      'image/jpeg', // mime
      '400', // width
      '300', // height
      'https://panacheworld.in/static/media/logo-grayscale-inverted.png', // url
      'https://panacheworld.in/static/media/logo-grayscale-inverted.png', // secure_url
      'Services - Modular Kitchen' // alt
    );
  } elseif ($requestUri === '/services/livingroom') {
    setOpenGraphData(
      $seo,
      'PanacheWorld - India', // siteTitle
      'https://panacheworld.in/services/livingroom', // pageUrl
      'Services - Living Room', // pageTitle
      'Interior Designers in Noida Greater Noida - Looking for home interior designer in Noida? PanacheWorld company offers the best interior design offering comprehensive design services. Redefine your home with tailor made best interior design solutions', // description
      'website', // type
      'https://panacheworld.in', // homepageUrl
      'en_IN', // locale
      'es_ES', // locale alternate
      '' // locale alternate 2
    );

    setOpenGraphImage(
      $seo,
      'image/jpeg', // mime
      '400', // width
      '300', // height
      'https://panacheworld.in/static/media/logo-grayscale-inverted.png', // url
      'https://panacheworld.in/static/media/logo-grayscale-inverted.png', // secure_url
      'Services - Living Room' // alt
    );
  } elseif ($requestUri === '/projects') {
    setOpenGraphData(
      $seo,
      'PanacheWorld - India', // siteTitle
      'https://panacheworld.in/projects', // pageUrl
      'Our Projects', // pageTitle
      'Interior Designers in Noida Greater Noida - Looking for home interior designer in Noida? PanacheWorld company offers the best interior design offering comprehensive design services. Redefine your home with tailor made best interior design solutions.', // description
      'website', // type
      'https://panacheworld.in', // homepageUrl
      'en_IN', // locale
      'es_ES', // locale alternate
      '' // locale alternate 2
    );

    setOpenGraphImage(
      $seo,
      'image/jpeg', // mime
      '400', // width
      '300', // height
      'https://ik.imagekit.io/yz7i3lbbn/043%20-%20110%20-%20Aditya%20-%20Dhurav%20Apartment%20Delhi%20-%20Done/IMG-20221104-WA0025.jpg?updatedAt=1737780984866', // url
      'https://ik.imagekit.io/yz7i3lbbn/043%20-%20110%20-%20Aditya%20-%20Dhurav%20Apartment%20Delhi%20-%20Done/IMG-20221104-WA0025.jpg?updatedAt=1737780984866', // secure_url
      'Our Projects' // alt
    );
  } elseif ($requestUri === '/projects/000_f_142_gulshan_bellina') {
    getProjectDetailFromJson($json, '000_f_142_gulshan_bellina', $seo);
  } elseif ($requestUri === '/projects/053_t7_1906_exotica_dreamVelli') {
    getProjectDetailFromJson($json, '053_t7_1906_exotica_dreamVelli', $seo);
  } elseif ($requestUri === '/projects/012_f_123_gulshan_bellina') {
    getProjectDetailFromJson($json, '012_f_123_gulshan_bellina', $seo);
  } elseif ($requestUri === '/projects/016_f_044_gulshan_bellina') {
    getProjectDetailFromJson($json, '016_f_044_gulshan_bellina', $seo);
  } elseif ($requestUri === '/projects/031_f_154_gulshan_bellina') {
    getProjectDetailFromJson($json, '031_f_154_gulshan_bellina', $seo);
  } elseif ($requestUri === '/projects/043_110_dhurva_apartment_delhi') {
    getProjectDetailFromJson($json, '043_110_dhurva_apartment_delhi', $seo);
  } elseif ($requestUri === '/projects/049_j_061_gulshan_bellina') {
    getProjectDetailFromJson($json, '049_j_061_gulshan_bellina', $seo);
  } elseif ($requestUri === '/projects/034_g_3052_gaur_city_14_avenue') {
    getProjectDetailFromJson($json, '034_g_3052_gaur_city_14_avenue', $seo);
  } elseif ($requestUri === '/projects/013_g_1004_samridhi') {
    getProjectDetailFromJson($json, '013_g_1004_samridhi', $seo);
  } elseif ($requestUri === '/projects/029_a_183_gulshan_belolina') {
    getProjectDetailFromJson($json, '029_a_183_gulshan_belolina', $seo);
  } elseif ($requestUri === '/projects/011_g_044_gulshan_bellina') {
    getProjectDetailFromJson($json, '011_g_044_gulshan_bellina', $seo);
  } elseif ($requestUri === '/gallery') {
    setOpenGraphData(
      $seo,
      'PanacheWorld - India', // siteTitle
      'https://panacheworld.in/gallery', // pageUrl
      'Gallery - Our work', // pageTitle
      'Interior Designers in Noida Greater Noida - Looking for home interior designer in Noida? PanacheWorld company offers the best interior design offering comprehensive design services. Redefine your home with tailor made best interior design solutions.', // description
      'website', // type
      'https://panacheworld.in', // homepageUrl
      'en_IN', // locale
      'es_ES', // locale alternate
      '' // locale alternate 2
    );

    setOpenGraphImage(
      $seo,
      'image/jpeg', // mime
      '400', // width
      '300', // height
      'https://ik.imagekit.io/yz7i3lbbn/000%20-%20F%20142%20Gulshan%20Bellina%20-%20Done/001-mb-tv-wr.bbdb5d9b.jpeg?updatedAt=1735127685208', // url
      'https://ik.imagekit.io/yz7i3lbbn/000%20-%20F%20142%20Gulshan%20Bellina%20-%20Done/001-mb-tv-wr.bbdb5d9b.jpeg?updatedAt=1735127685208', // secure_url
      'Gallery - Our work' // alt
    );
  } elseif ($requestUri === '/contact') {
    setOpenGraphData(
      $seo,
      'PanacheWorld - India', // siteTitle
      'https://panacheworld.in/contact', // pageUrl
      'Enquire for services', // pageTitle
      'Interior Designers in Noida Greater Noida - Looking for home interior designer in Noida? PanacheWorld company offers the best interior design offering comprehensive design services. Redefine your home with tailor made best interior design solutions.', // description
      'website', // type
      'https://panacheworld.in', // homepageUrl
      'en_IN', // locale
      'es_ES', // locale alternate
      '' // locale alternate 2
    );

    setOpenGraphImage(
      $seo,
      'image/jpeg', // mime
      '400', // width
      '300', // height
      'https://panacheworld.in/static/media/banner3.28cf09491fdb18fdff73.jpg', // url
      'https://panacheworld.in/static/media/banner3.28cf09491fdb18fdff73.jpg', // secure_url
      'Enquire for services' // alt
    );
  } elseif ($requestUri === '/faq') {
    setOpenGraphData(
      $seo,
      'PanacheWorld - India', // siteTitle
      'https://panacheworld.in/faq', // pageUrl
      'Frequently Asked Questions (FAQ)', // pageTitle
      'We specialize in both residential and commercial interior design projects. From cozy homes and apartments to vibrant offices, retail spaces, and restaurants, we cater to a variety of environments while ensuring each space reflects the client`s unique style.', // description
      'website', // type
      'https://panacheworld.in', // homepageUrl
      'en_IN', // locale
      'es_ES', // locale alternate
      '' // locale alternate 2
    );

    setOpenGraphImage(
      $seo,
      'image/jpeg', // mime
      '400', // width
      '300', // height
      'https://panacheworld.in/static/media/banner3.28cf09491fdb18fdff73.jpg', // url
      'https://panacheworld.in/static/media/banner3.28cf09491fdb18fdff73.jpg', // secure_url
      'Frequently Asked Questions (FAQ)' // alt
    );
  }
  
  return $seo;
}

$seo = _init($json, $requestUri);