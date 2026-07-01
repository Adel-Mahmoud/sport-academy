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

        <x-auth.login-fields :emailRequired="true" :passwordRequired="false"/>

        <!--  Basic Data Header -->
        <div class="col-12 mb-3 mt-4">
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

    </div>

</x-form>

@endsection