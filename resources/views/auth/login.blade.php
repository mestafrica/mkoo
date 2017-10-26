@include('partials._header')
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
@include('partials._footer')
