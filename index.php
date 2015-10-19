<?php ob_start(); include("includes/config.php");

$maxrate = mysql_query("SELECT max(rates) FROM `tbl_property` where status=1");
$rowmax=mysql_fetch_array($maxrate);


$minrate = mysql_query("SELECT min(rates) FROM `tbl_property` where status=1");
$rowmin=mysql_fetch_array($minrate);

$max=$rowmax[0];
$min=$rowmin[0];
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>Real Estate Site</title>
<link rel="stylesheet" href="css/main-style.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">


<link rel="stylesheet" href="css/templatemo_style.css">

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/additional-methods.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
    <script src="js/jquery.singlePageNav.js"></script>
	<script src="js/jquery.flexslider.js"></script>
	
	<script src="js/custom.js"></script>
    
  
  
  <script type="text/javascript">
$(function() {


    $( "#slider-range" ).slider({
      range: true,
      min: <?php echo $min; ?>,
      max: <?php echo $max; ?>,
      values: [ <?php echo $min; ?>, <?php echo $max; ?> ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
  });
</script>

  
   <script>
jQuery(document).ready(function($) {

 var $menu = $('#menu'),
   $menulink = $('.menu-link'),
   $menuTrigger = $('.has-submenu > a');

 $menulink.click(function(e) {
  e.preventDefault();
  $menulink.toggleClass('active');
  $menu.toggleClass('active');
 });

 $menuTrigger.click(function(e) {
  e.preventDefault();
  var $this = $(this);
  $this.toggleClass('active').next('ul').toggleClass('active');
 });

});
</script>


<script>
  $(function() {
    $( "#checkin" ).datepicker({
      showOn: "button",
	  dateFormat: 'yy-mm-dd',
      buttonImage: "img/cal.png",
      buttonImageOnly: true,
      buttonText: "Select date"
    });
	
	 $( "#checkout" ).datepicker({
      showOn: "button",
	  dateFormat: 'yy-mm-dd',
      buttonImage: "img/cal.png",
      buttonImageOnly: true,
      buttonText: "Select date"
    });
  });
  </script>
  
  <script>
$(function(){

$("#contactus_enter").validate({
	
	rules: {
	
		Email:{
required: true,
email: true
},
	
		
	},
	
	message:{
		
	
		Email:{
required: "Please Enter your Email Address.",
email: "Enter Valid Email Address."
},
	
	},
	submitHandler:function(form){
		form.submit();
	}
	
	
	
});
});

function validateForm() {

    var x = $("#searchfo").val();
    if (x == null || x == "") {
       
        return false;
    }
}

</script>


  
</head>

<body>

	<div id="banner">
  <div class="main-slider">
				<div class="flexslider">
					<ul class="slides">
                    
                      <?php $sel=mysql_query("SELECT * FROM `home_slider` WHERE status=1"); 
	  $sl=0;
	  while($row=mysql_fetch_array($sel))
	  {$sl++;
	  ?>
      
     <li>
     	<div class="slider-caption">
							
								<p><?php echo $row['caption']?></p>
								
							</div>
						<img src="admin/images/slider/<?php echo $row['image']?>" alt="" title="">
     
     
       
        </li>
        <?php } ?>
                   
					</ul>
				</div>
			</div>
    <!-- /#ccr-slide-main --> 
    
    
	<header id="header">
    	
        <div id="jquery-script-menu">
            <div class="container">
	            <?php $selto=mysql_query("SELECT * FROM `static_content` WHERE page_id=1 and status=1"); 
	 
	  while($rowto=mysql_fetch_array($selto))
	  {
	     echo $rowto['page_content'];
	  } ?>
      
      <div class="top-social">
   <ul>
                 <?php $selto=mysql_query("SELECT * FROM `social_icons` WHERE status=1"); 
	 
	  while($rowto=mysql_fetch_array($selto))
	  {
		  ?>
		   	<li><a href="<?php echo $rowto['link']; ?>"><img src="admin/images/social_icons/<?php echo $rowto['image']?>" /></a></li>
	 
	<?php  } ?>
                    </ul></div>
            </div><!--container-->
        </div><!--top-black-wrap-->
        
        <div id="top-menubg">
        
        <div class="container">
        
        	<div class="logo">
            <?php $sellogo=mysql_query("SELECT * FROM `static_content` WHERE page_id=2"); 
			  $log=mysql_fetch_array($sellogo)
			?>
            	<a href="<?php echo "http://".$_SERVER['SERVER_NAME']; ?>"><img src="admin/images/logo/<?php echo $log['page_content'] ; ?>" alt="" title="" style="height: 118px; width: 100px;"></a>
            </div><!--logo-->
            
            <?php 
            
		$pageId = isset($_GET['page_id'])? $_GET['page_id'] : 1;		
	

  		$sqlParent = 'SELECT * FROM tbl_menu WHERE Status = 1 AND Parent_Id = 0';		

		$resultsParent = mysql_query($sqlParent) or die(mysql_error());		

		

		function FindChilds($parentID, $pageId)

		{									

			$finalArray = array();

			$voidCode = 'javascript:void(0);';

				

			$sqlChild = "SELECT * FROM tbl_menu WHERE Status = 1 AND Parent_Id ='".$parentID."'  ";			

			$resultsChild = mysql_query($sqlChild);

						

			while( $row= mysql_fetch_array($resultsChild) ) 

			{

			  $finalArray['id'][] = $row['Auto_Cat_Id'];

			  $finalArray['name'][] = $row['Category_Name'];

			  $finalArray['url'][] = empty($row['pageName'])  ? $voidCode : $row['pageName'] . '?pageId=' . $row['Auto_Cat_Id'];

			  $finalArray['class'][] = ($pageId === $row['Auto_Cat_Id']) ? 'current_link' : '';

			}

						

			return $finalArray;	

		}   

		

		?>         
<div class="nav-wrap">
  
  <a class="menu-link" href="#menu">Menu</a>
        
 <nav id="menu" class="menu">
		

	<?php

			

		$parentArray = array();		

		

		while($row=mysql_fetch_array($resultsParent))

		{

			$parentArray['id'][] = $row['Auto_Cat_Id'];

			$parentArray['name'][] = $row['Category_Name'];

			$parentArray['url'][] = empty($row['pageName'])  ? $voidCode : $row['pageName'];

			$parentArray['class'][] = ($pageId === $row['Auto_Cat_Id']) ? 'current_link' : '';

		}

		

		$i = 0;
		 echo '<ul>';

		foreach($parentArray['name'] as $pmenu) :

				
			$childData = FindChilds($parentArray['id'][$i], $pageId);
			
			 if (count($childData) > 0)

		 {
		 		  	

		  echo '<li class="has-submenu""><a href="' . $parentArray['url'][$i] .'?page_id='.$parentArray['id'][$i].'">' . $pmenu . '<i class="fa fa-caret-down"></i></a>';	
		 }
		 
		 else
		 {
			echo '<li class="class="has-submenu""><a href="' . $parentArray['url'][$i] .'?page_id='.$parentArray['id'][$i]. '">' . $pmenu . '</a>'; 
		 }

		 

		 // 1st menu tier starts from here 

		 //$childData = FindChilds($parentArray['id'][$i], $pageId);

		 

		 if (count($childData) > 0)

		 {

		 	$j = 0;		 

		 	echo '<ul class="sub-menu">';			

		  	foreach($childData['name'] as $child) :  		  			  	  

		  						$childData2 = FindChilds($childData['id'][$j], $pageId);	
								
								 if (count($childData2) > 0)

				 {  
				 

			echo '<li class="has-submenu"><a href="' . $childData['url'][$j] . '?page_id='.$childData['id'][$j].'"><i class="fa fa-caret-right"></i>/a>';
			
		
				 }
				 
				 else
				 {
					 echo '<li class="has-submenu"><a href="' . $childData['url'][$j] .'">' . $child . '</a>';
				 }

				

				// 2nd menu tier starts from here 

				

				 if (count($childData2) > 0)

				 {
//echo '<i class="fa fa-chevron-right pull-right"></i>';
					$k = 0;

					 

					echo '<ul>';			

					foreach($childData2['name'] as $child2) : 					

						echo '<li><a href="' . $childData2['url'][$k] . '?page_id='.$childData2['id'][$k]. '">' . $child2 . '</a></li>';					

				  

					$k++;				

					endforeach;

				  

					echo '</ul>';					 	

				 }

				 // 2nd menu tier ends here...

			

		  	$j++;				

		  	endforeach;

			

			echo '</ul>';		  	

		 }

		 

		 // 1st menyu tier ends here..		  

		  echo '</li>';

		  			  

		  $i++;				

		endforeach;

		echo '</ul>';

  ?>  

 <div class="clear"></div>
           			</nav><!-- /.navbar-collapse --> 
                    
          </div><!---------->
                    
            </div><!--container-->
            </div><!--menu-bg-wrap-->
           
	</header>
            
            <div class="container">
            <form action="search.php" method="post" id="products">
              <div class="filter-wrap">
                   		
                        <div class="price-tital"> <h3>FILTERS:</h3></div>
                    
                   
                    	<div class="price-range"><p><input type="text" id="amount" name="amount" style="border:0; color:#f6931f; font-weight:bold;" readonly></p>
                        <div id="slider-range"></div>
                         </div>

                        
                    
                    </div><!--filter-range-->
            	
                	<div id="search-wrap">
                    
                  
                    
                    
                    
                    <div class="search-wrap">
                    
                	
                    
                    <div class="search-input1">
                    
                    	<select name="cat_name"> 
                        <option value="">Select Category</option>
                        <?php  $selcat=mysql_query("select * from tbl_category where Status=1");
						while($catget=mysql_fetch_array($selcat)) {
						?>
                       		<option value="<?php echo $catget['Auto_Cat_Id']; ?>"><?php echo $catget['Category_Name']; ?></option>
                            
                        <?php } ?>
                        </select>
                    </div>
                    
                    <div class="search-input">
                    	<input type="text" value="" name="checkin" id="checkin">
                    </div>
                    
                    <div class="search-input">
                    	<input type="text" value="" name="checkout" id="checkout">
                    </div>
                    
                    <div class="search-input">
                    	<select name="loc_name">
                        <option value="">Select Location</option>
                        	 <?php  $selloc=mysql_query("select location from tbl_property where Status=1");
						while($locget=mysql_fetch_array($selloc)) {
						?>
                       		<option value="<?php echo $locget['location']; ?>"><?php echo $locget['location']; ?></option>
                            
                        <?php } ?>
                           
                        </select>
                    </div>
                    
                    <input type="submit" name="submit" value="Search" class="search-button" />
                
                
                
            <div class="clr"></div>
                    
                     
                    </div><!--search-wrap-->
                </div><!--search-wrap-bg-->
         </form>   
         
            </div><!--container-->
            
           
        
        
        

    
    
  </div><!--banner-full-wrapper-->
  
  
  <div class="container">
  <?php $selto=mysql_query("SELECT * FROM `static_content` WHERE page_id=4 and status=1"); 
	 
	  while($rowto=mysql_fetch_array($selto))
	  {
	     echo $rowto['page_content'];
	  } ?>
  
  	<!--big-title-home-->
    
    
    <div id="home-circle">
    
    	<ul>
        
        	 <?php $selto=mysql_query("SELECT * FROM `tbl_category` WHERE Status=1 order by dateAdded desc"); 
	 
	  while($rowto=mysql_fetch_array($selto))
	  { ?>
        
        	<div class="col-md-4 col-xs-12 col-sm-4">
            <li>
			
	  
            	<h3><a href="category_property.php?cat_id=<?php echo $rowto['Auto_Cat_Id']; ?>"><?php echo $rowto['Category_Name'] ?></a></h3>
                <a href="category_property.php?cat_id=<?php echo $rowto['Auto_Cat_Id']; ?>"><img src="image.php?path=admin/images/blocks/<?php echo $rowto['cat_image']; ?>" alt="" title=""></a>
                <p><?php echo $rowto['Description']; ?></p>
            </li>
	
            
            </div>
           <?php }?>   
           
            
            
            
        </ul>
    
    </div>
    
  
  </div><!--container-->
  
  
  <div id="background-fixed1">
<div class="container">
<?php $selto=mysql_query("SELECT * FROM `static_content` WHERE page_id=8 and status=1"); 
	 
	  while($rowto=mysql_fetch_array($selto))
	  {
	    
		echo $rowto['page_content'];
	  }
	  
	  ?>
			<!--big-title-home-->
        </div><!--container-->

	</div><!--background-fixed-middle-->
    
    
    <div class="container">
    
    	
    
    
    <div id="sequre-prop">
    <ul>
 
   <?php  $selpro = mysql_query("select * from `tbl_posts` where status=1 ORDER BY Auto_Post_Id desc LIMIT 0,6 "   );
   $pi=0;
   while($rowp = mysql_fetch_array($selpro)) { $pi++;
   if($pi%2!=0) {  echo "<li>"; }
   ?> 	
        	<div class="col-md-3 col-xs-12 col-sm-6">
			       <a href="single_blog.php?post_id=<?php echo $rowp['Auto_Post_Id']; ?>"><img src="admin/images/posts_images/<?php echo $rowp['post_image']; ?>" alt="" title=""></a>
            </div>
            
           <div class="col-md-3 col-xs-12 col-sm-6">
            	<div class="text-div">
                	<h4><a href="single_blog.php?post_id=<?php echo $rowp['Auto_Post_Id']; ?>"><?php echo $rowp['post_title']; ?></a></h4>
                    <p><?php echo substr($rowp['post_description'], 0, 400); ?></p>
                </div>
            </div>
            
		<?php if($pi%2==0) {  echo "</li>"; } } ?>
</ul>
    </div>
    
    
    </div><!--container-->
	<?php include('footer.php');?>
    
