<?php
include("inc/data.php");
$page_title = "Full Catalog";
$section = Null;

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
        foreach($catalog as $item) {
          echo "<li><a href='#'><img src='"
                . $item["img"] . "' alt='"
                . $item["title"] . "' />"
                . "<p>View Details</p>"
                . "</a></li>";
        }
      ?>
    </ul>

  </di>

</div>

<?php include("inc/footer.php"); ?>
