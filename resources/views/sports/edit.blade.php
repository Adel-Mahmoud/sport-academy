@extends('layouts.academy')
@section('section')
<x-section_edit titlePage="تعديل النشاط" routeTo="{{route('sports.update', $sport->id)}}">
  <div class="card-block">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nf-name">إسم النشاط</label>
        <input type="text" id="nf-name" name="sport_name" class="form-control" value="{{ $sport->sport_name }}" placeholder="ادخل إسم النشاط " required>
        @error('sport_name')
            <span class="invalid-feedback text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
  </div>
</x-section_edit>
@endsection