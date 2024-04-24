@extends('layouts.academy')
@section('section')
<x-section_add titlePage="إدارة الوظائف" routeTo="jobs.store">
  <div class="card-block">
      @csrf
      <div class="form-group">
          <label for="nf-name">إسم الوظيفة</label>
          <input type="text" id="nf-name" name="job_name" class="form-control" value="{{old('job_name')}}" placeholder="ادخل إسم الوظيفة " required>
          @error('job_name')
              <span class="invalid-feedback text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
  </div>
</x-section_add>

<x-section_table searchName="ابحث عن وظيفة..." dataName="الوظائف" count="{{$count}}">
  <div class="card-block">
      <table class="table table-bordered table-striped table-condensed">
          <thead>
              <tr>
                  <th>رقم</th>
                  <th>اسم الوظيفة</th>
                  <th>التاريخ</th>
                  <th>حدث</th>
              </tr>
          </thead>
          <tbody>
            @if(count($jobs) > 0)
              @php
                  $id = ($jobs->currentPage() - 1) * $jobs->perPage() + 1;
              @endphp
              @foreach ($jobs as $job)
                <tr>
                    <td>{{ $id++ }}</td>
                    <td><a href="{{url('jobs/'.$job->id)}}"> {{ $job->job_name }} </a></td>
                    <td>{{ $job->created_at->format('Y-m-d') }}</td>
                    <td>
                      <a href="{{ route('jobs.edit', $job->id) }}" class="btn-sm btn-success" >تعديل</a> | 
                      <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display: inline" class="formDelete">
                          @csrf
                          @method('DELETE')
                          <button class="btn-sm btn-danger" style="border:none;outline:none;" > حذف</button>
                      </form>
                    </td>
                </tr>
              @endforeach
            @else
              <tr><td colspan="3" style="text-align: center;">لا يوجد بيانات</td></tr>
            @endif
          </tbody>
      </table>
      <div class="pagination">
          <ul class="pagination">
              @if ($jobs->onFirstPage())
                  <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                      <span class="page-link" aria-hidden="true">&lsaquo;</span>
                  </li>
              @else
                  <li class="page-item">
                      <a class="page-link" href="{{ $jobs->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                  </li>
              @endif
      
              @php
              $numOfPages = $jobs->lastPage();
              $currentPage = $jobs->currentPage();
              $showPages = 5; 
              $half = floor($showPages / 2);
              $startPage = max($currentPage - $half, 1);
              $endPage = min($startPage + $showPages - 1, $numOfPages);
              @endphp
      
              @for ($i = $startPage; $i <= $endPage; $i++)
                  @if ($i == $jobs->currentPage())
                      <li class="page-item active" aria-current="page">
                          <span class="page-link">{{ $i }}</span>
                      </li>
                  @else
                      <li class="page-item">
                          <a class="page-link" href="{{ $jobs->url($i) }}">{{ $i }}</a>
                      </li>
                  @endif
              @endfor
      
              @if ($jobs->hasMorePages())
                  <li class="page-item">
                      <a class="page-link" href="{{ $jobs->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
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