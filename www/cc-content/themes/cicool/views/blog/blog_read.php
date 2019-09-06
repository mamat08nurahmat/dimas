<?= get_header(); 
$blogs = explode(',', $blog->image);
?>
<?php if (isset($blogs[0])): ?>
<meta property="og:image" content="<?= BASE_URL . 'uploads/blog/' . $blogs[0]; ?>">
<link rel="image_src" 
      type="image/jpeg" 
      href="<?= BASE_URL . 'uploads/blog/' . $blogs[0]; ?>" />
<meta property="og:image:type" content="image/png">
<?php endif ?>

<meta name="description" content="<?= substr($blog->title, 0, 299) ?>">
<meta name="og:title" property="og:title" content="<?= substr($blog->title, 0, 299) ?>">
<meta name="author" content="<?= $blog->author ?>">
<meta name="robots" content="index, follow">
<link href="<?= theme_asset(); ?>/css/clean-blog.css" rel="stylesheet">

<body id="page-top">
   <?= get_navigation(); ?>

    <!-- Page Header -->
      <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/post-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-heading">
              <h1><?= $blog->title ?></h1>
              <span class="meta">Posted by
                <a href="#"><?= $blog->author ?></a>
                on <?= (new DateTime($blog->created_at))->format('M d, Y') ?></span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Post Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-lg-8 col-md-10 mx-auto">
             <?php $this->cc_app->eventListen('blog_read_top', $blog) ?>

             <div id="share"></div>

              <?php if (!empty($blog->image)): 
                 
                ?>
                  <div id="blogGalery" class="carousel slide" data-ride="carousel">
                  <?php if (count($blogs) > 1): ?>
                  <ol class="carousel-indicators">
                  <?php for($i =0; $i < count($blogs); $i++): ?>
                    <li data-target="#blogGalery" data-slide-to="<?= $i ?>" class="<?= $i == 0 ? 'active': '' ?>"></li>
                  <?php endfor; ?>
                  </ol>
                  <?php endif; ?>

                  <div class="carousel-inner" role="listbox">
                    <?php $a=0; foreach($blogs as $galery): $a++?>
                    <div class="item <?= $a == 1 ? 'active' : '' ?>">
                      <img src="<?= BASE_URL . 'uploads/blog/' . $galery; ?>" alt="image <?= $a ?>" width="100%">
                      
                    </div>
                    <?php endforeach ?>

                  </div>

                  <?php if (count($blogs) > 1): ?>

                  <a class="left carousel-control" href="#blogGalery" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#blogGalery" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>

                  <?php endif ?>
                </div>

              <?php endif; ?>

             

             
            <p class="blog-content-detail" style="font-size: 20px"><?= ($blog->content) ?></p>
            <small class="text-muted"><i class="fa fa-tag"></i> <a href="<?= site_url('blog/category/'.$blog->category.'/'.url_title($blog->category_name)) ?>" title="categories"><?= $blog->category_name ?></a> | <i class="fa fa-search"></i> <?= $blog->viewers ?></small>
            <br>
            <br>
            <?php foreach (explode(',', $blog->tags) as $tag):?>
              <a href="<?= site_url('blog/tag/'.trim($tag)) ?>" class="blog-tag-item"># <?= $tag ?></a>
            <?php endforeach ?>
            
              <?php is_allowed('blog_update', function() use ($blog){?>

              <a href="<?= site_url('administrator/blog/edit/' . $blog->id); ?>" class="blog-tag-item btn-primary"><i class="fa fa-edit "></i> <?= cclang('update_button'); ?></a>
              <?php }) ?>

              <?php $this->cc_app->eventListen('blog_read_bottom', $blog) ?>
             


              <?php if(count($related)): ?>
                <br>
                <br>
                <div style="border-bottom: 1px solid #ccc"></div>
                <br>
                <h3>Related Articles</h3>
              <?php endif ?>
              <?php foreach ($related as $related): ?> 
              <div class="post-preview">
                <a href="<?= site_url('blog/'.$blog->slug) ?>">
                  <h2 class="post-title">
                    <?= substr($related->title, 0, 50) ?>
                  </h2>
                  <h3 class="post-subtitle">
                    <?= substr(strip_tags($related->content), 0, 100) ?>
                  </h3>
                </a>
                <p class="post-meta">Posted by
                  <a href="#"><?= $related->author ?></a>
                  on <?= (new DateTime())->format('M d, Y') ?></p>
              </div>
              <hr>
              <?php endforeach ?>

          </div>
        </div>
      </div>

    </article>

    <link rel="stylesheet" type="text/css" href="<?= theme_asset(); ?>vendor/jsocial/dist/jssocials.css" />
    <link rel="stylesheet" type="text/css" href="<?= theme_asset(); ?>vendor/jsocial/dist/jssocials-theme-flat.css" />
    <script src="<?= theme_asset(); ?>vendor/jsocial/dist/jssocials.min.js"></script>
    <script>
        $("#share").jsSocials({
            shares: ["twitter", {
              share: "facebook",          
              label: "Share",            
          }
          , "whatsapp"]
        });
    </script>

   <?= get_footer(); ?>