<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/styles/contact.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/style-foot.css">
</head>

<body>
    <div class="container">
        <h1>Contact Us</h1>


        <div class="contact-us">
            <div class="informations">
                <form>
                    <label for="name2">Name *</label><input type="text" name="" id="name2" required>
                    <label for="surname2">Surname *</label><input type="text" name="" id="surname2" required>
                    <label for="school-name">School/Organisation Name *</label><input type="text" name=""
                        id="school-name" required>
                    <label for="oid-number">OID Number *</label><input type="text" name="" id="oid-number" required>
                    <label for="agreement-num">Erasmus+ Grant Agreement Number *</label><input type="text" name=""
                        id="agreement-num" required>
                    <label for="email2">Email *</label><input type="email" name="" id="email2" required>
                    <div class="number-field">
                        <div class="phone-number">
                            <label for="countryCode">Code</label>
                            <select name="countryCode" id="countryCode">
                                <option data-countryCode="TR" value="90" Selected>Turkey (+90)</option>
                                <option data-countryCode="IT" value="39">Italy (+39)</option>
                                <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                                <option data-countryCode="EST" value="372">Estonia (+72)</option>
                                <optgroup label="Other countries">
                                    <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                                    <option data-countryCode="AD" value="376">Andorra (+376)</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="phone-number">
                            <label for="number2">Phone Number</label>
                            <input type="text" id="number2" required>
                        </div>
                    </div>
                    <div class="msg-box">
                        <label for="txt-area">Message *</label>
                        <textarea name="" id="txt-area"></textarea>
                    </div>
                    <div class="submit-button">
                        <input type="submit" id="contact-submit" value="Submit">
                    </div>
            </div>
            </form>
        </div>
    </div>
</body>