@include('partials._header')
<section class="main_bg">
	<div class="container">
		<div class="row main-row">
			<div class="col-md-6 login_card">
				<div class="bg-overly"></div>
				<div class="card-content">
					<img src="img/logo.png" alt="MEST logo" class="logo" />
					<h2>akwaaba</h2>
					<p>The MEST Kitchen app enables you to</br> to order your weekly meals</p>
					<div class="col-md-6 col-md-offset-3">
						<form>
						<input type="email" name="email" class="form-control" placeholder="Login with email">
							<div style="margin-bottom: 2%"></div>
							<input type="password" name="password" class="form-control" placeholder="please enter password here">
							<div style="margin-bottom: 2%"></div>
							<button type="submit" class="btn btn-primary btn-block btn-md">Login</button>
						</form>
						<div style="margin-bottom: 8%"></div>
						<a href="{{ route('auth.google') }}" class="btn btn-block btn-md btn-danger">	
							<i class="fa fa-fw fa-google-plus pull-left" style="margin-top: 5px"></i> Sign in with Google
						</a>


					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@include('partials._footer')
