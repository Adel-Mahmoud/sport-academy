@extends('layouts.login-layout')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style=" height:100vh;">
        <div class="col-md-8" style="max-width:480px;">
            <div class="card">
                <div class="card-header text-center">تسجيل الدخول</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" dir="rtl">
                        @csrf

                        <div dir="rtl">
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">البريد الالكتروني</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>
                            خطأ في البيانات المدخله
                                              
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                                
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">كلمة المرور</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <label class="form-check-label" for="remember">
                                        تذكرني
                                    </label>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    تسجيل الدخول
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link d-none" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    <br>
                                    <!--
                                    <a class="btn btn-link" href="{{ route('register') }}">
                                      تسجيل عضو جديد
                                    </a>
                                    -->
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
