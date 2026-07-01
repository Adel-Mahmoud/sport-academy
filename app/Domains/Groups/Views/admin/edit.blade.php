@extends('layouts.master',['titlePage'=>$titlePage])

<x-page-header :sectionPage="$sectionPage" :titlePage="$titlePage" />

@section('content')
<x-form
    :action="route('admin.groups.update', $group->id)"
    submitLabel="تعديل Group"
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
    </div>
</x-form>
@endsection