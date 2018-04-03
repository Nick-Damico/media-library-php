<?php
// Form Submission Processing.
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $name    = $_POST["name"];
  $email   = $_POST["email"];
  $details = $_POST["details"];

  $email_body = "";
  $email_body .= "Name "    . $name     . "\n";
  $email_body .= "Email "   . $email    . "\n";
  $email_body .= "Details " . $details  . "\n";
  // To Do: Send email
  header("location:suggest.php?status=thanks");
  exit;
}

// Suggest Page Variables
$page_title = "Suggest a Media Item";
$section = "suggest";
if (isset($_GET["status"]) && $_GET["status"] == 'thanks') {
  $page_title = "Thank You";
}
include("inc/header.php");
?>

<div class="section page">

  <div class="wrapper">

    <h1><?php echo $page_title; ?></h1>
    <?php
      if (isset($_GET["status"]) && $_GET["status"] == 'thanks') {
        echo "<p>Thanks for the email! I&rsquo;ll check out your suggestion shortly!</p>";
      } else { ?>
        <p>Something you would like to add? Let me know by completing the form below.</p>
        <form method="post" action="suggest.php">
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
                <th><label for="Suggest Item Details">Suggestion</label></th>
                <td><textarea id="details" name="details"></textarea></td>
            </tr>
          </table>
            <input type="submit" value="Send" />
        </form>
      <?php } ?>
      
  </div>

</div>

<?php include("inc/footer.php"); ?>
