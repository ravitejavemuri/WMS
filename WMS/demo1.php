<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="comment_style.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style>
	*
	{
		margin-left:1%;
		margin-right:1%;
	}
	body
	{
		background:#fff;
	}
	header
	{
		margin:0;
		background:#000;
		height:100px;
		text-align:center;
	}
	#Landmark
	{
		font-size:30px;
		color:#fff;
		line-height:100px;
		font-family:Trebuchet MS;
	}
	.bar
	{
		float:left;
		text-align:center;
		margin:0;
		margin-top:80px;
		width:200px;
		background:transparent;
	}
	.bar button
	{
		margin:0px;
		margin-top:10px;
		width:200px;
		height:60px;
		font-size:20px;
		color:#fff;
		background:#2c57a6;
		border:2px solid #000;
		
		transition:0.3s all;
	}
	.bar button:hover
	{
		cursor:pointer;
		background:#f9943d;
		border:2px solid #000;
	}
	.bar button.active
	{
		background:#10b8b0;
	}
	.bar button:first-child
	{
		margin-left:0px;
	}
	.bar button:last-child
	{
		margin-right:0px;
	}
	
        #chart-container0 {
                              margin-top:50px;
		               margin-left:200px;
				width: 840px;
				height: auto;
			}

       #chart-container0 {
                              margin-top:50px;
		               margin-left:200px;
				width: 840px;
				height: auto;
			}

	#chart-container {
                              margin-top:50px;
		               margin-left:200px;
				width: 840px;
				height: auto;
			}
			
	#chart-container1 {
		               margin-top:50px;
		               margin-left:200px;
				width: 840px;
				height: auto;
			}
			
	#chart-container2 {
		               margin-top:50px;
		               margin-left:200px;
				width: 840px;
				height: auto;
			}
	#chart-container3 {
		               margin-top:50px;
		               margin-left:200px;
				width: 840px;
				height: auto;
			}
	button.accordion {
	margin:0px;
    background-color: #f9943d;
    color: #000;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: center;
    outline: none;
    font-size: 20px;
    transition: 0.4s;
}

button.accordion.active, button.accordion:hover {
    background-color: #3da2f9;
}

div.panel {
    padding: 0 18px;
    background-color: #dfe3ee;
	text-align:left;
    max-height: 0;
    overflow: auto;
    transition: max-height 0.2s ease-out;
}
	
</style>
<?php
  //$deli=0.000001;
	//$db=mysqli_connect("localhost","id1087204_teamwms","teamwms","id1087204_megamount")or die("unable to connect");
	$db=mysqli_connect("dive.in","root","","megamount")or die("unable to connect");
	//$con=mysqli_connect("mysql7.000webhost.com","a9317919_ravi","raviiot8","a9317919_steel");
	
	

	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($db,"SELECT * FROM `Sense` WHERE pH is NOT NULL ORDER BY Time");
	
	while($row = mysqli_fetch_array($result))
	{
		$latm[]=$row['Latitude'];
		//$latm=$row['Lat'];
		$ph[] = $row['pH'];
		//$latm=$latm*$deli;
		//$lam=$row['Long'];
		$lam[]=$row['Longitude'];//for local host
		//$lam=$lam*$deli;
		$turb[]=$row['Turbidity'];
		$con[]=$row['Conduct'];
		$tds[]=$row['TDS'];
		$time = $row['Time'];
	}
	?>
</head>
<body >
<header>
<div id="Landmark" ></div>
<div class="bar">
    <button class="w3-bar-item w3-button tablink active" onclick="openCity(event,'overview')">Overview</button>
    <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'ph')">pH Level</button>
    <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'turbidity')">Turbidity</button>
    <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'conduct')">Conductivity</button>
	<button class="w3-bar-item w3-button tablink" onclick="openCity(event,'tds')">TDS</button>
  </div>
  
<div id="overview" class="w3-container w3-border city">
    <h2>Overview</h2>
    <p>
         <div id="chart-container0">
			<canvas id="mycanvas0"></canvas>
		</div>

		<!-- javascript -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/Chart.js"></script>
		<script type="text/javascript" src="js/linegraph.js"></script>
    </p>
	<br><br>
	<p id="suggestion">
		<button class="accordion" style="display:none">Section 1</button>
			<div class="panel">
			  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			</div>

			<button class="accordion"><b>Suggestions for water treatment</b></button>
			<div class="panel">
			  <p style="border-bottom:2px solid #f9943d;">
				<ul>
					<b>Neutralizing Filters</b>
					<br><br>
					<li>A neutralizing filter is used if drinking water is acidic (low pH). It is a simple treatment device that raises the pH of water by adding a neutralizing material. However, it should be noted that the neutralization process may increase water hardness.
						</li><br><li>Neutralizing filters are point-of-entry devices that raise water pH to neutral levels (around 7) which reduces or eliminates plumbing corrosion problems. Calcium carbonate treats water with a pH greater than 6 and synthetic magnesium oxide will treat water with a pH below 6.
						</li>
						<br><br>
					<b>Soda ash/sodium hydroxide injection</b>
					<br><br>
					<li>This treatment method is used if water is acidic (low pH). Soda ash (sodium carbonate) and sodium hydroxide raise the pH of water to near neutral when injected into a water system. Unlike neutralizing filters, they do not cause hardness problems in treated water.
						</li><br><li>Injection systems are a point-of-entry system. A corrosion-resistant chemical feed pump injects soda ash or sodium hydroxide solution into the water to raise the pH. The solution should be fed directly into the well to protect the well casing and pump from corrosion.
						</li><br><li>If the water needs to be disinfected as well as neutralized, dual treatment is possible within the injection system by adding a chlorine solution (sodium hypochlorite) along with the neutralizing chemical.
						</li><br><li>Injection systems can treat water with a pH as low as 4.
					</li>
					<br><br>
					<b>Acid injection</b>
					<br><br>
					<li>Acid injection treats water with a high pH by lowering the pH of water to around 7, which eliminates the soda taste and can improve the effectiveness of chlorination. This method also reduces the potential of pipe corrosion as water with a pH above 9 can corrode metals such as brass, copper, zinc, aluminum and iron.
					</li>
					<br><br>
					<b>Chlorination</b>
					<br><br>
					<li>We saved the most obvious and probably the most reliable treatment method for last. Chlorine can work in the community water supply to kill microbes before it enters people’s jerry cans or home water supplies. And it keeps the water safe from new contaminations long after it is added.
					We’ve seen several interesting chlorination methods at work in resource-poor regions. Compatible Technology International developed this tested and proven device that chlorinates water in gravity-fed systems that fill a community water cistern. And these four experimental designs have worked in field tests to dose water accurately after people fill their buckets at a community well, stream or other source. The chlorinator, shown here fully assembled and broken down, attaches to a loop in the water pipe that feeds into the community tank. Image courtesy of CTI
					</li>
					<br><br>
					<b>Sand Filtration</b>
					<br><br>
					<li>
					Filtration through clean sand is a fast and simple pre-treatment option.  Users pour water from a transport container through a container of sand with gravel and a spigot at the bottom.  The water then flows into a storage container.  The benefits of sand filtration are that it is effective at removing some bacteria, it is simple and fast for the user, and, if sand is available locally, it is inexpensive.  The drawback of sand filtration is that it requires three containers and a spigot.  In laboratory studies, the use of sand filtration significantly reduced both the turbidity and the chlorine demand of turbid water.
					</li>
				</ul>
			  </p>
			</div>
	</p>
	<script>
		var acc = document.getElementsByClassName("accordion");
		var i;

		for (i = 0; i < acc.length; i++) {
		  acc[i].onclick = function() {
			this.classList.toggle("active");
			var panel = this.nextElementSibling;
			if (panel.style.maxHeight){
			  panel.style.maxHeight = null;
			} else {
			  panel.style.maxHeight = "300px";
			} 
		  }
		}
		</script>
		
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript">
		function post()
		{
		  var comment = document.getElementById("comment").value;
		  var name = document.getElementById("username").value;
		  if(comment && name)
		  {
			$.ajax
			({
			  type: 'post',
			  url: 'post_comment.php',
			  data: 
			  {
				 user_comm:comment,
				 user_name:name
			  },
			  success: function (response) 
			  {
				document.getElementById("all_comments").innerHTML=response+document.getElementById("all_comments").innerHTML;
				document.getElementById("comment").value="";
				document.getElementById("username").value="";
		  
			  }
			});
		  }
		  
		  return false;
		}
		</script>
	<div id="form">
		<h1>Add a comment</h1>
		<form method='post' action="" onsubmit="return post();">
		  <textarea id="comment" placeholder="Write Your Comment Here....."></textarea>
		  <br>
		  <input type="text" id="username" placeholder="Your Name">
		  <br>
		  <input type="submit" value="Post Comment">
		  </form>
	</div>
		<div id="comments">
		  <div id="all_comments">
		  <?php
			$host="localhost";
			$username="id1087204_teamwms";
			$password="teamwms";
			$databasename="id1087204_megamount";

			$connect=mysqli_connect($host,$username,$password,$databasename);
			$db=mysqli_select_db($connect,$databasename);
		  
			$comm = mysqli_query($connect,"select name,comment,post_time from comments order by post_time desc");
			while($row=mysqli_fetch_array($comm))
			{
			  $name=$row['name'];
			  $comment=$row['comment'];
			  $time=$row['post_time'];
			?>
			
			<div class="comment_div"> 
			  <p class="name">Posted By:<?php echo $name;?></p>
			  <p class="comment"><?php echo $comment;?></p>	
			  <p class="time"><?php echo $time;?></p>
			</div>
		  
			<?php
			}
			?>
		  </div>
		</div>
	</div>
  <div id="ph" class="w3-container w3-border city" style="display:none">
    <h2>Last Updated pH Level: <?php echo end($ph); ?> pH</h2>
    <p>
		<div id="chart-container">
			<canvas id="mycanvas"></canvas>
		</div>

		<!-- javascript -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/Chart.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
	</p>
  </div>

  <div id="turbidity" class="w3-container w3-border city" style="display:none">
    <h2>Last Updated Turbidity: <?php echo end($turb); ?> cd</h2>
    <p>		
		<div id="chart-container1">
			<canvas id="mycanvas1"></canvas>
		</div>

		<!-- javascript -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/Chart.js"></script>
		<script type="text/javascript" src="js/app1.js"></script>
	</p> 
  </div>

  <div id="conduct" class="w3-container w3-border city" style="display:none">
    <h2>Last Updated Conductivity: <?php echo end($con); ?> EC</h2>
    <p>
		<div id="chart-container2">
			<canvas id="mycanvas2"></canvas>
		</div>

		<!-- javascript -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/Chart.js"></script>
		<script type="text/javascript" src="js/app2.js"></script>
	</p>
  </div>
  
  <div id="tds" class="w3-container w3-border city" style="display:none">
    <h2>Last Updated TDS: <?php echo end($tds); ?> ppm</h2>
    <p>
		<div id="chart-container3">
			<canvas id="mycanvas3"></canvas>
		</div>

		<!-- javascript -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/Chart.js"></script>
		<script type="text/javascript" src="js/tds.js"></script>
	</p>
  </div>
</div>
</header>
<script>

function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
	
	var url = window.location.href;
	var params = url.split('?');
	var str = params[1];
			
	var andsplit = str.split('&');

	var Lat = andsplit[0];
	var Lng = andsplit[1];
	
	var Latitude = <?php echo json_encode($latm);?>;
	var Longitude = <?php echo json_encode($lam); ?>;
	var ph = <?php echo json_encode($ph); ?>;
	var Conductivity = <?php echo json_encode($con);?>;
	var Turbidity = <?php echo json_encode($turb); ?>;
	var Time = <?php echo json_encode($time); ?>;
	
	
	function GetAddress() {
			
            var url = window.location.href;
			var params = url.split('?');
			var str = params[1];
			
			var andsplit = str.split('&');

			var Lat = andsplit[0];
			var Lng = andsplit[1];
			
			var latlng = new google.maps.LatLng(Lat, Lng);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
						document.getElementById("Landmark").innerHTML = (results[0].formatted_address);
                    }
                }
            });			
	}
	
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=
&callback=GetAddress"></script>


</body>
</html>
