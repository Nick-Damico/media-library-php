<?php
$page_title = "Full Catalog";
if (isset($_GET["cat"])) {
  if ($_GET["cat"] == 'books') {
    $page_title = 'Books';
  } else if ($_GET["cat"] == "movies") {
    $page_title = 'Movies';
  } else if ($_GET["cat"] == "music") {
    $page_title = "Music";
  }
} else {
  $page_title = "Opps, this page doesn't exist.";
}
include("inc/header.php");
?>

<div class="section page">
  <h1><?php echo $page_title; ?></h1>
</div>

<?php include("inc/footer.php"); ?>
