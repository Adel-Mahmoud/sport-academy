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
            <select name="branch_id" class="form-control" required>
                <option value="">اختر الفرع</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>
            @error('branch_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">الحالة</label>
            <select name="is_active" class="form-control" required>
                <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>مفعلة</option>
                <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>غير مفعلة</option>
            </select>
            @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

    </div>
</x-form>
@endsection