@extends('layouts.academy')
@section('section')
<x-section_edit titlePage="تعديل بيانات الفريق" routeTo="{{route('teams.update', $team->id)}}">
  <div class="card-block">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nf-name">إسم الفريق</label>
        <input type="text" id="nf-name" name="team_name" class="form-control" value="{{ $team->team_name }}" placeholder="ادخل إسم الفريق " required>
        @error('team_name')
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
            <option value="{{ $sport->id }}" {{$sport->id == $team->sport_id ? 'selected' : ''}}>{{ $sport->sport_name }}</option>
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