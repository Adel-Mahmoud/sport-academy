@extends('layouts.academy')
@section('section')
<x-section_add titlePage="صفحة إدارة الفرق" routeTo="teams.store">
  <div class="card-block">
        @csrf
        <div class="form-group">
            <label for="nf-name">إسم الفريق</label>
            <input type="text" id="nf-name" name="team_name" class="form-control" value="{{old('tame')}}" placeholder="ادخل إسم الفريق " required>
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
                <option value="{{ $sport->id }}">{{ $sport->sport_name }}</option>
              @endforeach
          </select>
          @error('sport_id')
              <span class="invalid-feedback text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror    
        </div>
      </div>
</x-section_add>

<x-section_table searchName="ابحث عن الفريق..." dataName="الفرق" count="{{$count}}">
  <div class="card-block">
      <table class="table table-bordered table-striped table-condensed">
          <thead>
              <tr>
                  <th>رقم</th>
                  <th>اسم الفريق</th>
                  <th>اسم النشاط</th>
                  <th>التاريخ</th>
                  <th>حدث</th>
              </tr>
          </thead>
          <tbody>
            @if(count($teams) > 0)
              @php
                  $id = ($teams->currentPage() - 1) * $teams->perPage() + 1;
              @endphp
              @foreach ($teams as $team)
                <tr>
                    <td>{{ $id++ }}</td>
                    <td><a href="{{url('teams/'.$team->id)}}"> {{ $team->team_name }} </a></td>
                    <td> {{ optional($team->sport)->sport_name }} </td>
                    <td>{{ $team->created_at->format('Y-m-d') }}</td>
                    <td>
                      <a href="{{ route('teams.edit', $team->id) }}" class="btn-sm btn-success" >تعديل</a> | 
                      <form action="{{ route('teams.destroy', $team->id) }}" method="POST" style="display: inline" class="formDelete">
                          @csrf
                          @method('DELETE')
                          <button class="btn-sm btn-danger" style="border:none;outline:none;" > حذف</button>
                      </form>
                    </td>
                </tr>
              @endforeach
            @else
              <tr><td colspan="5" style="text-align: center;">لا يوجد بيانات</td></tr>
            @endif
          </tbody>
      </table>
      <div class="pagination">
          <ul class="pagination">
              @if ($teams->onFirstPage())
                  <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                      <span class="page-link" aria-hidden="true">&lsaquo;</span>
                  </li>
              @else
                  <li class="page-item">
                      <a class="page-link" href="{{ $teams->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                  </li>
              @endif
      
              @php
              $numOfPages = $teams->lastPage();
              $currentPage = $teams->currentPage();
              $showPages = 5; 
              $half = floor($showPages / 2);
              $startPage = max($currentPage - $half, 1);
              $endPage = min($startPage + $showPages - 1, $numOfPages);
              @endphp
      
              @for ($i = $startPage; $i <= $endPage; $i++)
                  @if ($i == $teams->currentPage())
                      <li class="page-item active" aria-current="page">
                          <span class="page-link">{{ $i }}</span>
                      </li>
                  @else
                      <li class="page-item">
                          <a class="page-link" href="{{ $teams->url($i) }}">{{ $i }}</a>
                      </li>
                  @endif
              @endfor
      
              @if ($teams->hasMorePages())
                  <li class="page-item">
                      <a class="page-link" href="{{ $teams->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                  </li>
              @else
                  <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                      <span class="page-link" aria-hidden="true">&rsaquo;</span>
                  </li>
              @endif
          </ul>
      </div>
  </div>
</x-section_table>
@endsection