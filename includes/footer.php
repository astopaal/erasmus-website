<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Footer</title>
  <link rel="stylesheet" href="assets/styles/style-foot.css">
</head>

<body>
  <footer class="footer">
    <br>
    <div class="contact">
      <div class="footer-left">
        <div>
          <img src="assets/icons/location.png">
          <p>Prof Dr Yaşar UÇAR caddesi Zabıta binası kat:2 no:204 Serik/Antalya/TÜRKİYE</p>
          <img src="assets/icons/mail.png">
          <p>erasmusmobilityturkey@gmail.com</p>
          <div class="websites">

            <a href="https://www.facebook.com/username/"><img src="assets/icons/facebook.png" alt="fb-photo"></a>
            <a href="https://twitter.com/username"><img src="assets/icons/twitter.png" alt="twitter-photo"></a>
            <a href="https://www.linkedin.com/in/username/"><img src="assets/icons/linkedin.png"
                alt="linkedin-photo"></a>
            <a href="https://www.instagram.com/username/"><img src="assets/icons/instagram.png"
                alt="instagram-photo"></a>
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
        <form method="POST">
          <div class="name-field">
            <div class="name">
              <label for="name">First Name</label>
              <input id="name" name="name" type="text">
            </div>
            <div class="name">
              <label for="surname">Last Name</label>
              <input id="surname" name="surname" type="text">
            </div>
          </div>
          <label for="email">Email *</label>
          <input id="email" name="email" type="email" required>
          <label for="comment">Message</label>
          <textarea name="comment" id="comment"></textarea>
          <input type="submit" value="Send">
        </form>
      </div>
    </div>
    <div class="copyright">
      <p>copyright©2023, denemesirket.com</p>
    </div>
<?php 
require_once("db/dbhelper.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  $name = $_POST["name"];
  $surname = $_POST["surname"];
  $email = $_POST["email"];
  $comment = $_POST["comment"];
  $db = new DBController();
  $query = "insert into messages (name, surname, mail, message, okundu_mu) values ('$name' , '$surname' , '$email' , '$comment' , 0 ) ";
  $insert = $db->insertQuery($query);
  if(isset($insert)) {
    echo '<script>alert("We have received your message, we will return as soon as possible by e-mail or phone."); window.location.href = "index.php";</script>';
} 
}
?>
  </footer>
</body>

</html>