<?php
include("inc/data.php");
include("inc/functions.php");
$page_title = "Full Catalog";
$section = null;

if (isset($_GET["cat"])) {
  if ($_GET["cat"] == 'books') {
    $page_title = 'Books';
    $section = 'books';
  } else if ($_GET["cat"] == "movies") {
    $page_title = 'Movies';
    $section = 'movies';
  } else if ($_GET["cat"] == "music") {
    $page_title = "Music";
    $section = 'music';
  } else if ($_GET["cat"] == 'games') {
    $page_title = 'Games';
    $section = 'games';
  }
} else {
  $page_title = "Opps, this page doesn't exist.";
}
include("inc/header.php");
?>

<div class="section catalog page">

  <div class="wrapper">

    <h1><?php echo $page_title; ?></h1>
    <ul class="items">
      <?php
      $categories = array_category($catalog, $section);
      foreach($categories as $id) {
        echo get_item_html($id, $catalog[$id]);
      }
      ?>
    </ul>

  </di>

</div>

<?php include("inc/footer.php"); ?>
