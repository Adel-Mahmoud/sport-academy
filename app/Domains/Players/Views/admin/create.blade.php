@extends('layouts.master',['titlePage'=>$titlePage])
<x-page-header :sectionPage="$sectionPage" :titlePage="$titlePage" />

@section('content')
<x-form
    :action="route('admin.players.store')"
    submitLabel="إضافة لاعب جديد"
    cancelRoute="admin.players.index"
    enctype="multipart/form-data">
    <div class="row">

        <div class="col-md-6 mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">كلمة المرور</label>
            <input type="password" name="password" class="form-control" required>
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">رقم الهاتف</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">المدرسة</label>
            <input type="text" name="school" class="form-control" value="{{ old('school') }}">
            @error('school') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">الهوية الوطنية</label>
            <input type="text" name="national_id" class="form-control" value="{{ old('national_id') }}" required>
            @error('national_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">العمر</label>
            <input type="number" name="age" class="form-control" value="{{ old('age') }}" required>
            @error('age') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">الوزن</label>
            <input type="number" step="0.1" name="weight" class="form-control" value="{{ old('weight') }}">
            @error('weight') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">الطول</label>
            <input type="number" step="0.1" name="height" class="form-control" value="{{ old('height') }}">
            @error('height') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">فصيلة الدم</label>
            <input type="text" name="blood_type" class="form-control" value="{{ old('blood_type') }}">
            @error('blood_type') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">الجنس</label>
            <select name="gender" class="form-control" required>
                <option value="">اختر الجنس</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
            </select>
            @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">الموقع (Location)</label>
            <input type="text" name="location" class="form-control" value="{{ old('location') }}">
            @error('location') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">الصورة الشخصية</label>
            <input type="file" name="image" class="form-control">
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">العنوان</label>
            <textarea name="address" rows="2" class="form-control">{{ old('address') }}</textarea>
            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">الوصف</label>
            <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

    </div>
</x-form>
@endsection
