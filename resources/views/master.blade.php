<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Web Bán Bánh Double V</title>
	<base href="{{asset(' ')}}"/>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="Electro Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"
	/>





	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //Meta tag Keywords -->

	<!-- Custom-Files -->
	<link href="source/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Bootstrap css -->
	<link href="source/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Main css -->
	<link rel="stylesheet" href="source/css/fontawesome-all.css">
	<!-- Font-Awesome-Icons-CSS -->
	<link href="source/css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
	<!-- pop-up-box -->
	<link href="source/css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<!-- menu style -->
	<!-- //Custom-Files -->

	<!-- web fonts -->
	<link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
	    rel="stylesheet">
	<!-- //web fonts -->

	<!------------------------------------ABCCCCCCCCC-------------------------------------------------------------------->
	<!--laySilde-->
		  <!-- favicon
    ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">


    <!-- CSS files
    ============================================ -->

    <!-- Boostrap stylesheet -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="assets/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/pe-icon-7-stroke.css">

    <!-- Plugins stylesheet -->
    <link rel="stylesheet" href="assets/css/plugins.css">

    <!-- Master stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Responsive stylesheet -->
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!-- modernizr JS
    ============================================ -->
    <script src="assets/js/modernizr-2.8.3.min.js"></script>
	<!--laySilde-->
	<!------------------------------------ABCCCCCCCCC-------------------------------------------------------------------->
	<!-----------------------------------------LARAVEL-BAN-BANH-GIO-HANG------------------------------------------------------->

	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets-giohang/dest/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets-giohang/dest/vendors/colorbox/example3/colorbox.css">
	<link rel="stylesheet" href="assets-giohang/dest/rs-plugin/css/settings.css">
	<link rel="stylesheet" href="assets-giohang/dest/rs-plugin/css/responsive.css">
	<link rel="stylesheet" title="style" href="assets-giohang/dest/css/style.css">
	<link rel="stylesheet" href="assets-giohang/dest/css/animate.css">
	<link rel="stylesheet" title="style" href="assets-giohang/dest/css/huong-style.css">
	<!-----------------------------------------LARAVEL-BAN-BANH-GIO-HANG------------------------------------------------------->

</head>

<body>
	

	@include('header')
	<!--Noi dung trang-->
	@yield('content')
	<!--END Noi dung trang-->


	<!-- footer -->
	@include('footer')
	<!-- //footer -->

	<!-- js-files -->
	<!-- jquery -->

	<script src="source/js/jquery-2.2.3.min.js"></script>
	<!-- //jquery -->

	<!-- nav smooth scroll -->
	<script>
		$(document).ready(function () {
			$(".dropdown").hover(
				function () {
					$('.dropdown-menu', this).stop(true, true).slideDown("fast");
					$(this).toggleClass('open');
				},
				function () {
					$('.dropdown-menu', this).stop(true, true).slideUp("fast");
					$(this).toggleClass('open');
				}
			);
		});
	</script>
	<!-- //nav smooth scroll -->

	<!-- popup modal (for location)-->
	<script src="source/js/jquery.magnific-popup.js"></script>
	<script>
		$(document).ready(function () {
			$('.popup-with-zoom-anim').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});

		});
	</script>
	<!-- //popup modal (for location)-->

	<!-- cart-js -->
	<script src="source/js/minicart.js"></script>
	<script>
		paypals.minicarts.render(); //use only unique class names other than paypals.minicarts.Also Replace same class name in css and minicart.min.js

		paypals.minicarts.cart.on('checkout', function (evt) {
			var items = this.items(),
				len = items.length,
				total = 0,
				i;

			// Count the number of each item in the cart
			for (i = 0; i < len; i++) {
				total += items[i].get('quantity');
			}

			if (total < 0) {
				alert('The minimum order quantity is 0. Please add more to your shopping cart before checking out');
				evt.preventDefault();
			}
		});
	</script>
	<!-- //cart-js -->

	<!-- password-script -->
	<script>
		window.onload = function () {
			document.getElementById("password1").onchange = validatePassword;
			document.getElementById("password2").onchange = validatePassword;
		}

		function validatePassword() {
			var pass2 = document.getElementById("password2").value;
			var pass1 = document.getElementById("password1").value;
			if (pass1 != pass2)
				document.getElementById("password2").setCustomValidity("Passwords Don't Match");
			else
				document.getElementById("password2").setCustomValidity('');
			//empty string means no validation error
		}
	</script>
	<!-- //password-script -->
	
	<!-- scroll seller -->
	<script src="source/js/scroll.js"></script>
	<!-- //scroll seller -->

	<!-- smoothscroll -->
	<script src="source/js/SmoothScroll.min.js"></script>
	<!-- //smoothscroll -->

	<!-- start-smooth-scrolling -->
	<script src="source/js/move-top.js"></script>
	<script src="source/js/easing.js"></script>
	<script>
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();

				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- //end-smooth-scrolling -->

	<!-- smooth-scrolling-of-move-up -->
	<script>
		$(document).ready(function () {
			/*
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			*/
			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<!-- //smooth-scrolling-of-move-up -->

	<!-- for bootstrap working -->
	<script src="source/js/bootstrap.js"></script>
	<!-- //for bootstrap working -->
	<!-- //js-files -->

	<!------------------------------------ABCCCCCCCCC-------------------------------------------------------------------->
	<!--laySlide-->
	 <!-- JS
    ============================================ -->

    <!-- jQuery JS -->
    <script src="assets/js/jquery.1.12.4.min.js"></script>

    <!-- Popper JS -->
    <script src="assets/js/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins JS -->
    <script src="assets/js/plugins.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
	<!----laySlide-->
	<!------------------------------------ABCCCCCCCCC-------------------------------------------------------------------->



	<!---------------------------------------------LARAVEL-GIOHANG-------------------------------------------------->
	<script src="assets-giohang/dest/js/jquery.js"></script>
	<script src="assets-giohang/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="assets-giohang/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
	<script src="assets-giohang/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
	<script src="assets-giohang/dest/vendors/animo/Animo.js"></script>
	<script src="assets-giohang/dest/vendors/dug/dug.js"></script>
	<script src="assets-giohang/dest/js/scripts.min.js"></script>
	<script src="assets-giohang/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
	<script src="assets-giohang/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script src="assets-giohang/dest/js/waypoints.min.js"></script>
	<script src="assets-giohang/dest/js/wow.min.js"></script>
	<!--customjs-->

	<link rel="stylesheet" type="text/css" href="assets-giohang/dest/css/slick-theme.css"/>

		<link rel="stylesheet" type="text/css" href="assets-giohang/dest/css/slick.css"/>
	<script type="text/javascript" src="myscript/slick.min.js"></script>
	<script type="text/javascript">
    $(document).ready(function(){
      $('#slickimg').slick({
        	infinite: true,//Lặp lại
			accessibility:true,
			slidesToShow: 3,
		  	slidesToScroll: 1, //Số item cuộn khi chạy
		  	autoplay:false,  //Tự động chạy
			autoplaySpeed:1000,  //Tốc độ chạy
			speed:1000,//Tốc độ chuyển slider
			arrows:true, //Hiển thị mũi tên
			centerMode:false,  //item nằm giữa
			dots:false,  //Hiển thị dấu chấm
			draggable:true,  //Kích hoạt tính năng kéo chuột
			mobileFirst:true,
			pauseOnHover:true
      });
    });
	</script>
	<script src="assets-giohang/dest/js/custom2.js"></script>
	<script>
	$(document).ready(function($) {    
		$(window).scroll(function(){
			if($(this).scrollTop()>150){
			$(".header-bottom").addClass('fixNav')
			}else{
				$(".header-bottom").removeClass('fixNav')
			}}
		)
	})
	</script>
	<!---------------------------------------------LARAVEL-GIOHANG--------------------------------------------------->
	<script type="text/javascript" src="myscript/app.js"></script>



	@yield('script')
</body>

</html>
