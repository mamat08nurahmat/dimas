<?= get_header(); ?>
<link href="<?= theme_asset(); ?>/css/clean-blog.css" rel="stylesheet">

<body id="page-top">
   <?= get_navigation(); ?>
  


    <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/home-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1><?= ucwords(get_option('site_name')) ?> Blog</h1>
              <span class="subheading">
                All blogs
                <?php if ($category = $this->uri->segment(4)): ?>
                  - <?= $category ?>
                <?php endif ?>
              </span>
            </div>
          </div>
        </div>
      </div>
    </header>

      <!-- Main Content -->
    <div class="container">
      <div class="row">
       <div class="col-md-1">
        </div>
        <div class="col-md-10 ">
           <?php if ($q = $this->input->get('q')): ?>
          <div class="pull-left result-search"><b>Result for keyword "<?=$q ?>", found <span class="count-search-result"><?= $blog_counts ?></span> Blogs</b></div>
          <?php else : ?>
          <div class="pull-left result-search"><b>Total : <span class="count-search-result"><?= $blog_counts ?></span> Blogs</b></div>
          <?php endif ?>
          <div class="search-wrapper">
            <form action="" method="get" accept-charset="utf-8" id="form-blog-search">
            <input type="" name="q" class="blog-input-search" placeholder="Search" value="<?= $this->input->get('q') ?>">
            <a class="blog-search-button" onclick="$('#form-blog-search').submit()">
              <i class="fa fa-search"></i>
            </a>
            </form>
          </div>
          <div class="clearfix">
            
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10 ">
         
          <?php foreach ($blogs as $blog): ?> 
          <div class="post-preview">
            <a href="<?= site_url('blog/'.$blog->slug) ?>">
              <h2 class="post-title">
                <?= substr($blog->title, 0, 50) ?>
              </h2>
              <h3 class="post-subtitle">
                <?= substr(strip_tags($blog->content), 0, 100) ?>
              </h3>
            </a>
            <p class="post-meta">Posted by
              <a href="#"><?= $blog->author ?></a>
              on <?= (new DateTime())->format('M d, Y') ?></p>
          </div>
          <hr>
          <?php endforeach ?>

          <!-- Pager -->
          <div class="clearfix">
            <?= $pagination ?>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="clear">
    <div class="clear">
    </div>
    </div>


   <?= get_footer(); ?>