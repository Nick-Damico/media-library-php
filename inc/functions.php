<?php
function get_item_html($id, $item) {
  $output = "<li><a href='#'><img src='"
        . $item["img"] . "' alt='"
        . $item["title"] . "' />"
        . "<p>View Details</p>"
        . "</a></li>";
 return $output;
}

function array_category($catalog, $category) {
  $output = array();
  foreach($catalog as $id => $item) {
    if ($category == null || strtolower($item["category"]) == strtolower($category) ) {
      $sort = $item["title"];
      $sort = ltrim($sort, "The ");
      $sort = ltrim($sort, "A ");
      $sort = ltrim($sort, "And ");
      $output[$id] = $sort;
    }
  }

  asort($output);
  return array_keys($output);
}
