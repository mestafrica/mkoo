@include('partials._header')

<section class="main_bg">
	<div class="container">
		<div class="row main-row">
			<div class="col-md-6 login_card">
				<div class="bg-overly"></div>
				<div class="card-content">
					<img src="{{ asset('img/logo.png') }}" alt="MEST logo" class="logo" />
					<h2>akwaaba</h2>
					<p>The MEST Kitchen app enables you to</br> to order your weekly meals</p>
					<div class="col-md-6 col-md-offset-3">
						<div class="panel panel-default">
							<div class="panel-body">
								<form action="{{ url('/login') }}" method="post">
									{{ csrf_field() }}
									<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
										<input type="email" name="email" class="form-control"
											   placeholder="Email address">
										@if($errors->has("email"))
										  <span class="help-block">{{ $errors->first("email") }}</span>
                                		@endif
									</div>
									<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
										<input type="password" name="password" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-block btn-md"><i class="fa fa-sign-in"></i> Login</button>
						     			@if($errors->has("password"))
										  <span class="help-block">{{ $errors->first("password") }}</span>
                                		@endif
									</div>
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
		</div>
	</div>
</section>
@push('more_scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
@include('partials._footer')
