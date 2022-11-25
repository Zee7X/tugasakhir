<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ asset ('css/custom1.css')}}">
	<link rel="stylesheet" href="{{ asset ('css/style.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
	<title>Login Page</title>
</head>
<body>
	<img class="wave" src="img/wave.png">
		<div class="container">
			<div class="img">
				<lottie-player src="https://assets3.lottiefiles.com/packages/lf20_owjvnmzr.json" background="transparent"  speed="1"  style="width: 500px; height: 500px;" loop autoplay></lottie-player>
			</div>
            
			<div class="login-content">
				<form action="{{ route('login') }}" method="POST">
					@csrf
					<div class="lottie-player">
						<lottie-player src="https://assets4.lottiefiles.com/packages/lf20_y1vgaq1e.json" background="transparent"  speed="1"  style="width: 360px; height: 140px;" loop autoplay></lottie-player>
					</div>
					<h4 style="font-size: 2em">Login Here</h4>
					@if ($errors->any())
							<div class="" style="color: red">
								{{ $errors->first() }}
							</div>
						@endif
						<div class="input-div one">
								<div class="i">
										<i class="fas fa-user"></i>
								</div>
								<div class="div">
										<h5>NIP</h5>
										<input type="text" class="input" name="nip">
								</div>
						</div>
						<div class="input-div pass">
								<div class="i"> 
									<i class="fas fa-lock"></i>
								</div>
								<div class="div">
									<h5>Password</h5>
									<input type="password" class="input" name="password">
								</div>
						</div>
						<a href="#">Lupa Password?</a>
						<input type="submit" class="btn" value="Login" style="font-size: 20px">
				</form>
			</div>
		</div>
		<script type="text/javascript" src="js/main.js"></script>
</body>
</html>