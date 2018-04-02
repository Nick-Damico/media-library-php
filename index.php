<?php
$page_title = 'Personal Media Library';
$section = Null;
include("inc/data.php");
include("inc/functions.php");
include("inc/header.php");
?>
<!DOCTYPE html>

		<div class="section catalog random">

			<div class="wrapper">

				<h2>May we suggest something?</h2>

				<ul class="items">
					<?php
		        foreach($catalog as $id => $item) {
		          echo get_item_html($id, $item);
		        }
		      ?>
				</ul>

			</div>

		</div>
<?php include("inc/footer.php") ?>
