<div class="col-12">
    <div class="row">
        <!--  Login Data Header -->
        <div class="col-12 mb-3">
            <div class="bg-success text-white p-2 rounded">
                <strong>بيانات الدخول</strong>
            </div>
        </div>

        <!-- Email -->
        <div class="col-md-6 mb-3">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email"
                name="email"
                class="form-control border border-success"
                value="{{ old('email') }}"
                @if($emailRequired) required @endif>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="col-md-6 mb-3">
            <label class="form-label">كلمة المرور</label>
            <input type="password"
                name="password"
                class="form-control border border-success"
                @if($passwordRequired) required @endif>
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>