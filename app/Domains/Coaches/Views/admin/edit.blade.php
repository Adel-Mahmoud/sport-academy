@extends('layouts.master',['titlePage'=>$titlePage])

<x-page-header :sectionPage="$sectionPage" :titlePage="$titlePage" />

@section('content')

<x-form
    :action="route('admin.coaches.update', $coach->id)"
    submitLabel="تعديل بيانات المدرب"
    cancelRoute="admin.coaches.index"
>

    @method('PUT')

    <div class="row">

        <div class="col-md-6 mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $coach->name) }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', $coach->email) }}" required>
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">كلمة المرور (اختياري)</label>
            <input type="password" name="password" class="form-control">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        
        <div class="col-md-6 mb-3">
            <label class="form-label">رقم الهاتف</label>
            <input type="text" name="phone" class="form-control"
                   value="{{ old('phone', $coach->phone) }}" required>
            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">تاريخ التعيين</label>
            <input type="date" name="hire_date" class="form-control"
                   value="{{ old('hire_date', $coach->hire_date) }}">
            @error('hire_date') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">الراتب</label>
            <input type="number" step="0.01" name="salary" class="form-control"
                   value="{{ old('salary', $coach->salary) }}">
            @error('salary') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

    </div>

</x-form>

@endsection