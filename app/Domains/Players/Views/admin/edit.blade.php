@extends('layouts.master',['titlePage'=>$titlePage])

<x-page-header :sectionPage="$sectionPage" :titlePage="$titlePage" />

@section('css')
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
@endsection

@section('content')

<x-form
    :action="route('admin.players.update', $player->id)"
    submitLabel="تعديل بيانات اللاعب"
    cancelRoute="admin.players.index"
    enctype="multipart/form-data">

    @method('PUT')

    <div class="row">

        <x-auth.login-fields :emailRequired="false" :email="$player->user->email" :passwordRequired="false" />

        <!--  Basic Data Header -->
        <div class="col-12 mb-3 mt-4">
            <div class="bg-primary text-white p-2 rounded">
                <strong>البيانات الأساسية</strong>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control"
                value="{{ old('name', $player->name) }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">رقم الهاتف</label>
            <input type="text" name="phone" class="form-control"
                value="{{ old('phone', $player->phone) }}" required>
            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">المدرسة</label>
            <input type="text" name="school" class="form-control"
                value="{{ old('school', $player->school) }}">
            @error('school') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">الهوية الوطنية</label>
            <input type="text" name="national_id" class="form-control"
                value="{{ old('national_id', $player->national_id) }}" required>
            @error('national_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">العمر</label>
            <input type="number" name="age" class="form-control"
                value="{{ old('age', $player->age) }}" required>
            @error('age') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">الوزن</label>
            <input type="number" step="0.1" name="weight" class="form-control"
                value="{{ old('weight', $player->weight) }}">
            @error('weight') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">الطول</label>
            <input type="number" step="0.1" name="height" class="form-control"
                value="{{ old('height', $player->height) }}">
            @error('height') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">فصيلة الدم</label>
            <select name="blood_type" class="form-control">
                <option value="">اختر فصيلة الدم</option>
                @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $type)
                <option value="{{ $type }}"
                    {{ old('blood_type', $player->blood_type) == $type ? 'selected' : '' }}>
                    {{ $type }}
                </option>
                @endforeach
            </select>
            @error('blood_type') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">الجنس</label>
            <select name="gender" class="form-control" required>
                <option value="">اختر الجنس</option>
                <option value="male" {{ old('gender', $player->gender) == 'male' ? 'selected' : '' }}>ذكر</option>
                <option value="female" {{ old('gender', $player->gender) == 'female' ? 'selected' : '' }}>أنثى</option>
            </select>
            @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">الصورة الشخصية</label>

            @if($player->image)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $player->image) }}" width="120" height="120" style="object-fit: cover;">
            </div>
            @endif

            <input type="file" name="image" class="form-control dropify" accept="image/*" data-height="150">

            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">العنوان</label>
            <textarea name="address" rows="2" class="form-control">{{ old('address', $player->address) }}</textarea>
            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">الوصف</label>
            <textarea name="description" rows="3" class="form-control">{{ old('description', $player->description) }}</textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

    </div>

</x-form>

@endsection

@section('js')
<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
@endsection