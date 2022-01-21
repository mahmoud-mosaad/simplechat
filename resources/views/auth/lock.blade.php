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

            <h4><img src="/static/img/logo-dark.png" alt="" height="30" class="logo logo-dark"> Lock Screen</h4>
            <p class="text-muted mb-4">Enter your password to unlock the screen!</p>

          </div>

          <div class="card">
            <div class="card-body p-4">
              <div class="p-3">
                <div class="user-thumb text-center mb-4">
                  <img src="/img/avatar/avatar-1.jpg" class="rounded-circle img-thumbnail avatar-lg" alt="thumbnail">
                  <h5 class="font-size-15 mt-3">Patricia Smith</h5>
                </div>
                <form @keydown.enter="unlockScreen">
                  <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group bg-soft-light rounded-3 mb-3">
                      <span class="input-group-text text-muted" id="basic-addon2">
                          <i class="ri-lock-2-line"></i>
                      </span>
                      <input type="password" class="form-control form-control-lg bg-soft-light" placeholder="Enter Password" aria-label="Enter Password" aria-describedby="basic-addon2">
                    </div>
                  </div>

                  <div class="d-grid">
                    <button class="btn btn-primary waves-effect waves-light" type="submit">Unlock</button>
                  </div>

                </form>
              </div>
            </div>
          </div>

          <div class="mt-5 text-center">
            <p>Not you ? return <a href="/login" class="fw-medium text-primary"> Signin </a> </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end account-pages -->

@endsection
