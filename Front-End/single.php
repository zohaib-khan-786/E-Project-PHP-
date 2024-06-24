<?php

include('../connection.php');
session_start();

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$requestUri = $_SERVER['REQUEST_URI'];
$referer = $scheme . "://" . $host . $requestUri;


$shipments = [];
if (isset($_GET['tracking_id'])) {

    if (!isset($_SESSION['usercontact'])) {
        header('location: ./index.php');
    }

    $tracking_id = $_GET['tracking_id'];
    $sendercontact = $_SESSION['usercontact'];

    $sql = "SELECT * FROM courier WHERE reference_id = '$tracking_id' AND sender_contact = '$sendercontact'";

    $result = $conn->query($sql);
    if (!$result || $result->num_rows == 0) {
        $no_courier = '<h1 class="text-danger m-2">Sorry, you have not placed any courier</h1>';
    }

    if ($result){
        while ($row = $result->fetch_assoc()) {
            $shipments[] = $row;
        }
    }
    
} else  {

    if (!isset($_SESSION['usercontact'])) {
        header('location: index.php');   
    }
    $contact = $_SESSION['usercontact'];
    
    $sql = "SELECT * FROM courier WHERE sender_contact = '$contact' AND status = 'delivered'";
    
    $result = $conn->query($sql);

    if ($result){
        while ($row = $result->fetch_assoc()) {
            $shipments[] = $row;
        }
    }
    
} 
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FASTER - Logistics Company Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark d-none d-lg-block">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center text-white">
                    <small><i class="fa fa-phone-alt mr-2"></i>0334-125-3094</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>shaniraffat5@gmail.com</small>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-white pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-lg-5">
    <a href="index.php" class="app-brand-link d-flex align-items-center m-2">
              <span class="app-brand-logo demo">
                <svg
                  width="25"
                  viewBox="0 0 25 42"
                  version="1.1"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink">
                  <defs>
                    <path
                      d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                      id="path-1"></path>
                    <path
                      d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                      id="path-3"></path>
                    <path
                      d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                      id="path-4"></path>
                    <path
                      d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                      id="path-5"></path>
                  </defs>
                  <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                      <g id="Icon" transform="translate(27.000000, 15.000000)">
                        <g id="Mask" transform="translate(0.000000, 8.000000)">
                          <mask id="mask-2" fill="white">
                            <use xlink:href="#path-1"></use>
                          </mask>
                          <use fill="#696cff" xlink:href="#path-1"></use>
                          <g id="Path-3" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-3"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                          </g>
                          <g id="Path-4" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-4"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                          </g>
                        </g>
                        <g
                          id="Triangle"
                          transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                          <use fill="#696cff" xlink:href="#path-5"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
            </span>
            <h2 class="app-brand-text demo menu-text fw-bold ms-2 text-primary">Sneat</h2>
            </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
        <div class="navbar-nav m-auto py-0">
            <a href="index.php" class="nav-item nav-link">Home</a>
            <a href="about.php" class="nav-item nav-link">About</a>
            <a href="service.php" class="nav-item nav-link">Service</a>
            <a href="price.php" class="nav-item nav-link">Price</a>
            <?php if (isset($_SESSION['sessionName'])) { ?>
                <a href="single.php" class="nav-item nav-link active">Couriers</a>
            <?php } ?>
            <a href="contact.php" class="nav-item nav-link">Contact</a>
        </div>
        <?php if (!isset($_SESSION['sessionName'])) { ?>
            <a href="../login.php" class="btn btn-primary py-2 px-4 nav-link d-lg-none">Login</a>
            <a href="../login.php" class="btn btn-primary py-2 px-4 d-none d-lg-block">Login</a>
        <?php } else { ?>
            <form method="post" action="../logout.php" class="d-flex">
                <input type="hidden" name="referer" value="<?php echo htmlspecialchars($referer); ?>">
                <button class="btn btn-primary py-2 px-4 nav-link d-lg-none" type="submit" name="logout">Logout</button>
                <button class="btn btn-primary py-2 px-4 d-none d-lg-block" type="submit" name="logout">Logout</button>
            </form>
        <?php } ?>
    </div>
</nav>
    </div>
    <!-- Navbar End -->

    <div class="container mt-5">
        <h1 class="mb-4">Courier Details</h1>
        
        <table class="table table-striped table-computer">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Recipient Name</th>
                    <th>Status</th>
                    <th>Date Placed</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!isset($no_courier)) {
                    
                    if (count($shipments) > 0) {
                        $counter = 1;
                        foreach ($shipments as $row) {
                            echo "<tr class='text-center'>
                            <td class='fw-bold'><strong>{$counter}.</strong></td>
                            <td>{$row['reference_id']}</td>
                            <td>{$row['sender_name']}</td>
                            <td>{$row['recipient_name']}</td>
                            <td>{$row['status']}</td>
                            <td>{$row['date_created']}</td>
                            <td><a class='btn btn-primary d-sm-block' href='../generate_courier_report.php?tracking_id={$row['reference_id']}'>Download Report</a></td>
                            </tr>";

                            $counter++;
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>No couriers found</td></tr>";
                    }
                } else {
                    echo $no_courier;
                }
                ?>
            </tbody>
        </table>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Recipient Name</th>
                        <th>Status</th>
                        <th>Date Placed</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!isset($no_courier)) {
                        if (count($shipments) > 0) {
                            $counter = 1;
                            foreach ($shipments as $row) {
                                echo "<tr class='text-center'>
                                <td class='fw-bold'><strong>{$counter}.</strong></td>
                                <td>{$row['reference_id']}</td>
                                <td>{$row['sender_name']}</td>
                                <td>{$row['recipient_name']}</td>
                                <td>{$row['status']}</td>
                                <td>{$row['date_created']}</td>
                                <td><a class='btn btn-primary d-sm-block' href='../generate_courier_report.php?tracking_id={$row['reference_id']}'>Download Report</a></td>
                                </tr>";
        
                                $counter++;
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No couriers found</td></tr>";
                        }
                    } else {
                        echo $no_courier;
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

    

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-7 col-md-6">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <h3 class="text-primary mb-4">Get In Touch</h3>
                        <p><i class="fa fa-map-marker-alt mr-2"></i>123 Street, Pakistan, Aptech NN2</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>03341253094</p>
                        <p><i class="fa fa-envelope mr-2"></i>shaniraffat5@gmail.com</p>
                        <div class="d-flex justify-content-start mt-4">
                            <a class="btn btn-outline-light btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <h3 class="text-primary mb-4">Quick Links</h3>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-white mb-2" href="about.php"><i class="fa fa-angle-right mr-2"></i>About Us</a>
                            <a class="text-white mb-2" href="service.php"><i class="fa fa-angle-right mr-2"></i>Our Services</a>
                            <a class="text-white mb-2" href="price.php"><i class="fa fa-angle-right mr-2"></i>Pricing Plan</a>
                            <a class="text-white" href="contact.php"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 mb-5">
                <h3 class="text-primary mb-4">Newsletter</h3>
                <p>Trust us for secure, on-time deliveries tailored to your needs. Contact us at [Contact Information] for dependable shipping solutions.</p>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 30px;" placeholder="Your Email Address" required>
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4" aria-required="">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: #3E3E4E !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">&copy; <a href="#">Courier Service</a>. All Rights Reserved. 
				
				<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
				Designed by <a href="ht">Shani</a>
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <ul class="nav d-inline-flex">
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Privacy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Terms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Help</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>