<?php 
$galleryImageKitFolderMapper = array(
  '000_f_142_gulshan_bellina_done' => '000 - F 142 Gulshan Bellina - Done',
  '053_t7_1906_exotica_dreamvilli_done' => '053 - T7 - 1906 - Exotica DreamVilli - Done',
  '012_f_123_gulshan_bellina_done' => '012 - F - 123 - Gulshan Bellina - Done',
  '016_f_044_gulshan_bellina_done' => '016 - F - 044 - Gulshan Bellina - Done',
  '031_f_154_gulshan_bellina_done' => '031 - F - 154 - Gulshan Bellina - Done',
  '043_110_aditya_dhurav_apartment_delhi_done' => '043 - 110 - Aditya - Dhurav Apartment Delhi - Done',
  '049_j_061_subodh_gulshan_bellina_done' => '049 - J - 061 - Subodh - Gulshan Bellina - Done',
  '034_g_3052_gaur_city_14_avenue' => '034 - G 3052 - Gaur City 14 Avenue',
  '013_g_ajay_1004_samridhi_done' => '013 - G - Ajay - 1004 - Samridhi - Done',
  '029_a-_183_gulshan_bellina_done' => '029 - A- 183 - Gulshan Bellina - Done',
  '011_g_044_gulshan_bellina_done' => '011 - G - 044 - Gulshan Bellina - Done',
);

$project = getProject($galleryImageKitFolderMapper[str_replace('/projects/', '', REQUEST_URI)]);
// echo '<pre>';print_r($project);die;
?>
<div class="conatainer">
  <div class="siteCss">
    <div class="project_page marginBottom100">
      <h1 id="/projects" class="header1">Project Gallery</h1>
      <div id="photo-album" class="marginTop50">
        <?php foreach($project as $photo) { ?>
          <a class="gallery-item" href="<?php echo $photo['url']; ?>">
            <img class="img-responsive" src="<?php echo $photo['url']; ?>" />
          </a>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lightgallery.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lg-zoom.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/justifiedGallery@3.8.1/dist/css/justifiedGallery.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lg-thumbnail.css'>
<script src='https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.js'></script>
<script src='https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/lightgallery.umd.js'></script>
<script src='https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/zoom/lg-zoom.umd.js'></script>
<script src='https://cdn.jsdelivr.net/npm/justifiedGallery@3.8.1/dist/js/jquery.justifiedGallery.js'></script>
<script src='https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/thumbnail/lg-thumbnail.umd.js'></script>

<script id="rendered-js">
jQuery("#photo-album").
justifiedGallery({captions: false, lastRow: "hide", rowHeight: 400, margins: 10 }).on("jg.complete", function () {
  window.lightGallery(document.getElementById("photo-album"), {
    autoplayFirstVideo: false,
    pager: false,
    galleryId: "nature",
    plugins: [lgZoom, lgThumbnail],
    mobileSettings: {
      controls: false,
      showCloseIcon: false,
      download: false,
      rotate: false 
    } 
  });
});
</script>