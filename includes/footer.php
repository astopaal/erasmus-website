<link rel="stylesheet" href="assets/styles/style-foot.css" media="print" onload="this.media='all'">
<div class="footer">
  <br>
  <div class="footer-contact">
    <div class="footer-left">
      <div>
        <img src="assets/icons/location.png">
        <p>Prof Dr Yaşar UÇAR caddesi Zabıta binası kat:2 no:204 Serik/Antalya/TÜRKİYE</p>
        <img src="assets/icons/mail.png">
        <p>erasmusmobilityturkey@gmail.com</p>
        <div class="websites">

          <a href="https://www.facebook.com/username/"><img src="assets/icons/facebook.png" alt="fb-photo"></a>
          <a href="https://twitter.com/username"><img src="assets/icons/twitter.png" alt="twitter-photo"></a>
          <a href="https://www.linkedin.com/in/username/"><img src="assets/icons/linkedin.png" alt="linkedin-photo"></a>
          <a href="https://www.instagram.com/username/"><img src="assets/icons/instagram.png" alt="instagram-photo"></a>
        </div>
      </div>
    </div>

    <div class="map">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d195.43823568902997!2d27.075564800179652!3d38.39497688318127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1str!2str!4v1680528380910!5m2!1str!2str"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="footer-right">
      <h1>Contact</h1>
      <form id="footer-contact-form" action="blog.php" name="contact-form" method="POST">
        <div class="footer-name-field">
          <div class="footer-name">
            <label for="footer-name">First Name</label>
            <input id="footer-name" name="footer-name" type="text">
          </div>
          <div class="footer-name">
            <label for="footer-surname">Last Name</label>
            <input id="footer-surname" name="footer-surname" type="text">
          </div>
        </div>
        <label for="footer-email">Email *</label>
        <input id="footer-email" name="footer-email" type="email" required>
        <label for="footer-comment">Message</label>
        <textarea name="footer-comment" id="footer-comment"></textarea>
        <input name="footer-contact-submit" id="footer-submit" type="submit" value="Send">
      </form>
    </div>
  </div>
  <div class="copyright">
    <p>copyright©2023, projectsamp.com</p>
  </div>
  <?php
  require_once("db/dbhelper.php");
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['footer-contact-submit'])) {

    $name = $_POST["footer-name"];
    $surname = $_POST["footer-surname"];
    $email = $_POST["footer-email"];
    $comment = $_POST["footer-comment"];

    $db = new DBController();
    $query = "INSERT INTO messages (name, surname, mail, message, has_been_read) VALUES ('$name','$surname' ,'$email' ,'$comment', b'0' )";
    $insert = $db->insertQuery($query);

    if ($insert) {
      echo '<script>alert("We have received your message, we will return as soon as possible by e-mail or phone."); window.location.href = "index.php";</script>';
    } else {
      echo "31";
    }
  }
  ?>
</div>