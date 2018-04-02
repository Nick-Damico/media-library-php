<?php
$page_title = "Suggest a Media Item";
$section = "suggest";
include("inc/header.php");
?>

<div class="section page">

  <div class="wrapper">

    <h1>Suggest a Media Item</h1>
    <p>Something you would like to add? Let me know by completing the form below.</p>
    <form method="post" action="process.php">
      <table>
        <tr>
            <th><label for="name">Name</label></th>
            <td> <input id="name" type="text" name="name" /></td>
        </tr>
        <tr>
            <th><label for="email">Email</label></th>
            <td> <input id="email" type="email" name="email" /></td>
        </tr>
        <tr>
            <th><label for="Suggest Item Details">Email</label></th>
            <td><textarea id="details" name="details"></textarea></td>
        </tr>
      </table>
        <input type="submit" value="Send" />
    </form>
  </div>

</div>

<?php include("inc/footer.php"); ?>
