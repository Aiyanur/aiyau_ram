<!DOCTYPE html>
<html lang="en">
<?php include 'head.php' ?>
<body class="contact" style="background-color: darkgray;">
    <div class="container">
        <nav>
        <a href="#header"><img src="images/BTS_Logo.png" class="logo" /></a>
        <ul>
            <li><a href="index.html" style="color: #262626;">Home</a></li>
            <li><a href="members.html" style="color: #262626;">Fun Facts</a></li>
            <li><a href="contact.html" style="color: #262626;">Contact</a></li>
            <li><a href="discography.html" style="color: #262626;">Discography</a></li>
            <li><a href="thankyou.html" style="color: #262626;">Gratitude</a></li>
        </ul>
        </nav>
    </div>

<div id="contact">
    <div class="container">
      <div class="row">
        <div class="contact-left">
          <h1 class="subtitle">Contact us if you find any misinformation</h1>
          <p>
            Aiyanur Ramazan<br /><i class="fa-solid fa-phone" ></i>
            <a href="tel:+70123456789" style="text-decoration: none; color: #262626;">0123-456-789</a>
          </p>
          <p>email<br /><i class="fa-solid fa-envelope"></i><a href="mailto:test@test.com" style="text-decoration: none; color: #262626;">fake@email.com</a></p>
        </div>

        <form id="contactForm">
          <input type="text" id="name" name="Name" placeholder="Your Name" required />
          <input type="email" id="email" name="email" placeholder="Your email" required/>
          <textarea id="message" name="Message" rows="10" placeholder="Your message"></textarea>
          <div>
            <ul class="permission">
              <li>All content provided on this website is for informational purposes only. The owner of this website makes no representations as to the accuracy or completeness of any information on this site or found by following any link on this site.</li>
              <li>The owner will not be liable for any errors or omissions in this information nor for the availability of this information. The owner will not be liable for any losses, injuries, or damages from the display or use of this information.</li>
            </ul>
          </div>
          <button id="checkboxButton" class="checkbox-button" onclick="toggleCheck()">Submit</button>
        </form>
    <footer>
      <div id="footer-main">
          <div class="slpce">
              <p>
                  It contains the work of Aiya (Aiyanur) and talks about the K Pop band known as BTS.
                  The name stands for the Korean phrase Bangtan Sonyeondan (Korean: 방탄소년단; Hanja: 防彈少年團),
                  which translates literally to 'Bulletproof Boy Scouts'.
              </p>

          </div>
          <div class="copyright">
              <p> © Aiyanur Ramazan</p>
          </div>
      </div>
  </footer>
</div>
</body>
</html>
