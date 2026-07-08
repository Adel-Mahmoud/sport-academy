@extends('layouts.master',['titlePage'=>$titlePage])

<x-page-header :sectionPage="$sectionPage" :titlePage="$titlePage" />

@section('content')
<x-form
    :action="route('admin.groups.update', $group->id)"
    submitLabel="تعديل مجموعة"
    cancelRoute="admin.groups.index"
>
    @method('PUT')

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $group->name) }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">الرياضة</label>
            <select name="sport_id" class="form-control" required>
                <option value="">اختر الرياضة</option>
                @foreach($sports as $sport)
                    <option value="{{ $sport->id }}" {{ old('sport_id', $group->sport_id) == $sport->id ? 'selected' : '' }}>{{ $sport->name }}</option>
                @endforeach
            </select>
            @error('sport_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">المستوى</label>
            <input type="text" name="level" class="form-control"
                   value="{{ old('level', $group->level) }}">
            @error('level') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">الوصف</label>
            <textarea name="description" class="form-control">{{ old('description', $group->description) }}</textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">الحالة</label>
            <select name="is_active" class="form-control" required>
                <option value="">اختر الحالة</option>
                <option value="1" {{ old('is_active', $group->is_active) == '1' ? 'selected' : '' }}>نشط</option>
                <option value="0" {{ old('is_active', $group->is_active) == '0' ? 'selected' : '' }}>غير نشط</option>
            </select>
            @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">تاريخ البداية</label>
            <input type="date" name="start_date" class="form-control"
                   value="{{ old('start_date', $group->start_date) }}" required>
            @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">تاريخ النهاية</label>
            <input type="date" name="end_date" class="form-control"
                   value="{{ old('end_date', $group->end_date) }}" required>
            @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
        </div> 
    </div>
</x-form>
@endsection