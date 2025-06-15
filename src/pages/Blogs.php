<?php $blogs = getAllBlogs(); ?>

<div class="conatainer">
  <div class="siteCssWidth1200">
    <div class="blog-preview marginTop50 marginBottom100">
      <div class="inner">
        <h1 id="/blog" class="header1">Blogs</h1>
        <ul>
          <?php foreach($blogs as $blog) { ?>
          <li>
            <a href="/blog/<?php echo $blog['route']; ?>"><h2 class="header2"><?php echo $blog['title']; ?></h2></a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</div>