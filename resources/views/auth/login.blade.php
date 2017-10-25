<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Login | {{ config('app.name') }}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <title>{{ config('app.name') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="css/style.css"> 
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">

    </head>
    <body>

	    <section class="main_bg">
	    	<div class="container">
	    		<div class="row main-row">
		    		<div class="col-md-6 login_card">
		    			<div class="bg-overly"></div>
		    			<div class="card-content">
			    			<img src="img/logo.png" alt="MEST logo" class="logo" />
			    			<h2>akwaaba</h2>
			    			<p>The MEST Kitchen app enables you to</br> place an order for your meals for the week</p>
                            <div class="col-md-6 col-md-offset-3">
                                <a href="{{ route('auth.google') }}" class="btn btn-block btn-md btn-danger">
                                    <i class="fa fa-fw fa-google-plus pull-left" style="margin-top: 5px"></i> Sign in with Google
                                </a>
                            </div>
		    			</div>
		    		</div>
	    		</div>
	    	</div>
	    </section>
    </body>
</html>