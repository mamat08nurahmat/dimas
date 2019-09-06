<?= get_header(); ?>
<body id="page-top">
   <?= get_navigation(); ?>

  
   <header>
      <div class="header-content" >
         <div class="header-content-inner">
            <h1 id="homeHeading"><?= cclang('get_your_system_cms_ecomerce_in_one_time'); ?></h1>
            <hr>
            <p><?= cclang('cicool_web_builder_is_used__incridible'); ?></p>
            <a href="<?= site_url('page/about'); ?>" class="btn btn-primary btn-xl page-scroll"><?= cclang('find_out_more'); ?></a>
         </div>
      </div>
   </header>
   <section class="bg-primary" id="about">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
               <h2 class="section-heading"><?= cclang('we_have_got_what_you_need'); ?></h2>
               <hr class="light">
               <p class="text-faded"><?= cclang('cicool_made_to_facilitate__complex_application'); ?></p>
               <a href="https://codecanyon.net/item/cicool-page-form-rest-api-and-crud-generator/19207897?ref=ridwanskaterocks" class="page-scroll btn btn-default btn-xl sr-button"><?= cclang('buy_now'); ?></a>
            </div>
         </div>
      </div>
   </section>
   <section class="bg-black">
        <div class="container">
           <div class="row">
               <div id="myCarousel" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                  </ol>

                  <div class="carousel-inner" role="listbox">
                    <div class="item active">
                      <img src="<?= theme_asset(); ?>img/cr-01.jpg" alt="Chania">
                      <div class="carousel-caption">
                        <h3>Hii Tech</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium sequi, modi, delectus velit optio perspiciatis consequuntur sapiente vel, earum maxime, voluptas nostrum quidem ab. Sunt reiciendis, suscipit facere ut sint?</p>
                      </div>
                    </div>

                    <div class="item">
                      <img src="<?= theme_asset(); ?>img/cr-02.jpg" alt="Chania">
                      <div class="carousel-caption">
                        <h3>Hii Tech</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat voluptate aut excepturi explicabo, fuga reiciendis nostrum ipsum, voluptatem illo quam voluptatibus praesentium odio optio sit aspernatur adipisci maxime debitis magnam!</p>
                      </div>
                    </div>

                    <div class="item">
                      <img src="<?= theme_asset(); ?>img/cr-03.jpg" alt="Flower">
                      <div class="carousel-caption">
                        <h3>Hii Tech</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum ab natus deserunt tenetur magni labore quia eos quo velit maxime voluptatum explicabo vitae libero maiores quas, sapiente, molestias dolorum minima.</p>
                      </div>
                    </div>

                    <div class="item">
                      <img src="<?= theme_asset(); ?>img/cr-04.jpg" alt="Flower">
                      <div class="carousel-caption">
                        <h3>Hii Tech</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id quae reprehenderit officia eaque, facere velit, quidem ipsum esse optio aliquid voluptas beatae, blanditiis explicabo non aspernatur, et porro odio magni.</p>
                      </div>
                    </div>
                  </div>

                  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                </div>
       </div>
   </section>
   <section class="bg-primary" >
      <div class="container">
         <div class="row">
            <div class="col-md-6">
               <div class="box box-primary">
                  <div class="box-header with-border">
                     <h3 class="box-title">Area Chart</h3>
                  </div>
                  <div class="box-body chart-responsive">
                     <div class="chart" id="revenue-chart" style="height: 300px;"></div>
                  </div>
               </div>
               <div class="box box-danger">
                  <div class="box-header with-border">
                     <h3 class="box-title">Donut Chart</h3>
                  </div>
                  <div class="box-body chart-responsive">
                     <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="box box-info">
                  <div class="box-header with-border">
                     <h3 class="box-title">Line Chart</h3>
                  </div>
                  <div class="box-body chart-responsive">
                     <div class="chart" id="line-chart" style="height: 300px;"></div>
                  </div>
               </div>
               <div class="box box-success">
                  <div class="box-header with-border">
                     <h3 class="box-title">Bar Chart</h3>
                  </div>
                  <div class="box-body chart-responsive">
                     <div class="chart" id="bar-chart" style="height: 300px;"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section id="services">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center">
               <h2 class="section-heading"><?= cclang('common_features'); ?></h2>
               <hr class="primary">
            </div>
         </div>
      </div>
      <div class="container">
         <div class="row">
            <div class="col-lg-3 col-md-6 text-center">
               <div class="service-box">
                  <i class="fa fa-4x fa-cubes text-primary sr-icons"></i>
                  <h3>Rest API Builder</h3>
                  <p class="text-muted"><?= cclang('make_rest_api_builder__generate_documentation'); ?></p>
               </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
               <div class="service-box">
                  <i class="fa fa-4x fa-file-text-o text-primary sr-icons"></i>
                  <h3>Page Builder</h3>
                  <p class="text-muted"><?= cclang('you_can_make_dinamic_pages__element_avaiable', '<span class="text-primary">50+</span>'); ?></p>
               </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
               <div class="service-box">
                  <i class="fa fa-4x fa-newspaper-o text-primary sr-icons"></i>
                  <h3>Form Builder</h3>
                  <p class="text-muted"><?= cclang('by_dragging_form_into_canvas__dinamic_form'); ?></p>
               </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
               <div class="service-box">
                  <i class="fa fa-4x fa-code text-primary sr-icons"></i>
                  <h3>Crud Builder</h3>
                  <p class="text-muted"><?= cclang('build_your_crud_in_one_click__input_type', [
                    '<span class="text-primary">35+</span>',
                    '<span class="text-primary">20+</span>',
                  ]); ?></p>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-3 col-md-6 text-center  col-lg-offset-3">
               <div class="service-box">
                  <i class="fa fa-4x fa-rocket text-primary sr-icons"></i>
                  <h3><?= cclang('easy_installation'); ?></h3>
                  <p class="text-muted"><?= cclang('installation_just_one_sec__installation'); ?></p>
               </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
               <div class="service-box">
                  <i class="fa fa-4x  fa-desktop text-primary sr-icons"></i>
                  <h3><?= cclang('awesome_theme'); ?></h3>
                  <p class="text-muted"><?= cclang('awesome_admin_lte__abdullah_almsaeed', 'Abdullah Almsaeed'); ?></p>
               </div>
            </div>
         </div>
      </div>
   </section>
   <aside class="bg-dark">
      <div class="container text-center">
         <div class="call-to-action">
            <h2><?= cclang('buy_now_and_you_wil_not_be_reversal'); ?></h2>
            <a href="https://codecanyon.net/item/cicool-page-form-rest-api-and-crud-generator/19207897?ref=ridwanskaterocks" class="btn btn-default btn-xl sr-button"><?= cclang('buy_now'); ?>!</a>
         </div>
      </div>
   </aside>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
   <script src="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.min.js"></script>
   <script>
      $(function () {
        "use strict";
      
        // AREA CHART
        var area = new Morris.Area({
          element: 'revenue-chart',
          resize: true,
          data: [
            {y: '2011 Q1', item1: 2666, item2: 2666},
            {y: '2011 Q2', item1: 2778, item2: 2294},
            {y: '2011 Q3', item1: 4912, item2: 1969},
            {y: '2011 Q4', item1: 3767, item2: 3597},
            {y: '2012 Q1', item1: 6810, item2: 1914},
            {y: '2012 Q2', item1: 5670, item2: 4293},
            {y: '2012 Q3', item1: 4820, item2: 3795},
            {y: '2012 Q4', item1: 15073, item2: 5967},
            {y: '2013 Q1', item1: 10687, item2: 4460},
            {y: '2013 Q2', item1: 8432, item2: 5713}
          ],
          xkey: 'y',
          ykeys: ['item1', 'item2'],
          labels: ['Item 1', 'Item 2'],
          lineColors: ['#a0d0e0', '#3c8dbc'],
          hideHover: 'auto'
        });
      
        // LINE CHART
        var line = new Morris.Line({
          element: 'line-chart',
          resize: true,
          data: [
            {y: '2011 Q1', item1: 2666},
            {y: '2011 Q2', item1: 2778},
            {y: '2011 Q3', item1: 4912},
            {y: '2011 Q4', item1: 3767},
            {y: '2012 Q1', item1: 6810},
            {y: '2012 Q2', item1: 5670},
            {y: '2012 Q3', item1: 4820},
            {y: '2012 Q4', item1: 15073},
            {y: '2013 Q1', item1: 10687},
            {y: '2013 Q2', item1: 8432}
          ],
          xkey: 'y',
          ykeys: ['item1'],
          labels: ['Item 1'],
          lineColors: ['#3c8dbc'],
          hideHover: 'auto'
        });
      
        //DONUT CHART
        var donut = new Morris.Donut({
          element: 'sales-chart',
          resize: true,
          colors: ["#3c8dbc", "#f56954", "#00a65a"],
          data: [
            {label: "Download Sales", value: 12},
            {label: "In-Store Sales", value: 30},
            {label: "Mail-Order Sales", value: 20}
          ],
          hideHover: 'auto'
        });
        //BAR CHART
        var bar = new Morris.Bar({
          element: 'bar-chart',
          resize: true,
          data: [
            {y: '2006', a: 100, b: 90},
            {y: '2007', a: 75, b: 65},
            {y: '2008', a: 50, b: 40},
            {y: '2009', a: 75, b: 65},
            {y: '2010', a: 50, b: 40},
            {y: '2011', a: 75, b: 65},
            {y: '2012', a: 100, b: 90}
          ],
          barColors: ['#00a65a', '#f56954'],
          xkey: 'y',
          ykeys: ['a', 'b'],
          labels: ['CPU', 'DISK'],
          hideHover: 'auto'
        });
      });
   </script>

   <?= get_footer(); ?>