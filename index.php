<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    $to = "alex@petran.sk";
    $subject = "Nová správa z kontaktného formulára";
    
    $email_content = "Meno: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Správa:\n$message\n";
    
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    if(mail($to, $subject, $email_content, $headers)) {
        echo "<script>
                alert('Správa bola úspešne odoslaná!');
                window.location.href = 'index.php#contact';
              </script>";
    } else {
        echo "<script>
                alert('Prepáčte, pri odosielaní správy nastala chyba.');
                window.location.href = 'index.php#contact';
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penzión Rotunda</title>
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/3158/3158030.png">
    <link rel="stylesheet" href="index.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery-1.9.1.min.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    html {
        scroll-behavior: smooth;
        scroll-padding-top: 70px; 
    }

    body, html {
    margin: 0;
    padding: 0;
    font-family: 'lato', sans-serif;
    background-color: #f5f7fa;
}
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 5%;
    background-color: #fff;
    color: #000;
    position: fixed;
    width: 100%;
    box-sizing: border-box;
    height: 70px;
    top: 0;
    z-index: 1000;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
footer {
  
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 5%;
    color: #000;
    width: 100%;
    box-sizing: border-box;
    height: 70px;
    bottom: 0;
    background-color: #2C3E50;
    box-shadow: 0 2px 5px rgba(255, 255, 255, 0.1);

}

.logo {
    font-weight: bold;
    font-size: 1.2rem;
    margin-left: 80px;
}

@media (max-width: 768px) {
    .logo {
        margin-left: 20px; /* Smaller margin on mobile */
    }
}

nav {
    margin-right: 100px;
    font-size: 1.0rem;
}

nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
}

nav ul li {
    margin-left: 30px;
}

nav ul li a {
    color: #000;
    text-decoration: none;
    padding: 6px 15px;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.3s;
    font-size: 1rem;
}

nav ul li a:hover {
    background-color: rgba(0, 0, 0, 0.1);
    transform: scale(1.1);
}

.menu-toggle {
    display: flex;
    flex-direction: column;
    cursor: pointer;
    margin-right: 20px;
}
.menu-toggle div {
    width: 25px;
    height: 3px;
    background-color: #000;
    margin: 4px 0;
}
        @media (max-width: 768px) {
            nav ul {
                flex-direction: column;
                width: 100%;
                background-color: #ffffff;
                position: absolute;
                top: 70px;
                left: 0;
                max-height: 0;
                opacity: 0;
                overflow: hidden;
                transition: max-height 0.4s ease, opacity 0.4s ease;
            }
            nav ul.open {
                max-height: 300px;
                opacity: 1;
            }
            nav ul li {
                margin: 0;
                text-align: center;
                border-bottom: 1px solid rgba(0,0,0,0.1);
            }
            nav ul li a {
                display: block;
                padding: 15px 10px;
            }
            .menu-toggle {
                display: flex;
            }
        }
        .hero {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }
        .hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .hero-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff;
        }
        .fade-in {
            opacity: 0;
            animation: fadeIn 0.5s ease-in forwards;
            animation-delay: 0.2s;
        }
        .fade-in-delayed {
            opacity: 0;
            animation: fadeIn 0.5s ease-in forwards;
            animation-delay: 0.2s;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .rooms {
            padding: 50px 5%;
            background-color: #f5f7fa;
        }
        .room-list-container {
            position: relative;
            overflow: hidden;
        }
        .room-list {
            display: flex;
            transition: transform 0.5s ease;
        }
        .room {
            flex: 0 0 100%;
            margin: 0 2.5%;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        .room img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .room h3 {
            margin: 15px 0 10px;
            font-size: 1.5rem;
        }
        .room p {
            margin: 0 0 15px;
            font-size: 1rem;
            color: #666;
        }
        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 1000;
        }
        .arrow-left {
            left: 10px;
        }
        .arrow-right {
            right: 10px;
        }
        @media (min-width: 769px) {
            .room {
                flex: 0 0 45%;
            }
        }
        .about {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 5%;
            background-color: #f9f9f9;
            margin-top: 70px; /* Add margin to account for fixed header */
        }
        .about-container {
            display: flex;
            flex-direction: row;
            max-width: 1200px;
            width: 100%;
        }
        .about-image {
            flex: 1;
            margin-right: 20px;
        }
        .about-image img {
            width: 100%;
            border-radius: 10px;
        }
        .about-text {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .about-text h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .about-text p {
            font-size: 1.2rem;
            line-height: 1.6;
        }
        @media (max-width: 768px) {
            .about-container {
                flex-direction: column;
            }
            .about-image {
                margin-right: 0;
                margin-bottom: 20px;
            }
        }
        .about {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 50px 5%;
    background-color: #f9f9f9;
  }
  .about-container {
    display: flex;
    flex-direction: row;
    max-width: 1200px;
    width: 100%;
  }
  .about-image {
    flex: 1;
    margin-right: 20px;
  }
  .about-image img {
    width: 100%;
    height: auto;
    max-height: 400px; /* Adjust the max height as needed */
    border-radius: 10px;
  }
  .about-text {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  .about-text h2 {
    font-size: 2.5rem;
    margin-bottom: 20px;
  }
  .about-text p {
    font-size: 1.2rem;
    line-height: 1.6;
  }
  @media (max-width: 768px) {
    .about-container {
      flex-direction: column;
    }
    .about-image {
      margin-right: 0;
      margin-bottom: 20px;
    }
  }
  .about {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 50px 5%;
    background-color: #f9f9f9;
  }
  .about-container {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    max-width: 1200px;
    width: 100%;
  }
  .about-image, .about-text {
    flex: 1 1 45%;
    margin: 10px;
  }
  .about-image img {
    width: 100%;
    height: auto;
    max-height: 400px; /* Adjust the max height as needed */
    border-radius: 10px;
  }
  .about-text {
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  .about-text h2 {
    font-size: 2.5rem;
    margin-bottom: 20px;
  }
  .about-text p {
    font-size: 1.2rem;
    line-height: 1.6;
  }
  @media (max-width: 768px) {
    .about-container {
      flex-direction: column;
    }
    .about-image, .about-text {
      margin-right: 0;
      margin-bottom: 20px;
    }
    nav {
      display: none;
      flex-direction: column;
      width: 100%;
      text-align: center;
      background-color: #fff;
      position: absolute;
      top: 70px;
      left: 0;
      max-height: 0;
      opacity: 0;
      overflow: hidden;
      transition: max-height 0.4s ease, opacity 0.4s ease;
    }
    nav.open {
      max-height: 300px;
      opacity: 1;
    }
    nav ul {
      flex-direction: column;
      width: 100%;
    }
    nav ul li {
      margin: 10px 0;
    }
    .menu-toggle {
      display: flex;
    }
  }
  header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 5%;
    background-color: #fff;
    color: #000;
    position: fixed;
    width: 100%;
    box-sizing: border-box;
    height: 70px;
    top: 0;
    z-index: 1000;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  }
  .logo {
    font-weight: bold;
    font-size: 1.2rem;
  }
  nav {
    margin-right: 100px;
    font-size: 1.0rem;
  }
  nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
  }
  nav ul li {
    margin-left: 30px;
  }
  .menu-toggle {
    display: none;
    flex-direction: column;
    cursor: pointer;
  }
  .menu-toggle div {
    width: 25px;
    height: 3px;
    background-color: #000;
    margin: 4px 0;
  }
  @media (max-width: 768px) {
    .menu-toggle {
      display: flex;
    }
  }
    </style>
</head>
<body>
    <header>
        <a href="#" class="logo">
            <img src="https://cdn-icons-png.flaticon.com/512/3158/3158030.png" alt="Penzión Rotunda Logo" height="40">
        </a>
        <nav>
            <ul>
                <li><a href="#about">O nás</a></li>
                <li><a href="#ubytovanie">Ubytovanie</a></li>
                <li><a href="#kontakt">Kontakt</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb" alt="Hotel">
        <div class="hero-text">
            <h1 class="fade-in" style="font-size: 4.0rem;">Reštaurácia Rotunda</h1>
            <p class="fade-in-delayed" style="font-size: 1.6rem;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
    </section>
    <section id="about" class="about">
      <div class="about-container">
        <div class="about-image">
          <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f" alt="About Us">
        </div>
        <div class="about-text">
          <h2>O nás</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
        <div class="about-text">
          <h2>História</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
        <div class="about-image">
          <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786" alt="History">
        </div>
      </div>
    </section>
    <section id="o nas">
      <!-- Your content here -->
    </section>


    </section>
    <section id="ubytovanie">
    <section class="u-align-center u-clearfix u-container-align-center u-section-1" id="block-1">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <h2 class="u-align-center u-text u-text-default u-text-1">Ubytovanie</h2>
        <div class="u-expanded-width u-layout-horizontal u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-container-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1">
                <img class="u-expanded-width u-image u-image-default u-image-1" alt="" data-image-width="2836" data-image-height="1875" src="images/90fc53c9.svg">
                <h4 class="u-align-left u-text u-text-default u-text-2">Apartmán gold</h4>
                <p class="u-align-left u-text u-text-default u-text-3">Sample text. Click to select the Text Element.</p>
              </div>
            </div>
            <div class="u-container-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-top u-container-layout-2">
                <img class="u-expanded-width u-image u-image-default u-image-2" alt="" data-image-width="2836" data-image-height="1875" src="images/90fc53c9.svg">
                <h4 class="u-align-left u-text u-text-default u-text-4">apartmán silver</h4>
                <p class="u-align-left u-text u-text-default u-text-5">Sample text. Click to select the Text Element.</p>
              </div>
            </div>
            <div class="u-container-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-top u-container-layout-3">
                <img class="u-expanded-width u-image u-image-default u-image-3" alt="" data-image-width="2836" data-image-height="1875" src="images/90fc53c9.svg">
                <h4 class="u-align-left u-text u-text-default u-text-6">Izba smart</h4>
                <p class="u-align-left u-text u-text-default u-text-7">Sample text. Click to select the Text Element.</p>
              </div>
            </div>
            <div class="u-container-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-top u-container-layout-4">
                <img class="u-expanded-width u-image u-image-default u-image-4" alt="" data-image-width="2836" data-image-height="1875" src="images/90fc53c9.svg">
                <h4 class="u-align-left u-text u-text-default u-text-8">izba easy </h4>
                <p class="u-align-left u-text u-text-default u-text-9">Sample text. Click to select the Text Element.</p>
              </div>
            </div>
          </div>
          <a class="u-absolute-vcenter u-gallery-nav u-gallery-nav-prev u-grey-70 u-icon-circle u-opacity u-opacity-70 u-spacing-10 u-text-white u-gallery-nav-1" href="#" role="button">
            <span aria-hidden="true">
              <svg viewBox="0 0 451.847 451.847"><path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path></svg>
            </span>
            <span class="sr-only">
              <svg viewBox="0 0 451.847 451.847"><path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path></svg>
            </span>
          </a>
          <a class="u-absolute-vcenter u-gallery-nav u-gallery-nav-next u-grey-70 u-icon-circle u-opacity u-opacity-70 u-spacing-10 u-text-white u-gallery-nav-2" href="#" role="button">
            <span aria-hidden="true">
              <svg viewBox="0 0 451.846 451.847"><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path></svg>
            </span>
            <span class="sr-only">
              <svg viewBox="0 0 451.846 451.847"><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path></svg>
            </span>
          </a>
        </div>
      </div>
      <!-- Your content here -->
    </section>

    <section id="contact" class="contact-section">
  <!-- Left side with background -->
  <div class="contact-info">
    <div class="overlay"></div>
    <div class="contact-content">
      <h2>Kontaktujte nás</h2>
      <div class="info-item">
        <i class="fas fa-map-marker-alt"></i>
        <p>Nám. sv. Egídia 44, Poprad</p>
      </div>
      <div class="info-item">
        <i class="fas fa-phone"></i>
        <p>+421 123 456 789</p>
      </div>
      <div class="info-item">
        <i class="fas fa-envelope"></i>
        <p>info@rotunda.sk</p>
      </div>
    </div>
  </div>

  <!-- Right side with form -->
  <div id="kontakt" class="contact-form">
    <form target="_blank" action="https://formsubmit.co/alexpetran06@gmail.com" method="POST">
      <h2>Napíšte nám správu</h2>
      <div class="form-group">
        <input type="text" name="name" placeholder="Meno a priezvisko" required>
      </div>
      <div class="form-group">
        <input type="email" name="email" placeholder="Váš email" required>
      </div>
      <div class="form-group">
        <input type="tel" 
               name="phone" 
               placeholder="Telefónne číslo (+421 XXX XXX XXX)" 
               pattern="[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{3,6}"
               required>
      </div>
      <div class="form-group">
        <textarea name="message" placeholder="Vaša správa" required></textarea>
      </div>
      <button type="submit">Odoslať správu</button>
    </form>
  </div>
</section>
<section class="map-section">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d326.63571641881634!2d19.613089506344075!3d49.08501113398007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471599308d67ed59%3A0xf9342c7f6ae7faef!2sPenzion%20Rotunda!5e0!3m2!1ssk!2ssk!4v1738321099585!5m2!1ssk!2ssk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>
<footer>
        <a href="#" class="logo">
            <img src="https://cdn-icons-png.flaticon.com/512/3158/3158030.png" alt="Penzión Rotunda Logo" height="40">
        </a>
        <nav>
            <ul>
                <li><a href="#about">O nás</a></li>
                <li><a href="#ubytovanie">Ubytovanie</a></li>
                <li><a href="#kontakt">Kontakt</a></li>
            </ul>
        </nav>
    </footer>
<style>
.contact-section {
  display: grid;
  grid-template-columns: 1fr 1fr;
  min-height: 600px;
}

.contact-info {
  position: relative;
  background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4');
  background-size: cover;
  background-position: center;
  color: white;
  padding: 4rem;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.7);
}

.contact-content {
  position: relative;
  z-index: 2;
}

.contact-content h2 {
  font-size: 2.5rem;
  margin-bottom: 2rem;
}

.info-item {
  display: flex;
  align-items: center;
  margin-bottom: 1.5rem;
}

.info-item i {
  font-size: 1.5rem;
  margin-right: 1rem;
}

.contact-form {
  padding: 4rem;
  background: white;
}

.contact-form h2 {
  font-size: 2rem;
  margin-bottom: 2rem;
  color: #333;
}

.form-group {
  margin-bottom: 1.5rem;
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 1rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 1rem;
  transition: all 0.3s ease;
}

.form-group textarea {
  height: 150px;
  resize: vertical;
}

.form-group input:focus,
.form-group textarea:focus {
  border-color: #0056b3;
  outline: none;
  box-shadow: 0 0 0 2px rgba(0,86,179,0.1);
}

button[type="submit"] {
  width: 100%;
  padding: 1rem;
  background: #0056b3;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

button[type="submit"]:hover {
  background: #003d82;
  transform: translateY(-2px);
}

@media (max-width: 768px) {
  .contact-section {
    grid-template-columns: 1fr;
  }
  
  .contact-info, 
  .contact-form {
    padding: 2rem;
  }
  
  .contact-info {
    min-height: 400px;
  }
}

.map-section {
    width: 100%;
    height: 450px;
    margin: 0;
    padding: 0;
}

.map-section iframe {
    width: 100%;
    height: 100%;
    border: none;
}

@media (max-width: 768px) {
    .map-section {
        height: 300px;
    }
}

.logo img {
    height: 40px;
    width: auto;
    margin-left: 40px;
}

@media (max-width: 768px) {
    .logo img {
        margin-left: 20px;
        height: 35px;
    }
}
</style>

    <script>
        function toggleMenu() {
            const nav = document.querySelector('nav ul');
            nav.classList.toggle('open');
        }

      document.addEventListener('DOMContentLoaded', function() {
        const ubytovanieLink = document.querySelector('nav ul li a[href="#ubytovanie"]');
        const ubytovanieSection = document.getElementById('ubytovanie');

        if (ubytovanieLink && ubytovanieSection) {
          ubytovanieLink.addEventListener('click', function(event) {
            event.preventDefault();
            ubytovanieSection.scrollIntoView({ behavior: 'smooth' });
          });
        }
      });

      // Ensure page starts at top on load
      window.onbeforeunload = function () {
          window.scrollTo(0, 0);
      }
    </script>
    <script>
  // Form validation
  (() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
  })()
</script>
</body>
</html>