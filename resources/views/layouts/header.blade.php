<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ToDo APP</title>
       
    <link href="{{ asset('css/') }}/app.css" rel="stylesheet">
	<link href="{{ asset('css/') }}/aditional.css" rel="stylesheet">
	
  </head>
    
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="#">ToDo APP</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		<div class="navbar-nav ml-auto">
		  <a class="nav-item nav-link" href="#">Home <span class="sr-only">(current)</span></a>
		  <a class="nav-item nav-link" href="#">Features</a>
		  <a class="nav-item nav-link" href="#">Pricing</a>
	    </div>
	  </div>
	</nav>
	<div class="container">
		
		@yield('content')

	</div>
	<script type="text/javascript" src="{{ asset('js') }}/app.js"></script>
    <script type="text/javascript" src="{{ asset('js') }}/aditional.js"></script>
  </body>
  
</html>