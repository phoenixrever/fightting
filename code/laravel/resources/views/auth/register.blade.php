@extends('../layouts.empty', ['paceTop' => true])

@section('title', 'Login Page')

@section('css')
    <link href="/css/register.css" rel="stylesheet"/>
@endsection
@section('content')
	<div class="login-cover">
		<div class="login-cover-image" style="background-image: url({{$register_bg}})" data-id="login-cover-image"></div>
		<div class="login-cover-bg"></div>
	</div>
	<!-- begin login -->
	<div class="login login-v2" data-pageload-addclass="animated fadeIn">
		<!-- begin brand -->
		<div class="login-header">
			<div class="brand">
				<span class="logo"></span> <b>Color</b> Admin
				<small>responsive bootstrap 3 admin template</small>
			</div>
			<div class="icon">
				<i class="fa fa-lock"></i>
			</div>
		</div>
		<!-- end brand -->
		<!-- begin register content -->
		<div class="login-content">

			<form method="POST" action="{{ route('register') }}" class="margin-bottom-0"  data-parsley-validate="true">
				@csrf

				<label class="control-label">Name<span class="text-danger">*</span></label>
				<div class="row m-b-15">
					<div class="col-md-12">
						<input type="text" class="form-control" id="user-name" name="name"
							   data-parsley-required="true"
							   data-parsley-trigger="change"
							   data-parsley-maxlength="30"
							   onkeyup="this.value=this.value.replace(/[ ]/g,'');"
							   placeholder="Required">
					</div>
				</div>
				<label class="control-label">Email <span class="text-danger">*</span></label>
				<div class="row m-b-15">
					<div class="col-md-12">
						<input type="email" class="form-control" id="user-email"
							   name="email" data-parsley-required="true"
							   onkeyup="this.value=this.value.replace(/[ ]/g,'');"
							   data-parsley-trigger="blur"
							   data-parsley-type="email"
							   data-parsley-remote-options='{ "type": "POST","cache":"false"}'
							   data-parsley-remote-validator="validateName"
							   data-parsley-remote-message="Email already exists."
							   data-parsley-remote
							   placeholder="Required"/>
						<div class="la-pacman la-sm m-t-5" hidden>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
						</div>
					</div>
				</div>

				<label class="control-label">Password <span class="text-danger">*</span></label>
				<div class="row m-b-15">
					<div class="col-md-12">
						<input type="password" class="form-control" id="password" name="password"
							   data-parsley-required="true"
							   data-parsley-trigger="change"
							   onkeyup="this.value=this.value.replace(/[ ]/g,'');"
							   data-parsley-length="[6, 20]"
							   data-parsley-uppercase="1"
							   data-parsley-lowercase="1"
							   data-parsley-number="1"
							   {{--data-parsley-special="1"--}}
							   placeholder="Required">
					</div>
				</div>

				<label class="control-label">Re-enter password <span class="text-danger">*</span></label>
				<div class="row m-b-15">
					<div class="col-md-12">
						<input type="password" class="form-control" id="password_confirmation"
							   name="password_confirmation"
							   data-parsley-required="true"
							   data-parsley-trigger="change"
							   onkeyup="this.value=this.value.replace(/[ ]/g,'');"
							   data-parsley-equalto="#password"
							   placeholder="Required">
					</div>
				</div>

				<div class="checkbox checkbox-css m-b-30">
					<div class="checkbox checkbox-css m-b-30">
						<input type="checkbox" id="agreement_checkbox" value="">
						<label for="agreement_checkbox">
							By clicking Sign Up, you agree to our <a href="javascript:;">Terms</a> and that you have
							read our <a href="javascript:;">Data Policy</a>, including our <a href="javascript:;">Cookie
								Use</a>.
						</label>
					</div>
				</div>
				<div class="register-buttons">
					<button type="submit" class="btn btn-primary btn-block btn-lg">Sign Up</button>
				</div>
				<div class="m-t-20 m-b-40 p-b-40">
					Already a member? Click <a href="{{route("login")}}">here</a> to login.
				</div>
				<hr/>
				<p class="text-center">
					&copy; Color Admin All Right Reserved 2018
				</p>
			</form>
		</div>
		<!-- end register content -->
	</div>
	<!-- end login -->

	{{--<ul class="login-bg-list clearfix">--}}
		{{--<li class="active"><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-17.jpg" style="background-image: url(/assets/img/login-bg/login-bg-17.jpg)"></a></li>--}}
		{{--<li><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-16.jpg" style="background-image: url(../assets/img/login-bg/login-bg-16.jpg)"></a></li>--}}
		{{--<li><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-15.jpg" style="background-image: url(../assets/img/login-bg/login-bg-15.jpg)"></a></li>--}}
		{{--<li><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-14.jpg" style="background-image: url(../assets/img/login-bg/login-bg-14.jpg)"></a></li>--}}
		{{--<li><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-13.jpg" style="background-image: url(../assets/img/login-bg/login-bg-13.jpg)"></a></li>--}}
		{{--<li><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-12.jpg" style="background-image: url(../assets/img/login-bg/login-bg-12.jpg)"></a></li>--}}
	{{--</ul>--}}
@endsection

@section('scripts')
	<script src="/assets/js/demo/login-v2.demo.js"></script>
	<script>
        $(document).ready(function() {
            LoginV2.init();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            });
            $("#user-email").parsley().on('field:validate', function (parsleyField) {
                // We need to check what is the validated field
                if (parsleyField.$element.attr('name') === 'email') {
                    // given that this is the field we want, we'll hide the div
                    // console.log((new Date()).getTime());
                    $(".la-pacman").removeAttr("hidden");
                }
            });

            $("#user-email").parsley().on('field:validated', function (parsleyField) {
                if (parsleyField.$element.attr('name') === 'email') {
                    $(".la-pacman").attr("hidden", true);
                }
            });
            window.Parsley.addAsyncValidator('validateName', function (xhr) {
                var response = $.parseJSON(xhr.responseText);
                console.log(response);
                return '1' === response['status'];
            }, "{{route("users.checkEmail")}}");
        });
	</script>
@endsection
