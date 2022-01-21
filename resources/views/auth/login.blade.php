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

            <h4><img src="{{ asset('static/img/logo-dark.png') }}" alt="" height="30" class="logo logo-dark"> Sign in</h4>
            <p class="text-muted mb-4">Sign in to continue to SimpleChat.</p>

          </div>

          <div class="card">
            <div class="card-body p-4">
              <div class="p-3">
                <form method="POST" action="{{ route('login') }}">
                  @csrf

                  <div class="mb-3">
                    <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                    <div class="input-group mb-3 bg-soft-light rounded-3">
                      <span class="input-group-text text-muted" id="basic-addon3">
                          <i class="ri-user-2-line"></i>
                      </span>
                      <input id="email" type="email" class="form-control form-control-lg border-light bg-soft-light @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email" aria-label="Enter Email" aria-describedby="basic-addon3" control-id="ControlID-1">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>

                  <div class="mb-4">
                    @if (Route::has('password.request'))
                    <div class="float-end">
                      <a href="{{ route('password.request') }}" class="text-muted font-size-13">Forgot password?</a>
                    </div>
                    @endif
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <div class="input-group mb-3 bg-soft-light rounded-3">
                      <span class="input-group-text text-muted" id="basic-addon4">
                          <i class="ri-lock-2-line"></i>
                      </span>
                      <input id="password" type="password" class="form-control form-control-lg border-light bg-soft-light @error('password') is-invalid @enderror" placeholder="Enter Password" aria-label="Enter Password" aria-describedby="basic-addon4" control-id="ControlID-2" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>

                  <div class="form-check mb-4">
                    <input type="checkbox" class="form-check-input" control-id="ControlID-3" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                  </div>

                  <div class="d-grid">
                    <button class="btn btn-primary waves-effect waves-light" type="submit" control-id="ControlID-4">Sign in</button>
                  </div>

                </form>

              </div>
            </div>
          </div>

          <div class="mt-5 text-center">
            <p>Don't have an account ? <a href="{{ route('register') }}" class="fw-medium text-primary"> Signup now </a> </p>
          </div>
        </div>
      </div>
    </div>
  </div>



<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
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

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
