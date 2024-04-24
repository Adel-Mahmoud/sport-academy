@extends('layouts.academy')
@section('section')
<x-section_add titlePage="صفحة إدارة المدربين" routeTo="coaches.store">
  <div class="card-block">
        @csrf
        <div class="form-group">
            <label for="nf-name">إسم المدرب</label>
            <input type="text" id="nf-name" name="coach_name" class="form-control" value="{{old('coach_name')}}" placeholder="ادخل إسم المدرب " required>
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

<x-section_table searchName="ابحث عن المدرب..." dataName="المدربين" count="{{$count}}">
  <div class="card-block">
      <table class="table table-bordered table-striped table-condensed">
          <thead>
              <tr>
                  <th>رقم</th>
                  <th>اسم المدرب</th>
                  <th>اسم النشاط</th>
                  <th>التاريخ</th>
                  <th>حدث</th>
              </tr>
          </thead>
          <tbody>
            @if(count($coaches) > 0)
              @php
                  $id = ($coaches->currentPage() - 1) * $coaches->perPage() + 1;
              @endphp
              @foreach ($coaches as $coach)
                <tr>
                    <td>{{ $id++ }}</td>
                    <td> {{ $coach->coach_name }} </td>
                    <td> {{ optional($coach->sport)->sport_name }} </td>
                    <td>{{ $coach->created_at->format('Y-m-d') }}</td>
                    <td>
                      <a href="{{ route('coaches.edit', $coach->id) }}" class="btn-sm btn-success" >تعديل</a> | 
                      <form action="{{ route('coaches.destroy', $coach->id) }}" method="POST" style="display: inline" class="formDelete">
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
              @if ($coaches->onFirstPage())
                  <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                      <span class="page-link" aria-hidden="true">&lsaquo;</span>
                  </li>
              @else
                  <li class="page-item">
                      <a class="page-link" href="{{ $coaches->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                  </li>
              @endif
      
              @php
              $numOfPages = $coaches->lastPage();
              $currentPage = $coaches->currentPage();
              $showPages = 5; 
              $half = floor($showPages / 2);
              $startPage = max($currentPage - $half, 1);
              $endPage = min($startPage + $showPages - 1, $numOfPages);
              @endphp
      
              @for ($i = $startPage; $i <= $endPage; $i++)
                  @if ($i == $coaches->currentPage())
                      <li class="page-item active" aria-current="page">
                          <span class="page-link">{{ $i }}</span>
                      </li>
                  @else
                      <li class="page-item">
                          <a class="page-link" href="{{ $coaches->url($i) }}">{{ $i }}</a>
                      </li>
                  @endif
              @endfor
      
              @if ($coaches->hasMorePages())
                  <li class="page-item">
                      <a class="page-link" href="{{ $coaches->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
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