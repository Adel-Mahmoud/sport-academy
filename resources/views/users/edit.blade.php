@extends('layouts.academy')
@section('section')
<x-section_edit titlePage="تعديل بيانات المستخدم" routeTo="{{route('users.update', $user->id)}}">
  <div class="card-block">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nf-name">الإسم</label>
        <input type="text" id="nf-name" name="name" class="form-control" value="{{ $user->name }}" placeholder="ادخل الإسم " required>
        @error('name')
            <span class="invalid-feedback text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="nf-email">البريد الالكتروني</label>
        <input type="email" id="nf-email" name="u_email" class="form-control" value="{{ $user->email }}" placeholder="ادخل البريد الالكتروني" required>
        @error('u_email')
            <span class="invalid-feedback text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="nf-password">كلمة المرور</label>
        <input type="password" id="u-password" name="u_password" class="form-control" placeholder=" كلمة المرور">
    </div>
    <div class="form-group">
      <label for="nf-role">الصلاحيات</label>
      <select id="nf-role" name="role" class="form-control" required>
        <option value="">إختار الصلاحية</option>
       <!-- <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>مستخدم</option> -->
        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>مشرف</option>
        <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>مدير</option>
    </select>
      @error('role')
          <span class="invalid-feedback text-danger" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror    
    </div>
  </div>
</x-section_edit>
@endsection