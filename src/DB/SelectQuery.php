<?php

require 'DBConnection.php';
require 'SiteConfig.php';

$dbConfig = DBConfig();

class SelectQuery {
  private $conn;
  private $query;

  public function __construct() {
    $this->conn = DBConnection::getDbConn();
  }

  public function query($query) {
    $this->query = $query;
  }

  public function selectAll() {
    $stmt = $this->conn->prepare($this->query);
    $output = $stmt->execute();

    return $output ? $stmt->fetchAll(PDO::FETCH_ASSOC) : array();
  }

  public function selectByWhere($where) {
    $stmt = $this->conn->prepare($this->query . ' where ' . $where);
    $output = $stmt->execute();

    return $output ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
  }
}

function makeSiteConfigData($row): SiteConfig {
  if(!$row) throw new Exception('No data');

  $siteConfig = new SiteConfig($row['id'], $row['route'], $row['imageKitFolder'], $row['title'], $row['description'], $row['keywords']);
  $siteConfig->setOgData($row['ogSiteName'], $row['ogUrl'], $row['ogTitle'], $row['ogDescription'], $row['ogType'], $row['ogSeeAlso'], $row['ogLocale'], $row['ogLocaleAlternate1'], $row['ogLocaleAlternate2'], $row['ogUpdatedTime']);
  $siteConfig->setOgImageData($row['ogImageType'], $row['ogImageWidth'], $row['ogImageHeight'], $row['ogImageUrl'], $row['ogImageSecureUrl'], $row['ogImageAlt']);
  $siteConfig->setOgVideoData($row['ogVideoType'], $row['ogVideoWidth'], $row['ogVideoHeight'], $row['ogVideoSecureUrl']);

  return $siteConfig;
}

function getHomeMenuRoute() {
  $select = new SelectQuery();
  $select->query("SELECT * FROM menus ");
  $result = $select->selectByWhere("page = 'Home' ");
  return $result['route'];
}

/**
 * @throws Exception
 */
function getSiteConfig($route = "") {
  $select = new SelectQuery();
  $select->query("SELECT * FROM seo_setting");

  if(!($route === "" || $route === "/" || str_contains($route, 'admin'))) {
    $result = $select->selectByWhere("route = '".$route."' ");

    if($result) return makeSiteConfigData($result);
  }

  // Fetch All Site Config
  $result = $select->selectAll();
  $siteConfigs = array();
  foreach($result as $k=>$v) {
    $siteConfigs[] = makeSiteConfigData($v);
  }

  return $siteConfigs[0];
}

function getAllBlogs() {
  $select = new SelectQuery();
  $select->query("SELECT * FROM blogs ");
  $result = $select->selectAll();
  return $result;
}

function getBlog($route) {
  $select = new SelectQuery();
  $select->query("SELECT * FROM blogs ");
  $result = $select->selectByWhere("route = '".$route."' ");
  return $result;
}

function objectToArray($data) {
  // If the element being looked is an object convert to an array
  if(is_object($data)) {
    $data = get_object_vars($data);
  }
  // If the element is an array, iterate though it and call the function again on each item
  if(is_array($data)) {
      foreach($data as $key=>$value){
          $data[$key] = objectToArray($value);
      }
  }
  return $data;
}

function getMainMenuGroups() {
  $select = new SelectQuery();
  $select->query("
  SELECT menus.* FROM menus
  LEFT JOIN menu_group_mappers ON menus.id = menu_group_mappers.menuId
  LEFT JOIN menu_groups ON menu_group_mappers.menuGroupId = menu_groups.menuGroupId
  WHERE menu_groups.menuGroupType = 'main'
  ORDER BY menus.id
  ");
  $result = $select->selectAll();
  $result = array_map(function($menu){
    $newMenu = $menu;
    $items = '';
    if(!empty($newMenu['items'])) {
      $items = json_decode($newMenu['items']);
      $items = count($items) > 0 ? $items : null;
    }
    $newMenu['items'] = objectToArray($items);
    return $newMenu;
  }, $result);
  // echo '<pre>';print_r($result);die;
  return $result;
}

function CallAPI($method, $url) {
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
  ]);

  $response = curl_exec($curl);
  curl_close($curl);

  return objectToArray(json_decode($response));
}

function getProject($projectId) {
  $url = API_HOST.'/gallery/'.str_replace(' ', '%20', $projectId).'/completed';

  return CallAPI('GET', $url)['data'];
}

function getPagePath($requestUri) {
  $pagePath = "";
  if(strpos(REQUEST_URI, '/projects') !== false) {
    if(REQUEST_URI === '/projects') $pagePath = 'src/pages/Projects.php';
    else {
      $pagePath = 'src/pages/Project.php';
    }
  } else {
    switch(REQUEST_URI){
      case '':
      case '/best-interior-designer-noida':
        $pagePath = 'src/pages/Home.php';
        break;
      case '/about':
        $pagePath = 'src/pages/About.php';
        break;
      case '/services':
      case '/services/all':
      case '/services/residences':
      case '/services/recreation':
      case '/services/modular-kitchen':
      case '/services/livingroom':
        $pagePath = 'src/pages/Services.php';
        break;
      case '/projects':
        $pagePath = 'src/pages/Projects.php';
        break;
      case '/gallery':
        $pagePath = 'src/pages/Gallery.php';
        break;
      case '/contact':
        $pagePath = 'src/pages/Contact.php';
        break;
      case '/faq':
        $pagePath = 'src/pages/Faq.php';
        break;
      case '/blog':
        $pagePath = 'src/pages/Blogs.php';
        break;
      case '/blog/journey-into-interior-design':
      case '/blog/panacheworld-journey-into-interior-design':
        $pagePath = 'src/pages/Blog.php';
        break;
      default:
        $pagePath = "";
        break;
    }
  }

  return $pagePath;
}