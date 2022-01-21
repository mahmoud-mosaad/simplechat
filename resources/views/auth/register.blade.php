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

            <h4><img src="{{ asset('static/img/logo-dark.png') }}" alt="" height="30" class="logo logo-dark"> Sign up</h4>
            <p class="text-muted mb-4">Get your SimpleChat account now.</p>

          </div>

          <div class="card">
            <div class="card-body p-4">
              <div class="p-3">
                <form method="POST" action="{{ route('register') }}">
                  @csrf

                  <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <div class="input-group bg-soft-light mb-3 rounded-3">
                      <span class="input-group-text border-light text-muted" id="basic-addon6">
                          <i class="ri-user-2-line"></i>
                      </span>
                      <input id="name" type="text" class="form-control form-control-lg bg-soft-light border-light @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter Username" aria-label="Enter Username" aria-describedby="basic-addon6" control-id="ControlID-2">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                    <div class="input-group bg-soft-light rounded-3  mb-3">
                      <span class="input-group-text text-muted" id="basic-addon5">
                          <i class="ri-mail-line"></i>
                      </span>
                      <input id="email" type="email" class="form-control form-control-lg bg-soft-light border-light @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email" aria-label="Enter Email" aria-describedby="basic-addon5" control-id="ControlID-1">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>

                  <div class="mb-4">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <div class="input-group bg-soft-light mb-3 rounded-3">
                      <span class="input-group-text border-light text-muted" id="basic-addon7">
                          <i class="ri-lock-2-line"></i>
                      </span>
                      <input id="password" type="password" class="form-control form-control-lg bg-soft-light border-light @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter Password" aria-label="Enter Password" aria-describedby="basic-addon7" control-id="ControlID-3">
                      @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="mb-4">
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    <div class="input-group bg-soft-light mb-3 rounded-3">
                      <span class="input-group-text border-light text-muted" id="basic-addon7">
                          <i class="ri-lock-2-line"></i>
                      </span>
                      <input id="password-confirm" type="password" class="form-control form-control-lg bg-soft-light border-light" name="password_confirmation" required autocomplete="new-password" placeholder="Enter Password" aria-label="Enter Password" aria-describedby="basic-addon7" control-id="ControlID-3">
   
                    </div>
                  </div>

                  <div class="d-grid">
                    <button class="btn btn-primary waves-effect waves-light" type="submit" control-id="ControlID-4">Sign up</button>
                  </div>

                  <!-- <div class="mt-4 text-center">
                    <p class="text-muted mb-0">By registering you agree to SimpleChat <a href="/terms" class="text-primary">Terms of Use</a></p>
                  </div> -->

                </form>
              </div>
            </div>
          </div>

          <div class="mt-5 text-center">
            <p>Already have an account ? <a href="{{ route('login') }}" class="fw-medium text-primary"> Signin </a> </p>
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
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
