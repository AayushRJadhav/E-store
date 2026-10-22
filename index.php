<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
</head>
<body>
     

<section id="header">

    <!-- Estore Logo -->
    <a href="index.php">
        <img src="logo1.png" class="logo" alt="Estore logo"
             height="100" width="160">
    </a>

    <!-- Navigation Bar -->
    <div>
        <ul id="navbar">

            <li><a class="active" href="index.php">Home</a></li>
            <li><a href="shop.html">Shop</a></li>
            <li><a href="blog.html">Blog</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>

            <!-- Cart Icon -->
            <li>
                <a href="cart.html" aria-label="Shopping cart">🛒</a>
            </li>
              <li class="profile-menu">
                 <a href="<?= !empty($_SESSION['logged_in'])
                         ? 'account.php'
                          : 'login.php' ?>"
                              id="profile-icon"
                              aria-label="Customer account">
                             <i class="fa-regular fa-user"></i>
                             </a>
                </li> 
</section>

    <section id="Hero">
        <h4>Trade-in-offer</h4>
        <h2>Super Value deals</h2>
        <h1>On all Products</h1>
        <p>Save more with coupons & up to 70% off!</p>
        <button>Shop Now</button>

    </section>

<section id="feature" class="section-p1">
    <div class="fe-box">
        <img src="img/f1.png">
        <h6>Free Shipping</h6>
    </div>

     <div class="fe-box">
        <img src="img/f2.png">
        <h6>Online order</h6>
    </div>

     <div class="fe-box">
        <img src="img/f3.png">
        <h6>Save Money</h6>
    </div>

     <div class="fe-box">
        <img src="img/f4.png">
        <h6>Promotions</h6>
    </div>

     <div class="fe-box">
        <img src="img/f5.png">
        <h6>Happy Sell</h6>
    </div>

     <div class="fe-box">
        <img src="img/f6.png">
        <h6>F24/7 Support</h6>
    </div>
</section>

<section id="Product1" class="section-p1">
  <h2>Featured Product</h2>
  <p>Summer Collection New Model Design</p>

  <div class="products-grid">

    <article class="product-card">
      <div class="product-image">
        <img src="img/product/f1.jpg" alt="Blue casual shirt">
      </div>
      <p class="product-brand">Zudio</p>
      <h2 class="product-title">Blue Casual Shirt</h2>
      <div class="product-rating">★★★★★</div>
      <div class="product-bottom">
        <span class="product-price">$78</span>
        <button class="cart-button" type="button">🛒</button>
      </div>
    </article>

    <article class="product-card">
      <div class="product-image">
        <img src="img/product/f2.jpg" alt="Gray casual shorts">
      </div>
      <p class="product-brand">Puma</p>
      <h2 class="product-title">Gray Casual Shorts</h2>
      <div class="product-rating">★★★★★</div>
      <div class="product-bottom">
        <span class="product-price">$89</span>
        <button class="cart-button" type="button">🛒</button>
      </div>
    </article>

    <article class="product-card">
      <div class="product-image">
        <img src="img/product/f3.jpg" alt="Brown utility shirt">
      </div>
      <p class="product-brand">adidas</p>
      <h2 class="product-title">Brown Utility Shirt</h2>
      <div class="product-rating">★★★★★</div>
      <div class="product-bottom">
        <span class="product-price">$99</span>
        <button class="cart-button" type="button">🛒</button>
      </div>
    </article>

    <article class="product-card">
      <div class="product-image">
        <img src="img/product/f4.jpg" alt="Black casual shirt">
      </div>
      <p class="product-brand">USPA</p>
      <h2 class="product-title">Black Casual Shirt</h2>
      <div class="product-rating">★★★★★</div>
      <div class="product-bottom">
        <span class="product-price">$120</span>
        <button class="cart-button" type="button">🛒</button>
      </div>
    </article>

    <article class="product-card">
      <div class="product-image">
        <img src="img/product/f5.jpg" alt="White printed shirt">
      </div>
      <p class="product-brand">Levi's</p>
      <h2 class="product-title">White Printed Shirt</h2>
      <div class="product-rating">★★★★★</div>
      <div class="product-bottom">
        <span class="product-price">$82</span>
        <button class="cart-button" type="button">🛒</button>
      </div>
    </article>

    <article class="product-card">
      <div class="product-image">
        <img src="img/product/f6.jpg" alt="Green summer shirt">
      </div>
      <p class="product-brand">Roadster</p>
      <h2 class="product-title">Green Summer Shirt</h2>
      <div class="product-rating">★★★★★</div>
      <div class="product-bottom">
        <span class="product-price">$75</span>
        <button class="cart-button" type="button">🛒</button>
      </div>
    </article>

    <article class="product-card">
      <div class="product-image">
        <img src="img/product/f7.jpg" alt="Floral casual shirt">
      </div>
      <p class="product-brand">H&M</p>
      <h2 class="product-title">Floral Casual Shirt</h2>
      <div class="product-rating">★★★★★</div>
      <div class="product-bottom">
        <span class="product-price">$80</span>
        <button class="cart-button" type="button">🛒</button>
      </div>
    </article>

    <article class="product-card">
      <div class="product-image">
        <img src="img/product/f8.jpg" alt="Red printed shirt">
      </div>
      <p class="product-brand">Allen Solly</p>
      <h2 class="product-title">Red Printed Shirt</h2>
      <div class="product-rating">★★★★★</div>
      <div class="product-bottom">
        <span class="product-price">$85</span>
        <button class="cart-button" type="button">🛒</button>
      </div>
    </article>

  </div>
</section>

<section class="offer-banner">
  <img src="img/mid image.png" alt="Sunglasses and accessories offer">

  <div class="offer-content">
    <p class="offer-small-text">Repair Services</p>

    <h2>
      Up to <span>70% Off</span>  All t-Shirts & Accessories
    </h2>

    <a href="#Product1" class="explore-button">Explore Now</a>
  </div>
</section>

</div>
<section id="Product2" class="section-p1">
   <h2>New Arrival</h2>
  <p>Summer Collection New Model Design</p>

  
<div class="products-grid">

    <article class="product-card">
      <div class="product-image">
        <img src="img/product/n1.jpg" alt="Blue casual shirt">
      </div>
      <p class="product-brand">Zudio</p>
      <h2 class="product-title">Blue Casual Shirt</h2>
      <div class="product-rating">★★★★★</div>
      <div class="product-bottom">
        <span class="product-price">$78</span>
        <button class="cart-button" type="button">🛒</button>
      </div>
    </article>

    <article class="product-card">
      <div class="product-image">
        <img src="img/product/n2.jpg" alt="Gray casual shorts">
      </div>
      <p class="product-brand">Puma</p>
      <h2 class="product-title">Gray Casual Shorts</h2>
      <div class="product-rating">★★★★★</div>
      <div class="product-bottom">
        <span class="product-price">$78</span>
        <button class="cart-button" type="button">🛒</button>
      </div>
    </article>

    <article class="product-card">
      <div class="product-image">
        <img src="img/product/n3.jpg" alt="Brown utility shirt">
      </div>
      <p class="product-brand">adidas</p>
      <h2 class="product-title">White Utility Shirt</h2>
      <div class="product-rating">★★★★★</div>
      <div class="product-bottom">
        <span class="product-price">$78</span>
        <button class="cart-button" type="button">🛒</button>
      </div>
    </article>

    <article class="product-card">
      <div class="product-image">
        <img src="img/product/n4.jpg" alt="Black casual shirt">
      </div>
      <p class="product-brand">USPA</p>
      <h2 class="product-title">Printed Casual Shirt</h2>
      <div class="product-rating">★★★★★</div>
      <div class="product-bottom">
        <span class="product-price">$78</span>
        <button class="cart-button" type="button">🛒</button>
      </div>
    </article>

    <article class="product-card">
      <div class="product-image">
        <img src="img/product/n5.jpg" alt="White printed shirt">
      </div>
      <p class="product-brand">Levi's</p>
      <h2 class="product-title">Plain Blue shirt</h2>
      <div class="product-rating">★★★★★</div>
      <div class="product-bottom">
        <span class="product-price">$82</span>
        <button class="cart-button" type="button">🛒</button>
      </div>
    </article>

    <article class="product-card">
      <div class="product-image">
        <img src="img/product/n6.jpg" alt="Green summer shirt">
      </div>
      <p class="product-brand">Roadster</p>
      <h2 class="product-title">White Summer Short</h2>
      <div class="product-rating">★★★★★</div>
      <div class="product-bottom">
        <span class="product-price">$75</span>
        <button class="cart-button" type="button">🛒</button>
      </div>
    </article>

    <article class="product-card">
      <div class="product-image">
        <img src="img/product/n7.jpg" alt="Floral casual shirt">
      </div>
      <p class="product-brand">H&M</p>
      <h2 class="product-title">Beigh Casual Shirt</h2>
      <div class="product-rating">★★★★★</div>
      <div class="product-bottom">
        <span class="product-price">$80</span>
        <button class="cart-button" type="button">🛒</button>
      </div>
    </article>

    <article class="product-card">
      <div class="product-image">
        <img src="img/product/n8.jpg" alt="Red printed shirt">
      </div>
      <p class="product-brand">Allen Solly</p>
      <h2 class="product-title">Plain Black Shirt</h2>
      <div class="product-rating">★★★★★</div>
      <div class="product-bottom">
        <span class="product-price">$85</span>
        <button class="cart-button" type="button">🛒</button>
      </div>
    </article>

  </div>
</section>

<section class="banner-section">

  <div class="banner-card banner-one">
    <div class="banner-content">
      <p>crazy deals</p>
      <h2>buy 1 get 1 free</h2>
      <span>The best classic dress is on sale at cara</span>
      <a href="#Product1">Learn More</a>
    </div>
  </div>

  <div class="banner-card banner-two">
    <div class="banner-content">
      <p>spring/summer</p>
      <h2>upcoming season</h2>
      <span>The best classic dress is on sale at cara</span>
      <a href="#Product1">Collection</a>
    </div>
  </div>

</section>

<section class="newsletter-section">
  <div class="newsletter-text">
    <h2 style="color: white; font-size: 30px; margin-bottom: 12px;">
  Sign Up For Newsletters
</h2>
    <p>
      Get E-mail updates about our latest shop and
      <span>special offers.</span>
    </p>
  </div>

  <form class="newsletter-form">
    <input
      type="email"
      placeholder="Your email address"
      aria-label="Your email address"
      required
    >
    <button type="submit">Sign Up</button>
  </form>
</section>
<footer class="footer">

  <div class="footer-column contact">
    <img src="logo1.png" alt="Cara logo" class="footer-logo">

    <h3>Contact</h3>
    <p><strong>Address:</strong> Nashik , Maharastra ,India </p>
    <p><strong>Phone:</strong> +01 2222 365 / (+91) 01 2345 6789</p>
    <p><strong>Hours:</strong> 10:00 - 18:00, Mon - Sat</p>

    <h3>Follow Us</h3>
    <div class="social-icons">
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-pinterest-p"></i></a>
      <a href="#"><i class="fab fa-youtube"></i></a>
    </div>
  </div>

  <div class="footer-column">
    <h3>About</h3>
    <a href="about.html">About Us</a>
    <a href="#">Delivery Information</a>
    <a href="#">Privacy Policy</a>
    <a href="#">Terms & Conditions</a>
    <a href="contact.html">Contact Us</a>
  </div>

  <div class="footer-column">
    <h3>My Account</h3>
    <a href="login.php">Sign In</a>
    <a href="cart.html">View Cart</a>
    <a href="#">My Wishlist</a>
    <a href="#">Track My Order</a>
    <a href="contact.html">Help</a>
  </div>

  <div class="footer-column install">
  <h3>Install App</h3>
  <p>From App Store or Google Play</p>

  <div class="app-buttons">
    <img src="img/app/i.jpg" alt="Download on the App Store">
    <img src="img/app/p.jpg" alt="Get it on Google Play">
  </div>

  <p>Secured Payment Gateways</p>
  <img src="img/app/Classic Payment Logo Lineup.png" alt="Payment methods" class="payment-image">
</div>

</footer>

<script src="script.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const profileIcon = document.getElementById("profile-icon");
    const profileDropdown = document.getElementById("profile-dropdown");

    if (profileIcon && profileDropdown) {
        profileIcon.addEventListener("click", function (event) {
            event.preventDefault();

            const isOpen = profileDropdown.classList.toggle("show");
            profileIcon.setAttribute("aria-expanded", isOpen);
        });

        document.addEventListener("click", function (event) {
            if (!event.target.closest(".profile-menu")) {
                profileDropdown.classList.remove("show");
                profileIcon.setAttribute("aria-expanded", "false");
            }
        });
    }
});
</script>

</body>
</html>
