@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
        <div style="with:100%;">
          <h3>{{ __('Login') }}</h3>
          <!-- Pills content -->
          <div class="tab-content">
            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
              <form method="POST" action="{{ route('login') }}">
                @csrf 
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  <label class="form-label" for="loginName">Email or username</label>
                </div>
          
                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  <label class="form-label" for="loginPassword">Password</label>
                </div>
          
                <!-- 2 column grid layout -->
                <div class="row mb-4">
                  <div class="col-md-6 d-flex justify-content-center">
                    <!-- Checkbox -->
                    <div class="form-check mb-3 mb-md-0">
                      <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                      <label class="form-check-label" for="loginCheck"> Remember me </label>
                    </div>
                  </div>
          
                  <div class="col-md-6 d-flex justify-content-center">
                    @if (Route::has('password.request'))
                      <a class="btn btn-link" href="{{ route('password.request') }}">
                          {{ __('Forgot Your Password?') }}
                      </a>
                    @endif
                  </div>
                </div>
          
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">
                  {{ __('Login') }}
                </button>
          
                <!-- Register buttons -->
                <div class="text-center">
                  <p>Not a member? <a href="#!">Register</a></p>
                </div>
              </form>
            </div>
            <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
              <form>

                <!-- Name input -->
                <div class="form-outline mb-4">
                  <input type="text" id="registerName" class="form-control" />
                  <label class="form-label" for="registerName">Name</label>
                </div>
          
                <!-- Username input -->
                <div class="form-outline mb-4">
                  <input type="text" id="registerUsername" class="form-control" />
                  <label class="form-label" for="registerUsername">Username</label>
                </div>
          
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" id="registerEmail" class="form-control" />
                  <label class="form-label" for="registerEmail">Email</label>
                </div>
          
                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="registerPassword" class="form-control" />
                  <label class="form-label" for="registerPassword">Password</label>
                </div>
          
                <!-- Repeat Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="registerRepeatPassword" class="form-control" />
                  <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                </div>
          
                <!-- Checkbox -->
                <div class="form-check d-flex justify-content-center mb-4">
                  <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked
                    aria-describedby="registerCheckHelpText" />
                  <label class="form-check-label" for="registerCheck">
                    I have read and agree to the terms
                  </label>
                </div>
          
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-3">Sign in</button>
              </form>
            </div>
          </div>
          <!-- Pills content -->
        </div>
      </div>
    </div>
    <!-- End your project here-->
@endsection