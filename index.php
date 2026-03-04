<?php include 'includes/header.php'; ?>

<?php if(isset($success)) { ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php } ?>

<!-- ================= HERO SECTION ================= -->
<section class="hero-section">
  <div class="hero-content text-center text-white">
    <h1 class="display-4 fw-bold">Green Tech Water Solutions Pvt. Ltd.</h1>
    <p class="lead mt-3">Leading STP, ETP & Water Treatment Company in Kerala</p>
    <div class="mt-4">
      <a href="pages/contact.php" class="btn btn-primary btn-lg me-3">Get Free Consultation</a>
      <a href="pages/services.php" class="btn btn-outline-light btn-lg">Our Services</a>
    </div>
  </div>
</section>

<!-- ================= ABOUT SECTION ================= -->

<section class="about-section py-5">
  <div class="m-5">

    <!-- Center Heading -->
    <div class="text-center mb-5">
      <h6 class="text-uppercase text-white fw-bold">About Us</h6>
    </div>

    <div class="row align-items-center">

      <!-- Image 50% -->
      <div class="col-lg-6 mb-4 slide-left">
        <div class="about-img">
          <img src="./assets/images/about.webp" class="img-fluid shadow-lg" alt="About Green Tech Water Solutions">
        </div>
      </div>

      <!-- Content 50% -->
      <div class="col-lg-6 slide-right">
        <h2 class="fw-bold">Green Tech Water Solutions Pvt. Ltd.</h2>
        <p>Leading STP & Water Treatment Company in Thiruvananthapuram, Kerala.</p>
        <p>
          Green Tech Water Solutions Pvt. Ltd. is a trusted name in sewage treatment and water purification solutions. 
          We specialize in designing, supplying, installing, and maintaining advanced Sewage Treatment Plants (STP), 
          Effluent Treatment Plants (ETP), and Water Treatment Systems.
        </p>
        <p>
          With years of technical expertise and commitment to sustainability, we ensure every project meets pollution 
          control standards and delivers long-term performance with minimal operational cost.
        </p>

        <div class="row mt-4">
          <div class="col-sm-6">
            <ul class="list-unstyled">
              <li>✔ Expert Engineering Team</li>
              <li>✔ Custom Designed Solutions</li>
              <li>✔ Government Approved Systems</li>
              <li>✔ Eco-Friendly Technology</li>
            </ul>
          </div>
          <div class="col-sm-6">
            <ul class="list-unstyled">
              <li>✔ Affordable Pricing</li>
              <li>✔ On-Time Project Delivery</li>
              <li>✔ AMC & Maintenance Support</li>
              <li>✔ 24/7 Customer Assistance</li>
            </ul>
          </div>
        </div>

        <div class="mt-4">
          <a href="pages/contact.php" class="btn btn-primary px-4 py-2 shadow">Get Free Consultation</a>
        </div>
      </div>

    </div>
  </div>
</section>



<!-- ================= SERVICES SECTION ================= -->
<section class="section-padding">
  <div class="text-center m-5">
    <h2 class="mb-5">Our Services</h2>

    <div class="row">

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img src="assets/images/stp.jpg" class="card-img-top" alt="STP">
          <div class="card-body">
            <h5>Sewage Treatment Plant (STP)</h5>
            <p>Advanced sewage treatment solutions for residential and commercial projects.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img src="assets/images/effluent-treatment.jpg" class="card-img-top" alt="ETP">
          <div class="card-body">
            <h5>Effluent Treatment Plant (ETP)</h5>
            <p>Industrial wastewater treatment systems with high efficiency.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img src="assets/images/equipiers-traitement.jpg" class="card-img-top" alt="Maintenance">
          <div class="card-body">
            <h5>Operation & Maintenance</h5>
            <p>Professional maintenance and monitoring services for all treatment plants.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img src="assets/images/consult.png" class="card-img-top" alt="Consulting">
          <div class="card-body">
            <h5>Consulting & Advisory</h5>
            <p>Expert guidance to plan, implement, and optimize water treatment systems.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
<!-- ================= CALL TO ACTION ================= -->
<section class="call-to-action text-white text-center py-5">
  <div class="container">
    <h2 class="fw-bold">Need Water Treatment Solutions?</h2>
    <p class="mt-3">Contact Green Tech Water Solutions Pvt. Ltd. today for professional and reliable services.</p>
      <a href="pages/contact.php" class="btn btn-primary px-4 py-2 shadow">Request a Quote</a>
   
  </div>
</section>



<!-- ================= CONTACT SECTION ================= -->
<?php include 'pages/contact.php' ?>

<a href="https://wa.me/917025262747" 
   target="_blank" 
   class="whatsapp-float">
   <i class="fab fa-whatsapp"></i>
</a>

