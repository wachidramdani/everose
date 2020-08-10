<div class="breadcrumb parallax-container">
  <div class="parallax"><img src="<?=base_url("assets/moonstore/ms01/image/prlx.jpg");?>" alt="#"></div>
  <h1><?=$page->title_page;?></h1>
  <ul>
    <li><a href="<?=base_url();?>">Home</a></li>
    <li><a href="<?=base_url("page/$page->url_page");?>"><?=$page->title_page;?></a></li>
  </ul>
</div>
<div class="container">
    <?=$page->body_page;?>
</div>