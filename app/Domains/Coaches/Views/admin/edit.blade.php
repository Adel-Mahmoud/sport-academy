@extends('layouts.master', ['titlePage' => $titlePage])

<x-page-header :sectionPage="$sectionPage" :titlePage="$titlePage" />

@section('content')

<x-form
    :action="route('admin.coaches.update', $coach->id)"
    submitLabel="تعديل بيانات المدرب"
    cancelRoute="admin.coaches.index"
>
    @method('PUT')

    <div class="row">

        <div id="account_fields_container" class="col-12 mb-3">
            <div class="p-3 border rounded bg-white">
                <x-auth.login-fields :emailRequired="false" :passwordRequired="false" :email="$email" />
            </div>
        </div>

        <!-- Basic Data Header -->
        <div class="col-12 mb-3 mt-2">
            <div class="bg-primary text-white p-2 rounded">
                <strong>البيانات الأساسية</strong>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $coach->name) }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
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

        <div class="col-md-6 mb-3 d-flex align-items-center">
            <div class="custom-control custom-checkbox mt-4">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox"
                       name="is_active"
                       id="is_active"
                       value="1"
                       class="custom-control-input"
                       {{ old('is_active', $coach->is_active) ? 'checked' : '' }}>
                <label class="custom-control-label fw-bold" for="is_active">
                    حالة المدرب (نشط)
                </label>
            </div>
            @error('is_active') <span class="text-danger d-block ms-2">{{ $message }}</span> @enderror
        </div>

    </div>

</x-form>

@endsection