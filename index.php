<?php
session_start();
require 'dbcon.php';
$result = $conn->query('SELECT * FROM `product` LIMIT 8');
?>
<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Kisan Agri Mall </title>
<body>
<?php include 'header.php'?>
<div class="w3l_banner_nav_right">
                <section class="slider">
                    <div class="flexslider">
                        <ul class="slides">
                            <li>
                                <div class="w3l_banner_nav_right_banner">
                                </div>
                            </li>
                            <li>
                                <div class="w3l_banner_nav_right_banner1">
                                </div>
                            </li>
                            <li>
                                <div class="w3l_banner_nav_right_banner">
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>
                <!-- flexSlider -->
                    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
                    <script defer src="js/jquery.flexslider.js"></script>
                    <script type="text/javascript">
                    $(window).load(function(){
                      $('.flexslider').flexslider({
                        animation: "slide",
                        start: function(slider){
                          $('body').removeClass('loading');
                        }
                      });
                    });
                  </script>
                <!-- //flexSlider -->
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- banner -->
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>
<!-- top-brands -->
<div class="top-brands">
    <div class="container">
        
        <div class="agile_top_brands_grids">
            <?php
            if ($result->num_rows) {
                while ($product = $result->fetch_assoc()) {
                    $pid = $product['pid'];
                    $name = $product['name'];
                    $weight = trim($product['weight'], '()');
                    $pic = $product['pic'];
                    $price = $product['price'];
                    $discount = $product['discount'];
                    $discount_money = $price * ($product['discount'] / 100);
                    $new_price = $discount == 0
                        ? $price
                        : $product['price'] * (1 - ($product['discount'] / 100)); ?>
            <div class="col-md-3 top_brand_left" style="margin-bottom:15px">
                <div class="hover14 column">
                    <div class="agile_top_brand_left_grid">
                        <div class="tag">
                            <img src="images/tag.png" alt="" class="img-responsive">
                        </div>
                        <div class="agile_top_brand_left_grid1">
                            <figure>
                                <div class="snipcart-item block" >
                                    <div class="snipcart-thumb">
                                        <a href="single.php?id=<?php echo $pid; ?>">
                                            <img title="<?php echo $name; ?>" alt="<?php echo $name; ?>" src="<?php echo $pic; ?>" width="140">
                                        </a>		
                                        <p>
                                            <?php echo $name.($weight ? " ($weight)" : ''); ?>
                                        </p>
                                        <h4>
                                            <i class="fa fa-rupee"></i> <?php echo $new_price; ?>
                                            <span>
                                                <?php if ($discount) { ?>
                                                <i class="fa fa-rupee"></i> <?php echo $product['price']; } ?>
                                            </span>
                                        </h4>
                                    </div>
                                    <div class="snipcart-details top_brand_home_details">
                                        <form action="checkout.php" method="post">
                                            <fieldset>
                                                <input type="hidden" name="pid" value="<?php echo $pid; ?>" />
                                                <input type="hidden" name="cmd" value="_cart" />
                                                <input type="hidden" name="add" value="1" />
                                                <input type="hidden" name="business" value="" />
                                                <input type="hidden" name="item_name" value="<?php echo $name; ?>" />
                                                <input type="hidden" name="amount" value="<?php echo $price; ?>" />
                                                <input type="hidden" name="discount_amount" value="<?php echo $discount_money; ?>" />
                                                <input type="hidden" name="currency_code" value="INR" />
                                                <input type="hidden" name="return" value="" />
                                                <input type="hidden" name="cancel_return" value="" />
                                                <input type="submit" name="submit" value="Add to cart" class="button" />
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>

<?php include 'footer.php'?>
    
</body>
</html>
