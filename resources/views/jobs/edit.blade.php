@extends('layouts.academy')
@section('section')
<x-section_edit titlePage="تعديل الوظيفة" routeTo="{{}}">
  <div class="card-block">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nf-name">إسم الوظيفة</label>
        <input type="text" id="nf-name" name="job_name" class="form-control" value="{{ $job->job_name }}" placeholder="ادخل إسم الوظيفة " required>
        @error('job_name')
            <span class="invalid-feedback text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
  </div>
</x-section_edit>
@endsection