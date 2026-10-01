<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="shortcut icon" href="favicon.png">
<title>Principal Accountants General</title>
<!-- Bootstrap Css -->
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL?>assets/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL?>assets/css/bootstrap-theme.css" />
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL?>assets/css/font-awesome.css" />
<!-- Main Css -->
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL?>assets/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL?>assets/css/menu.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL?>assets/css/blue.css" />
<!--<link href="css/menuzord.css" type="text/css" rel="stylesheet" />-->
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL?>assets/css/responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL?>assets/css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL?>assets/css/owl.theme.default.min.css">
</head>
<body>
<header>
  <div class="header-top light">
    <div class="container">
      <div class="pull-right">
        <ul>
          <li><a href="#">A+</a></li>
          <li><a href="#">A</a></li>
          <li><a href="#">A-</a></li>
        </ul>
        <form class="search-field">
          <input type="text" placeholder="Search"/>
          <img src="<?php echo SITE_BASE_URL?>assets/images/search-icon.png" alt="" class="search-icon" />
        </form>
        <form class="search-field">
          <div class="form-group">
            <select class="form-control" >
              <option>English</option>
              <option>हिंदी</option>
            </select>
          </div>
        </form>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="header-bottom medium">
    <div class="container">
      <div class="flag"> <img src="<?php echo SITE_BASE_URL?>assets/images/flag.png" alt="" /> </div>
      <ul class="logo">
        <li><a href="index.html"> <img src="<?php echo SITE_BASE_URL?>assets/images/logo.png" alt="" /></a></li>
        <li> <img src="<?php echo SITE_BASE_URL?>assets/images/img1.png" alt="" /></li>
      </ul>
    </div>
  </div>
  <div class="menupart dark">
    <nav> <a class="toggleMenu" href="#">Menu</a>
      <ul class="navi">
        <li class="active"><a href="#">About Us </a></li>
        <li><a class="parent" href="#">Principal Accountant General (A & E)</a>
          <ul>
            <li><a class="" href="#">The Office <i class="menu-right-arrow"></i></a>
				<ul>
					<li><a href="#">Introduction</a></li>
					<li><a class="" href="#">Group Officers <i class="menu-right-arrow"></i></a>
						<ul>
							<li><a href="#">AG</a></li>
							<li><a href="#">DAG(Admn)</a></li>
							<li><a href="#">DAG(A/cs)</a></li>
							<li><a href="#">Sr. DAG(Fund)</a></li>
							<li><a href="#">Sr.DAG(Pension)</a></li>
							<li><a href="#">Welfare</a></li>
						</ul>
					</li>
				</ul>
			</li>
            <li><a class="" href="#">General Administration <i class="menu-right-arrow"></i></a>
				<ul>
					<li><a href="#">Organisation Structure</a></li>
					<li><a href="#">Citizen Charter</a></li>
					<li><a href="#">Contact Us</a></li>
				</ul>
			</li>
            <li><a href="#">AdministrationIntroduction <i class="menu-right-arrow"></i></a>
				<ul>
					<li><a href="#">Administration Sections</a></li>
					<li><a href="#">Committees</a></li>
					<li><a href="#">Notice</a></li>
					<li><a href="#">Office Orders/Circular</a></li>
					<li><a href="#">Forms</a></li>
				</ul>
			</li>
			<li><a href="#">In-house Training <i class="menu-right-arrow"></i></a>
				<ul>
					<li><a href="#">Introduction</a></li>
					<li><a href="#">Annual Training Programme</a></li>
					<li><a href="#">Notice</a></li>
					<li><a href="#">Office Order</a></li>
				</ul>
			</li>
			<li><a href="#">Accounts Wing <i class="menu-right-arrow"></i></a>
				<ul>
					<li><a href="#">Introduction</a></li>
					<li><a href="#">Accounts Sections</a></li>
					<li><a href="#">Structure of Accounts</a></li>
					<li><a href="#">Monthly Accounts</a></li>
					<li><a href="#">Annual Accounts <i class="menu-right-arrow"></i></a>
						<ul>
							<li><a href="#">Finance Accounts</a></li>
							<li><a href="#">Appropriation Accounts</a></li>
						</ul>
					</li>
					<li><a href="#">Quarterly Appreciation Note</a></li>
					<li><a href="#">Treasury Inspection <i class="menu-right-arrow"></i></a>
						<ul>
							<li><a href="#">Function</a></li>
							<li><a href="#">Inspection Programme</a></li>
							<li><a href="#">Treasury Inspection Report </a></li>
						</ul>
					</li>
					<li><a href="#">Forms</a></li>
				</ul>
			</li>
			<li><a href="#">Fund Wing <i class="menu-right-arrow"></i></a>
				<ul>
					<li><a href="#">Introduction</a></li>
					<li><a href="#">Standing Instruction <i class="menu-right-arrow"></i></a>
						<ul>
							<li><a href="#">Eligibility</a></li>
							<li><a href="#">GPF subscription</a></li>
							<li><a href="#">Nomination</a></li>
							<li><a href="#">Final Payment</a></li>
						</ul>
					</li>
					<li><a href="#">Guidelines</a></li>
					<li><a href="#">Rates of Interest</a></li>
					<li><a href="#">eGPF Facility <i class="menu-right-arrow"></i></a>
						<ul>
							<li><a href="#">SMS Service</a></li>
							<li><a href="#">eGPF Status Login</a></li>
						</ul>
					</li>
					<li><a href="#">Forms</a></li>
					<li><a href="#">FAQ</a></li>
				</ul>
			</li>
			<li><a href="#">Status of GPF Final Payment Cases</a></li>
			<li><a href="#">Pension Wing <i class="menu-right-arrow"></i></a>
				<ul>
					<li><a href="#">Introduction</a></li>
					<li><a href="#">Authorities for Pension Processing</a></li>
					<li><a href="#">Required Documents for Pension Processing</a></li>
					<li><a href="#">Pension Facilitation Cell</a></li>
					<li><a href="#">SMS service</a></li>
					<li><a href="#">Pension Forms</a></li>
					<li><a href="#">FAQ</a></li>
				</ul>
			</li>
			<li><a href="#">Status of Pension Cses</a></li>
			<li><a href="#">Divisional Accountants Cadre <i class="menu-right-arrow"></i></a>
				<ul>
					<li><a href="#">Introduction</a></li>
					<li><a href="#">List of Division</a></li>
					<li><a href="#">Gradation List</a></li>
					<li><a href="#">Office Order/Circular</a></li>
					<li><a href="#">Training</a></li>
					<li><a href="#">Examination <i class="menu-right-arrow"></i></a>
						<ul>
							<li><a href="#">Examination Schedule</a></li>
							<li><a href="#">Results</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li><a href="#">Publication <i class="menu-right-arrow"></i></a>
				<ul>
					<li><a href="#">Accounts</a></li>
					<li><a href="#">Review Reports</a></li>
				</ul>
			</li>
			<li><a href="#">Tender Notice</a></li>
			<li><a href="#">Right to Information</a></li>
			<li><a href="#">Circular Office Order</a></li>
			<li><a href="#">Download Forms <i class="menu-right-arrow"></i></a>
				<ul>
					<li><a href="#">Administrative Forms</a></li>
					<li><a href="#">Accounts Forms</a></li>
					<li><a href="#">Pension Forms</a></li>
					<li><a href="#">GPF Forms</a></li>
				</ul>
			</li>
          </ul>
        </li>
        <li><a href="#">Principal  Accoutant General (G & SSA)</a></li>
        <li><a href="#">Accountant General (E & RSA)</a> </li>
        <li><a class="parent" href="#">Tender Notice <i class="menu-right-arrow"></i></a>
          <ul>
            <li><a href="#"> Principal Accountant General (A & E)</a></li>
            <li><a href="#"> Principal Accoutant General (G & SSA) </a></li>
            <li><a href="#"> Accountant General (E & RSA)</a></li>
          </ul>
        </li>
        <li><a href="#">Contact Us</a> </li>
      </ul>
    </nav>
  </div>
</header>
<section class="bodysec">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-4">
        <div class="left-panel">
          <div class="quick-link">
            <h3 class="medium">On this site</h3>
            <ul>
              <li><a href="#">Publications</a></li>
              <li><a href="#">Latest Audit Reports</a></li>
              <li><a href="#">Annual Accounts Reports</a></li>
              <li><a href="#">Right to Information Act</a></li>
              <li><a href="#">Working Hours</a></li>
              <li><a href="#">Citizen's Charter</a></li>
              <li><a href="#">Contact Us</a></li>
            </ul>
          </div>
          <div class="quick-link">
            <h3 class="medium">Quick Links</h3>
            <ul>
              <li><a href="#">C & AG of India</a></li>
              <li><a href="#">Accountants General Websites</a></li>
              <li><a href="#">National Portal of India</a></li>
              <li><a href="#">INTOSAI</a></li>
              <li><a href="#">ASOSAI</a></li>
              <li><a href="#">Ministry of India</a></li>
              <li><a href="#">News & Events</a></li>
              <li><a href="#">Photo Gallery</a></li>
            </ul>
          </div>
          <div class="quick-link">
            <div class="pension-case dark"> Status for Pension Cases <a href="#" class="click-here">Click Here >></a> </div>
          </div>
          <div class="quick-link">
            <div class="payment-case gray-bg"> Status of GPS Final Payment Cases <a href="#" class="click-here">Click Here >></a> </div>
          </div>
          <div class="quick-link">
            <div class="green-bg"> REgister Your Grievances/Complaints Regarding GPF/Pension <a href="#" class="click-here">Click Here >></a> </div>
          </div>
          <div class="quick-link">
            <div class="blue-bg medium"> Formats for mandatory Report/Return to be furnished to Pr.A.G.(A&E) by P.S.As/P.D.As <a href="#" class="click-here">Click Here >></a> </div>
          </div>
        </div>
      </div>
      <div class="col-md-9 col-sm-8">
        <div class="right-panel">
          <div class="banner"> <img src="<?php echo SITE_BASE_URL?>assets/images/banner.jpg" alt="" /> </div>
          <div class="about-us">
            <h1>About Us</h1>
            <p>There are 2 Principal Accountant’s General offices and 1 Accountant’s General Office located in Kolkata each having separate work jurisdiction and responsibilities as regards state Accounts and Audit. The Accountant General / Principal Accountants General are the representative of the Comptroller & Auditor General of India who is a Constitutional Authority deriving his powers from Article 148 to 151 of the Constitution of India and the Comptroller and Auditor General’s , Duties, Power and Conditions of service Act, 1971 (CAG’s DPC Act 1971)<a href="#" class="read-more">...Read More</a></p>
          </div>
          <div class="missionsec">
            <div class="row">
              <div class="col-md-7 col-sm-12">
                <div class="our-mission">
                  <h3>Our <span>Mission</span></h3>
                  <p class="add-paddi">Our mission enunciates our current role and describes what we are doing today:</p>
                  <p>Mandated by the constitution of India, We promote accountability, transparency and good governance through high quality auditing and accounting and provide independent assurance to our stakeholders, the Legislature, the Executive and the Public, that public funds are being used efficiently and for the intended purposes.</p>
                </div>
                <div class="our-mission">
                  <h3>Our <span>Vision</span></h3>
                  <p >As one of the pillars of democracy we strive-</p>
                  <p>“To promote exellence in public sector Audit and Accounting Services towards improving the quality of governance”</p>
                </div>
              </div>
              <div class="col-md-5 col-sm-12">
                <div class="newsec dark">
                  <h4>What’s New</h4>
                </div>
                <div class="new-cont medium">
                  <ul>
                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry  Lorem Ipsum has been the </li>
                    <li>Industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a </li>
                    <li>type specimen Book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially</li>
                    <li>It is a long established fact that a reader will be distracted by the readable content </li>
                    <li>Book. It has survived not only five centuries, </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<footer>
  <div class="container">
    <ul>
      <li><a href="#">Sitemap</a></li>
      <li><a href="#">External Links</a></li>
      <li><a href="#">FAQ </a></li>
    </ul>
    <p><img src="<?php echo SITE_BASE_URL?>assets/images/loc-img.png" alt="" />&nbsp; Principal Accountant General (A & E), West Bengal, Treasury Buildings, 2, Govt. Place (West), Kolkata - 700 001</p>
    <p class="foot-text">Developed and designed by National Informatics Centre (NIC) West Bengal State Centre. Contents maintained by<br>
      Principal Accountants General, West Bengal</p>
  </div>
</footer>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Bootstrap Js -->
<script src="<?php echo SITE_BASE_URL?>assets/js/bootstrap.js"></script>
<!-- Bootstrap Js -->
<!--for menu-->
<script src="<?php echo SITE_BASE_URL?>assets/js/script.js"></script>
<!--<script type="text/javascript" src="js/menuzord.js"></script>-->
<!--for menu-->
<!--for owl slider-->
<script src="<?php echo SITE_BASE_URL?>assets/js/owl.carousel.js"></script>
<script>
            $(document).ready(function() {
              var owl = $('.owl-carousel');
              owl.owlCarousel({
                rtl: false,
                margin: 0,
                nav: false,
				autoplay:true,
				autoplayTimeout:4000,
				autoplayHoverPause:true,
                loop: true,
                responsive: {
                  0: {
                    items: 1
                  },
                  600: {
                    items: 1
                  },
                  1000: {
                    items: 1
                  }
                }
              })
            })
          </script>
<script>
   /* jQuery("#menuzord3").menuzord({
					align: "right",
					indicatorFirstLevel: "<i class='fa fa-angle-down'></i>",
					indicatorSecondLevel: "<i class='fa fa-angle-right'></i>"
				});*/
  </script>
</body>
</html>
