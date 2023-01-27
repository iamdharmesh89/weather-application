<?php
if($_GET['search_city']==''){
	error_reporting(0);
	echo 'Please Enter a city';
}
else{
		$city = $_GET['search_city'];
        /* Fetch data */
        $data = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q='.$city.'&APPID=bafd7634a48b46827423a2bbe366e839');

        /* Decode json */
        $data = json_decode($data, true);

        /* Dump data */
		$json_pretty = json_encode($data, JSON_PRETTY_PRINT);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content=
		"width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<title>Weather Application</title>
</head>

<body class="weather-class">
<style>
	.row{
		display: flex;
		justify-content: center;
		width: 100%;
		height: fit-content;
		color: white;
		font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
		font-size: 30px;
		font-weight: 100;
	}

	.card{
		background-color: rgba(203, 176, 204, 0.836);
		padding: 20px 20px;
		border-radius: 5px;
		margin-top: 100px;
	}

	.other-desc{
		display: flex;
		flex-direction: column;		
	}

	i{
		cursor: pointer;
		margin-left: 5px;
	}

	img.icon-weather {
    width: 20%;
    margin-bottom: -19px;
    margin-left: -10px;
	}
	
	.search{
		border-top-style: groove;
		padding: 7px;
		border-radius: 5px;
		text-align: center;
	}

	#search-text{
		border-top-style: groove;
		border-radius: 5px;
	}
</style>
	<div class="row">
		<div class="card">
			<div class="search-bar">
				<form action="index.php" method="get">
					<input type="search" class="search" name="search_city" placeholder="Search City">
					<i class="bi bi-search"></i>
				</form>
			</div>
			<div class="weather-title">
				<div class="city-left"><span><?php echo $data['name']; ?></span>
						<svg xmlns="http://www.w3.org/2000/svg" width="36" height="26" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
							<path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
								</svg></div>				
							<span class="today-day"><?php echo $data['main']['temp'] - 273.15; ?>°C</span></div>
								<span class="teperature"><?php echo $data["weather"][0]["description"];?></span>
						<img class="icon-weather" src="http://openweathermap.org/img/wn/<?php echo $data["weather"][0]["icon"];?>@2x.png">
				<div class="other-desc">
					<span class="Humadity">Humidity: <?php echo $data['main']['humidity'];?>%</span>
					<span class="wind">Wind Speed: <?php echo $data['wind']['speed'];?> m/h</span>
				</div>			
			</div>		
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</body>

</html>
