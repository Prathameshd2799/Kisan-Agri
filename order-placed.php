<?php
session_start();

require 'dbcon.php';
if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
    if (empty($_POST)) {
        header('Location: index.php');
        exit;
    }
    foreach ($_POST as $key => $val) {
        $array = explode('_', $key); // discount_amount_1 => Array([0] => discount, [1] => amount, [2] => 1)

        if (count($array) > 1) { // exclude keys without _
            $i = array_pop($array); // get and remove last member of array => Array([0] => discount, [1] => amount)
        } else {
            $i = $array[0];
        }

        $key = implode('_', $array); // Array([0] => discount, [1] => amount) => discount_amount

        if (is_numeric($i)) {
            $products[$i][$key] = $val;
        } else {
            $cart[$key] = $val;
        }
    }

    $total = $cart['total'];
    $_SESSION['products'] = $products;
    $_SESSION['total'] = $total;
} else {
    $products = $_SESSION['products'];
    $total = $_SESSION['total'];
}

if (isset($_SESSION['USER_ID']) && !empty($_SESSION['USER_ID'])) {
    $uid = $_SESSION['USER_ID'];
    $total = $_SESSION['total'];
    $address = $_POST['Address'];
    $city = $_POST['City'];

    // Save order in ord
    $query = "INSERT INTO `ord`(`uid`, `total`, `address`, `city`) VALUES ($uid, $total, '$address', '$city')";
    $result = $conn->query($query);
    if (!$result) {
        echo 'Error: '.$conn->error;
        exit;
    }
    // Get oid of last saved order
    $oid = $conn->query('SELECT LAST_INSERT_ID();')
        ->fetch_assoc()['LAST_INSERT_ID()'];

    // Save all ordered products in order_items
    foreach ($products as $pid => $product) {
        $query = "INSERT INTO `order_items`(`oid`, `pid`, `quantity`, `amount`, `subtotal`) 
        VALUES ($oid, $pid, $product[quantity], $product[amount], $product[subtotal])";
        $result = $conn->query($query);
        if (!$result) {
            echo 'Error: '.$conn->error;
            exit;
        }
    }

    // Save payment info in payment
    $query = "INSERT INTO `payment`(`total_amount`, `payment_type`, `oid`, `uid`) VALUES ($total, 'COD', $oid, $uid)";
    $result = $conn->query($query);
    if (!$result) {
        echo 'Error: '.$conn->error;
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout | Kisan Agri Mall</title>
<?php
    include 'header.php'?>

<!-- banner -->
	<div class="banner">
		<div class="w3l_banner_nav_right">
<!-- payment -->
            <div class="privacy about">
                

                 <div class="checkout-right">
                    <?php
                    if (!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID'])) {
                        ?>
                    <div class="col-md-12 address_form_agile">
                        <section class="creditly-wrapper wthree, w3_agileits_wrapper" style="margin-top: 35px">
                            <div class="information-wrapper">
                                <a href="login.php?page=checkout">
                                    <button class="submit check_out btn-block">Login To Continue</button>
                                </a>
                            </div>
                        </section>
                    </div>
                    <div class="clearfix"></div>
                    <?php
                    } else {
                        ?>
                    <div class="col-md-12 address_form_agile">
                        <section class="creditly-wrapper wthree, w3_agileits_wrapper" style="margin-top: 35px">
                            <div class="information-wrapper">
                                <button class="submit check_out btn-block">Order placed Successfully</button>
                            </div>
                        </section>
                    </div>
                    <div class="clearfix"></div>
                    <!--Plug-in Initialisation-->
                    <!-- // Pay -->
                    <?php
                    }
                    ?>
                 </div>
            </div>
<!-- //payment -->
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->

<!-- footer -->
<?php include 'footer.php'?>
<!-- //footer -->

<!-- easy-responsive-tabs -->    
<link rel="stylesheet" type="text/css" href="css/easy-responsive-tabs.css " />
<script src="js/easyResponsiveTabs.js"></script>
<!-- //easy-responsive-tabs --> 
	<script type="text/javascript">
    $(document).ready(function() {
        //Horizontal Tab
        $('#parentHorizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
    });
</script>
<!-- credit-card -->
		<script type="text/javascript" src="js/creditly.js"></script>
        <link rel="stylesheet" href="css/creditly.css" type="text/css" media="all" />

		<script type="text/javascript">
			$(function() {
			  var creditly = Creditly.initialize(
				  '.creditly-wrapper .expiration-month-and-year',
				  '.creditly-wrapper .credit-card-number',
				  '.creditly-wrapper .security-code',
				  '.creditly-wrapper .card-type');

			  $(".creditly-card-form .submit").click(function(e) {
				e.preventDefault();
				var output = creditly.validate();
				if (output) {
				  // Your validated credit card output
				  console.log(output);
				}
			  });
			});
		</script>
	<!-- //credit-card -->

<!-- //js -->
<!-- script-for sticky-nav -->
	<script>
	$(document).ready(function() {
		 var navoffeset=$(".agileits_header").offset().top;
		 $(window).scroll(function(){
			var scrollpos=$(window).scrollTop(); 
			if(scrollpos >=navoffeset){
				$(".agileits_header").addClass("fixed");
			}else{
				$(".agileits_header").removeClass("fixed");
			}
		 });
		 
	});
	</script>
<!-- //script-for sticky-nav -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
    <!-- //here ends scrolling icon -->
    <script src="js/minicart.js"></script>
    <script>
        paypal.minicart.reset();
		paypal.minicart.render();
	</script>
</body>
</html>