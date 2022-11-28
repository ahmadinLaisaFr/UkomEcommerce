<x-guest-layout>
    <main id="main" class="main-site left-sidebar">
		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">home</a></li>
					<li class="item-link"><span>Verify Email</span></li>
				</ul>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
					<div class=" main-content-area">
						<div class="wrap-login-item ">						
							<div class="mb-4 text-md text-gray-600">
                                {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                            </div>

                            @if (session('status') == 'verification-link-sent')
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
                                </div>
                            @endif

                            <div class="mt-4 flex items-center justify-between">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf

                                    <div>
                                        <button type="submit" class="bg-red-500 text-white p-3 hover:bg-red-800">
                                            {{ __('Resend Verification Email') }}
                                        </button>
                                    </div>
                                </form>

                                <div>
                                    <a href="{{ route('profile.show') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                                        {{ __('Edit Profile') }}
                                    </a>

                                    <form method="POST" action="{{ route('logout') }}" class="inline">
                                        @csrf

                                        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 ml-2">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
						</div>
					</div><!--end main products area-->		
				</div>
			</div><!--end row-->

		</div><!--end container-->

	</main>
</x-guest-layout>
