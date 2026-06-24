@extends('layouts.master',['titlePage'=>$titlePage])
<x-page-header :sectionPage="$sectionPage" :titlePage="$titlePage" />

@section('content')
<x-form
    :action="route('admin.sports.store')"
    submitLabel="إضافة رياضة جديدة"
    cancelRoute="admin.sports.index">
    <div class="row">

        <div class="col-md-6 mb-3">
            <label class="form-label">اسم الرياضة</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">رقم الفرع (Branch ID)</label>
            <input type="number" name="branch_id" class="form-control" value="{{ old('branch_id') }}">
            @error('branch_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">الحالة</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>مفعلة</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>غير مفعلة</option>
            </select>
            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

    </div>
</x-form>
@endsection