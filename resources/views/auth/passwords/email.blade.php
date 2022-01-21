@extends('layouts.auth')

@section('content')

<div class="account-pages my-3 pt-sm-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="text-center mb-4">
<!--            <a href="/" class="auth-logo mb-5 d-block">-->
<!--              <img src="/img/logo-dark.png" alt="" height="30" class="logo logo-dark">-->
<!--              <img src="/img/logo-light.png" alt="" height="30" class="logo logo-light">-->
<!--            </a>-->

            <h4><img src="{{ asset('static/img/logo-dark.png') }}" alt="" height="30" class="logo logo-dark">{{ __('Reset Password') }}</h4>
            <p class="text-muted mb-4">Reset Password With SimpleChat.</p>

          </div>

          <div class="card">
            <div class="card-body p-4">
              <div class="p-3">
                <div class="alert alert-success text-center mb-4" role="alert">
                    Enter your Email and instructions will be sent to you!
                    @if (session('status'))
                        <br>
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                  <div class="mb-4">
                    <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                    <div class="input-group mb-3 bg-soft-light rounded-3">
                      <span class="input-group-text text-muted" id="basic-addon5">
                          <i class="ri-mail-line"></i>
                      </span>
                      <input id="email" type="email" class="form-control form-control-lg border-light bg-soft-light @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email" aria-label="Enter Email" aria-describedby="basic-addon5" control-id="ControlID-1">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>

                  <div class="d-grid">
                    <button class="btn btn-primary waves-effect waves-light" type="submit" control-id="ControlID-2">{{ __('Send Password Reset Link') }}</button>
                  </div>

                </form>
              </div>
            </div>
          </div>

          <div class="mt-5 text-center">
            <p>Remember It ? <a href="{{ route('login') }}" class="fw-medium text-primary"> Signin </a> </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end account-pages -->

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
