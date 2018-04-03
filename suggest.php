<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/SMTP.php';

// Form Submission Processing.
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $name    = trim( filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING) );
  $email   = trim( filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL) );
  $details = trim( filter_input(INPUT_POST, "details", FILTER_SANITIZE_SPECIAL_CHARS) );

  // Form Validations
  if ($name == '' || $email == "" || $details == "") {
    echo "Please fill in the required fields: Name, Email, and Details";
    exit;
  }
  if ($_POST["address"] != '') {
    echo "Bad form input";
    exit;
  }
  if (!PHPMailer::validateAddress($email)) {
    echo "Invalid Email Address";
    exit;
  }

  $email_body = "";
  $email_body .= "Name "    . $name     . "\n";
  $email_body .= "Email "   . $email    . "\n";
  $email_body .= "Details " . $details  . "\n";
  // To Do: Send email

  $mail = new PHPMailer(true);
  //Tell PHPMailer to use SMTP
  $mail->isSMTP();
  //Enable SMTP debugging
  // 0 = off (for production use)
  // 1 = client messages
  // 2 = client and server messages
  $mail->SMTPDebug = 2;
  //Set the hostname of the mail server
  $mail->Host = 'smtp.gmail.com';
  // use
  // $mail->Host = gethostbyname('smtp.gmail.com');
  // if your network does not support SMTP over IPv6
  //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
  $mail->Port = 587;
  //Set the encryption system to use - ssl (deprecated) or tls
  $mail->SMTPSecure = 'tls';
  //Whether to use SMTP authentication
  $mail->SMTPAuth = true;
  //Username to use for SMTP authentication - use full email address for gmail
  $mail->Username = "nickd28@gmail.com";
  //Password to use for SMTP authentication
  $mail->Password = "";                        // Passing `true` enables exceptions
  //Recipients
  $mail->setFrom('nickalan82@icloud.com', $name);
  $mail->addReplyTo($email, $name);
  $mail->addAddress('nickd28@gmail.com', $name);     // Add a recipient
  //Content
  // $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'Media Library Suggestion: ' . $name;
  $mail->Body    = $email_body;
  // Send
  if (!$mail->send()) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    exit;
  }
  header("location:suggest.php?status=thanks");
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
            <tr style="display:none">
                <th><label for="address">Address</label></th>
                <td><textarea id="address" name="address"></textarea></td>
                <p>Please leave this input blank on submission.</p>
            </tr>
          </table>
            <input type="submit" value="Send" />
        </form>
      <?php } ?>

  </div>

</div>

<?php include("inc/footer.php"); ?>
