@extends('layouts.academy')
@section('section')
<x-section_edit titlePage="تعديل بيانات الموظف" routeTo="{{route('employees.update', $employee->id)}}">
  <div class="card-block">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nf-name">إسم الموظف</label>
        <input type="text" id="nf-name" name="emp_name" class="form-control" value="{{ $employee->emp_name }}" placeholder="ادخل إسم الموظف " required>
        @error('emp_name')
            <span class="invalid-feedback text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
      <label for="nf-role">الوظيفة</label>
      <select id="nf-role" name="job_id" class="form-control" required>
          <option value="">إختار الوظيفة</option>
          @foreach ($jobs as $job)
            <option value="{{ $job->id }}" {{$job->id == $employee->job_id ? 'selected' : ''}}>{{ $job->job_name }}</option>
          @endforeach
      </select>
      @error('job_id')
          <span class="invalid-feedback text-danger" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror    
    </div>
  </div>
</x-section_edit>
@endsection