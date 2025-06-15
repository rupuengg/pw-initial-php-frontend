<?php $blog = getBlog(str_replace('/blog/', '', REQUEST_URI)); ?>

<div class="conatainer">
  <div class="siteCssWidth1200">
    <div class="blog-preview marginTop50 marginBottom100">
      <div class="inner">
        <div class="header">
          <a title="Back" aria-current="page" class="active" href="/blog">Back</a
          >
          <h1 id="/blog" class="header1">
            <span><?php echo $blog['title']; ?></span>
          </h1>
        </div>
        
        <?php echo $blog['description']; ?>
      </div>
    </div>
  </div>
</div>
