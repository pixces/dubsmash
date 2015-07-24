<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
	<title>How to create a continuous jQuery UI carousel</title>
	<link href='http://fonts.googleapis.com/css?family=Anton|Ubuntu' rel='stylesheet' type='text/css'>
	<link type="text/css" rel="stylesheet" href="css/reset.css" />
    <link type="text/css" rel="stylesheet" href="css/style.css" />
	<link type="text/css" rel="stylesheet" href="widget/css/rcarousel.css" />
	<script>
	/*
	jQuery Document ready
*/
jQuery(function($)
{
	/*
		custom function for generation links.
	*/
	function generatePages()
	{
		var _total, i, _link;
		/*
			$( "#carousel" ).rcarousel( "getTotalPages" );
			will returns number of total pages
		*/
		_total = $( "#carousel" ).rcarousel( "getTotalPages" );
		
		/*
			loop
		*/
		for ( i = 0; i < _total; i++ )
		{
			/*
				creating links
			*/
			_link = $( "<a href='#'></a>" );
			
			/*
				binding click handler to link
			*/
			$(_link).bind("click", {page: i},
				function( event )
				{
					$( "#carousel" ).rcarousel( "goToPage", event.data.page );
					event.preventDefault();
				}
			).addClass( "bullet off" ).appendTo( "#pages" );
		}
		
		// mark first page as active
		$( "a:eq(0)", "#pages" ).removeClass( "off" ).addClass( "on" ).css( "background-image", "url(http://s6.postimg.org/zdkvtjh8t/page_on.png)" );
	}
	
	/*
		callback function called when page is loaded.
	*/
	function pageLoaded( event, data )
	{
		$( "a.on", "#pages" ).removeClass( "on" )
		.css( "background-image", "url(http://s6.postimg.org/q72l69c0d/page_off.png)" );
		
		$( "a", "#pages" ).eq( data.page ).addClass( "on" )
		.css( "background-image", "url(http://s6.postimg.org/zdkvtjh8t/page_on.png)" );
	}

	// $( ".lb_gallery" ).rlightbox();

	// $( "#carousel" ).rcarousel({
		// auto: {enabled: true},
		// start: generatePages,
		// pageLoaded: pageLoaded,
		// width: 780,
		// height: 240,
	// });
	
	/*
		initialize carousel
	*/
	$("#carousel").rcarousel(
	{
		/*
			type : integer
			Number of visible elements.
			This number is the minimum number of elements you have to add.
		*/
		visible: 1,
		/*
			type : integer
			Number of elements to scroll by
		*/
		step: 1,
		/*
			type : integer
			Speed in milliseconds of scrolling animation
		*/
		speed: 700,
		/*
			type : object
			{
				enabled: boolean,
				direction: string ["next" | "prev"],
				interval: 5000
			}
			Enables or disables automatic scrolling.
		*/
		auto:
		{
			enabled: true
		},
		/*
			type : integer
			Width of carousel's elements
		*/
		width: 780,
		/*
			type : integer
			Height of carousel's elements
		*/
		height: 240,
		/*
			Triggered when carousel is ready to use
		*/
		start: generatePages,
		/*
			Triggered when page is loaded
			(scrolled into view)
		*/
		pageLoaded: pageLoaded
	});
});
	</script>
</head>
<body>
	
	<div class="content">
		<h1>Any HTML element in slides</h1>
		
		<div id="container">
			<div id="carousel">
				<div id="slide01" class="slide">
					<img src="http://s6.postimg.org/5lses3jt9/jqueryui.png" alt="jQuery UI logo" />
					<div class="text">
						<h1>continuous<br />carousel</h1>
						<p>driven by jQuery UI</p>
					</div>
				</div>
				
				<div id="slide02" class="slide">
					<img src="http://s6.postimg.org/uci35wz69/anycontent.png" alt="any content" />
					<div class="text">
						<h1>any content</h1>
						<p>from images to any HTML element</p>
					</div>
				</div>
				
				<div id="slide03" class="slide">
					<img src="http://s6.postimg.org/syqgalzwt/horizontalvertical.png" alt="horizontal and vertical carousel" />
					<div class="text">
						<h1>horizontal<br />and vertical</h1>
						<p>carousels just one click away</p>
					</div>
				</div>
				
				<div id="slide04" class="slide">
					<img src="http://s6.postimg.org/73dv3nojx/multi.png" alt="multi carousels" />
					<div class="text">
						<h1>multi<br />carousels</h1>
						<p>on a page</p>
					</div>
				</div>
				
				<div id="slide05" class="slide">
					<img src="http://s6.postimg.org/4buld1q19/customization.png" alt="customization" />
					<div class="text">
						<h1>highly<br />customizable</h1>
						<p>style it whatever you like</p>
					</div>
				</div>
				
				<div id="slide06" class="slide">
					<img src="http://s6.postimg.org/te1q3mlu5/browsers.png" alt="multi browser support" />
					<div class="text">
						<h1>multi browser<br />support</h1>
						<p>supports even old browsers</p>
					</div>
				</div>					
			</div>
			<a href="#" id="ui-carousel-next"><span>next</span></a>
			<a href="#" id="ui-carousel-prev"><span>prev</span></a>
			<div id="pages"></div>
		</div>
	</div>

	<script type="text/javascript" src="widget/lib/jquery-1.7.1.js"></script>
	<script type="text/javascript" src="widget/lib/jquery.ui.core.js"></script>
	<script type="text/javascript" src="widget/lib/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="widget/lib/jquery.ui.rcarousel.js"></script>
	<script type="text/javascript" src="script.js"></script>
</body>
</html>