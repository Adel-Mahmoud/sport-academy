@extends('layouts.academy')
@section('section')
<x-section_edit titlePage="تعديل بيانات المدرب" routeTo="{{route('coaches.update', $coach->id)}}">
  <div class="card-block">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nf-name">إسم النشاط</label>
        <input type="text" id="nf-name" name="coach_name" class="form-control" value="{{ $coach->coach_name }}" placeholder="ادخل إسم المدرب " required>
        @error('coach_name')
            <span class="invalid-feedback text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
      <label for="nf-role">النشاط</label>
      <select id="nf-role" name="sport_id" class="form-control" required>
          <option value="">إختار النشاط</option>
          @foreach ($sports as $sport)
            <option value="{{ $sport->id }}" {{$sport->id == $coach->sport_id ? 'selected' : ''}}>{{ $sport->sport_name }}</option>
          @endforeach
      </select>
      @error('sport_id')
          <span class="invalid-feedback text-danger" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror    
    </div>
  </div>
</x-section_edit>
@endsection