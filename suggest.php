<?php
use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/SMTP.php';

// Form Submission Processing.
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $name    = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
    $email   = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $details = trim(filter_input(INPUT_POST, "details", FILTER_SANITIZE_SPECIAL_CHARS));

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
    $mail->Password = "djxfebligavsebwc";                        // Passing `true` enables exceptions
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
      } else {
          ?>
        <p>Something you would like to add? Let me know by completing the form below.</p>
        <form method="post" action="suggest.php">
          <table>
            <tr>
                <th><label for="name">Name</label></th>
                <td> <input id="name" type="text" name="name" /></td>
            </tr>
            <tr>
                <th><label for="email">Email</label></th>
                <td><input id="email" type="email" name="email" /></td>
            </tr>
            <tr>
                <th><label for="category">Category</label></th>
                <td>
                  <select id="category" name="category">
                    <option value="">Select One</option>
                    <option value=Books>Book</option>
                    <option value="Movies">Movie</option>
                    <option value="Music">Music</option>
                    <option value="Games">Game</option>
                  </select>
                </td>
            </tr>
            <tr>
                <th><label for="title">Title</label></th>
                <td><input id="title" type="text" name="title" /></td>
            </tr>
            <tr>
                <th><label for="Suggest Item Details">Suggestion</label></th>
                <td><textarea id="details" name="details"></textarea></td>
            </tr>
            <tr>
                <th><label for="format">Format</label></th>
                <td>
                  <select id="format" name="format">
                    <option value="">Select One</option>

                    <optgroup label=Books>
                      <option value="Audio">Audio</option>
                      <option value="Ebook">Ebook</option>
                      <option value="Paperback">Paperback</option>
                      <option value="Hardback">Hardback</option>
                    </optgroup>

                    <optgroup label="Movies">
                      <option value="Blu-ray">Blu-ray</option>
                      <option value="DVD">DVD</option>
                      <option value="Streaming">Streaming</option>
                      <option value="VHS">VHS</option>
                    </optgroup>

                    <optgroup label="Music">
                      <option value="Cassette">Cassette</option>
                      <option value="CD">CD</option>
                      <option value="MP3">MP3</option>
                      <option value="Vinyl">Vinyl</option>
                    </optgroup>

                    <optgroup label="Games">
                      <option value="Digital Download">Digital Download</option>
                      <option value="Mobile">Mobile</option>
                      <option value="Nintendo">Nintendo</option>
                      <option value="Playstation">Playstation</option>
                      <option value="PC">PC</option>
                      <option value="Xbox">Xbox</option>
                    </optgroup>

                  </select>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="genre">Genre</label>
                </th>
                <td>
                    <select name="genre" id="genre">
                        <option value="">Select One</option>
                        <optgroup label="Books">
                            <option value="Action">Action</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Comedy">Comedy</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Historical">Historical</option>
                            <option value="Historical Fiction">Historical Fiction</option>
                            <option value="Horror">Horror</option>
                            <option value="Magical Realism">Magical Realism</option>
                            <option value="Mystery">Mystery</option>
                            <option value="Paranoid">Paranoid</option>
                            <option value="Philosophical">Philosophical</option>
                            <option value="Political">Political</option>
                            <option value="Romance">Romance</option>
                            <option value="Saga">Saga</option>
                            <option value="Satire">Satire</option>
                            <option value="Sci-Fi">Sci-Fi</option>
                            <option value="Tech">Tech</option>
                            <option value="Thriller">Thriller</option>
                            <option value="Urban">Urban</option>
                        </optgroup>
                        <optgroup label="Movies">
                            <option value="Action">Action</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Animation">Animation</option>
                            <option value="Biography">Biography</option>
                            <option value="Comedy">Comedy</option>
                            <option value="Crime">Crime</option>
                            <option value="Documentary">Documentary</option>
                            <option value="Drama">Drama</option>
                            <option value="Family">Family</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Film-Noir">Film-Noir</option>
                            <option value="History">History</option>
                            <option value="Horror">Horror</option>
                            <option value="Musical">Musical</option>
                            <option value="Mystery">Mystery</option>
                            <option value="Romance">Romance</option>
                            <option value="Sci-Fi">Sci-Fi</option>
                            <option value="Sport">Sport</option>
                            <option value="Thriller">Thriller</option>
                            <option value="War">War</option>
                            <option value="Western">Western</option>
                        </optgroup>
                        <optgroup label="Music">
                            <option value="Alternative">Alternative</option>
                            <option value="Blues">Blues</option>
                            <option value="Classical">Classical</option>
                            <option value="Country">Country</option>
                            <option value="Dance">Dance</option>
                            <option value="Easy Listening">Easy Listening</option>
                            <option value="Electronic">Electronic</option>
                            <option value="Folk">Folk</option>
                            <option value="Hip Hop/Rap">Hip Hop/Rap</option>
                            <option value="Inspirational/Gospel">Insirational/Gospel</option>
                            <option value="Jazz">Jazz</option>
                            <option value="Latin">Latin</option>
                            <option value="New Age">New Age</option>
                            <option value="Opera">Opera</option>
                            <option value="Pop">Pop</option>
                            <option value="R&B/Soul">R&amp;B/Soul</option>
                            <option value="Reggae">Reggae</option>
                            <option value="Rock">Rock</option>
                        </optgroup>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="year">Year</label></th>
                <td> <input id="year" type="text" name="year" placeholder="ex. 2001" /></td>
            </tr>
            <tr style="display:none">
                <th><label for="address">Address</label></th>
                <td><textarea id="address" name="address"></textarea></td>
                <p>Please leave this input blank on submission.</p>
            </tr>
          </table>
            <input type="submit" value="Send" />
        </form>
      <?php
      } ?>

  </div>

</div>

<?php include("inc/footer.php"); ?>
