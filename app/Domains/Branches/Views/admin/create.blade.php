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
            <label class="form-label">الموقع</label>
            <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
            @error('location') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6 mb-3 form-check d-flex align-items-center justify-content-start">
            <label class="form-label ml-1" for="status">الحالة</label>
            <input type="checkbox" name="status" id="status" value="1" {{ old('status', 'checked') ? 'checked' : '' }}>
            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
</x-form>
@endsection