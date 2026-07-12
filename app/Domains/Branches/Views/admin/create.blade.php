@extends('layouts.master',['titlePage'=>$titlePage])
<x-page-header :sectionPage="$sectionPage" :titlePage="$titlePage" />

@section('content')
<x-form
    :action="route('admin.branches.store')"
    submitLabel="إضافة فرع جديد"
    cancelRoute="admin.branches.index"
>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">العنوان</label>
            <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">رقم الهاتف</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        </div>  
        <div class="col-md-6 mb-3 form-check d-flex align-items-center justify-content-start">
            <label class="form-label ml-1" for="is_active">الحالة</label>
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', 'checked') ? 'checked' : '' }}>
            @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
</x-form>
@endsection