@extends('layouts.academy')
@section('section')
<x-section_add titlePage="إدارة الانشطة" routeTo="sports.store">
  <div class="card-block">
    @csrf
    <div class="form-group">
        <label for="nf-name">إسم النشاط</label>
        <input type="text" id="nf-name" name="sport_name" class="form-control" value="{{old('sport_name')}}" placeholder="ادخل إسم النشاط " required>
        @error('sport_name')
            <span class="invalid-feedback text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
  </div>
</x-section_add>

<x-section_table searchName="ابحث عن نشاط..." dataName=" الانشطة" count="{{$count}}">
  <div class="card-block">
      <table class="table table-bordered table-striped table-condensed">
          <thead>
              <tr>
                  <th>رقم</th>
                  <th>اسم النشاط</th>
                  <th>التاريخ</th>
                  <th>حدث</th>
              </tr>
          </thead>
          <tbody>
            @if($count > 0)
              @php
                  $id = ($sports->currentPage() - 1) * $sports->perPage() + 1;
              @endphp
              @foreach ($sports as $sport)
                <tr>
                    <td>{{ $id++ }}</td>
                    <td><a href="{{url('sports/'.$sport->id)}}"> {{ $sport->sport_name }} </a></td>
                    <td>{{ $sport->created_at->format('Y-m-d') }}</td>
                    <td>
                      <a href="{{ route('sports.edit', $sport->id) }}" class="btn-sm btn-success" >تعديل</a> | 
                      <form action="{{ route('sports.destroy', $sport->id) }}" method="POST" style="display: inline" class="formDelete">
                          @csrf
                          @method('DELETE')
                          <button class="btn-sm btn-danger" style="border:none;outline:none;" > حذف</button>
                      </form>
                    </td>
                </tr>
              @endforeach
            @else
              <tr><td colspan="4" style="text-align: center;">لا يوجد بيانات</td></tr>
            @endif
          </tbody>
      </table>
      <div class="pagination">
          <ul class="pagination">
              @if ($sports->onFirstPage())
                  <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                      <span class="page-link" aria-hidden="true">&lsaquo;</span>
                  </li>
              @else
                  <li class="page-item">
                      <a class="page-link" href="{{ $sports->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                  </li>
              @endif
      
              @php
              $numOfPages = $sports->lastPage();
              $currentPage = $sports->currentPage();
              $showPages = 5; 
              $half = floor($showPages / 2);
              $startPage = max($currentPage - $half, 1);
              $endPage = min($startPage + $showPages - 1, $numOfPages);
              @endphp
      
              @for ($i = $startPage; $i <= $endPage; $i++)
                  @if ($i == $sports->currentPage())
                      <li class="page-item active" aria-current="page">
                          <span class="page-link">{{ $i }}</span>
                      </li>
                  @else
                      <li class="page-item">
                          <a class="page-link" href="{{ $sports->url($i) }}">{{ $i }}</a>
                      </li>
                  @endif
              @endfor
      
              @if ($sports->hasMorePages())
                  <li class="page-item">
                      <a class="page-link" href="{{ $sports->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
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