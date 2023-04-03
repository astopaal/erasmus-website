<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="assets/styles/contact.css" />
    <link rel="stylesheet" href="assets/styles/style.css" />
    <link rel="stylesheet" href="assets/styles/style-foot.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <title>Contact Us</title>
  </head>
  <body>
    <div class="container">
      <h1>Contact Us</h1>
      <div class="contact-us">
        <form>
          <div class="form-group">
            <input type="text" name="name" id="name" placeholder="Name" required />
            <input type="text" name="surname" id="surname" placeholder="Surname" required />
          </div>
          <div class="form-group">
            <input type="text" name="school" id="school" placeholder="School/Organisation Name" required />
            <input type="text" name="oid-number" id="oid-number" placeholder="OID Number" required />
          </div>
          <div class="form-group">
            <input type="text" name="grant-agreement" id="grant-agreement" placeholder="Erasmus+ Grant Agreement Number" required />
            <input type="email" name="email" id="email" placeholder="Email" required />
          </div>
          <div class="form-group">
            <div class="phone-number">
              <input type="text" name="phone" id="phone" placeholder="Phone Number" required />
              <select name="countryCode" id="countryCode">
                <option value="+90">Turkey (+90)</option>
                <option value="+39">Italy (+39)</option>
                <option value="+389">Macedonia (+389)</option>
                <option value="+72">Estonia (+72)</option>
                <option value="+213">Algeria (+213)</option>
                <option value="+376">Andorra (+376)</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <textarea name="message" id="message" placeholder="Message" required></textarea>
          </div>
          <button type="submit" class="submit-button">Submit</button>
        </form>
      </div>
    </div>
  </body>
</html>
