@extends('layouts.academy')
@section('section')
<x-section_add titlePage="إدارة الموظفين" routeTo="employees.store">
  <div class="card-block">
    @csrf
    <div class="form-group">
        <label for="nf-name">إسم الموظف</label>
        <input type="text" id="nf-name" name="emp_name" class="form-control" value="{{old('emp_name')}}" placeholder="ادخل إسم الموظف " required>
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
            <option value="{{ $job->id }}">{{ $job->job_name }}</option>
          @endforeach
      </select>
      @error('job_id')
          <span class="invalid-feedback text-danger" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror    
    </div>
  </div>
</x-section_add>

<x-section_table searchName="ابحث عن الموظف..." dataName="الموظفين" count="{{$count}}">
  <div class="card-block">
      <table class="table table-bordered table-striped table-condensed">
          <thead>
              <tr>
                  <th>رقم</th>
                  <th>اسم الموظف</th>
                  <th>اسم الوظيفة</th>
                  <th>التاريخ</th>
                  <th>حدث</th>
              </tr>
          </thead>
          <tbody>
            @if(count($employees) > 0)
              @php
                  $id = ($employees->currentPage() - 1) * $employees->perPage() + 1;
              @endphp
              @foreach ($employees as $employee)
                <tr>
                    <td>{{ $id++ }}</td>
                    <td> {{ $employee->emp_name }} </td>
                    <td> {{ optional($employee->job)->job_name }} </td>
                    <td>{{ $employee->created_at->format('Y-m-d') }}</td>
                    <td>
                      <a href="{{ route('employees.edit', $employee->id) }}" class="btn-sm btn-success" >تعديل</a> | 
                      <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline" class="formDelete">
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
              @if ($employees->onFirstPage())
                  <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                      <span class="page-link" aria-hidden="true">&lsaquo;</span>
                  </li>
              @else
                  <li class="page-item">
                      <a class="page-link" href="{{ $employees->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                  </li>
              @endif
      
              @php
              $numOfPages = $employees->lastPage();
              $currentPage = $employees->currentPage();
              $showPages = 5; 
              $half = floor($showPages / 2);
              $startPage = max($currentPage - $half, 1);
              $endPage = min($startPage + $showPages - 1, $numOfPages);
              @endphp
      
              @for ($i = $startPage; $i <= $endPage; $i++)
                  @if ($i == $employees->currentPage())
                      <li class="page-item active" aria-current="page">
                          <span class="page-link">{{ $i }}</span>
                      </li>
                  @else
                      <li class="page-item">
                          <a class="page-link" href="{{ $employees->url($i) }}">{{ $i }}</a>
                      </li>
                  @endif
              @endfor
      
              @if ($employees->hasMorePages())
                  <li class="page-item">
                      <a class="page-link" href="{{ $employees->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
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