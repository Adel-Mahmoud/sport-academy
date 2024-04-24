@extends('layouts.academy')
@section('section')
  <br/>
  <h1 class="text-primary" style="text-align: center;">
    سجل الرواتب المدفوعة
  </h1>
  <br/>
  <br/>
    
  <x-section_table searchName="ابحث عن الموظف..." dataName=" المرتبات" count="{{$count}}">
    <div class="card-block" style="padding:0 20px;">
      <a href="{{url('salary_old')}}" class="text-danger" style="float:left;">
       عرض السجلات السابقة
      </a>
    </div>
    <div class="card-block">
      <table class="table table-bordered table-striped table-condensed">
          <thead>
              <tr>
                  <th>رقم</th>
                  <th>اسم الموظف</th>
                  <th>اسم الوظيفة</th>
                  <th>الراتب الشهري</th>
                  <th>التاريخ</th>
                  <th>حدث</th>
              </tr>
          </thead>
          <tbody>
            @if(count($paid) > 0)
              @php
                  $id = ($paid->currentPage() - 1) * $paid->perPage() + 1;
              @endphp
              @foreach ($paid as $employee)
                <tr>
                    <td>{{ $id++ }}</td>
                    <td> {{ $employee->employee->emp_name }} </td>
                    <td> {{ optional($employee->employee)->job->job_name }} </td>
                    <td>{{ $settings['currency'] . $employee->salary }}</td>
                    <td>{{ $employee->created_at->format('Y-m-d') }}</td>
                    <td>
                      <form action="{{ route('salary.destroy', $employee->id) }}" method="POST" style="display: inline" class="formDelete">
                          @csrf
                          @method('DELETE')
                          <button class="btn-sm btn-danger" style="border:none;outline:none;" > حذف</button>
                      </form>
                    </td>
                </tr>
              @endforeach
              <tr>
                <td colspan="2">مجموع الرواتب المدفوعة</td>
                <td colspan="4">{{ $settings['currency'] . $totalPaidSalaries }}</td>
              </tr>
            @else
              <tr><td colspan="6" style="text-align: center;">لا يوجد بيانات</td></tr>
            @endif
          </tbody>
      </table>
      <div class="pagination">
          <ul class="pagination">
              @if ($paid->onFirstPage())
                  <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                      <span class="page-link" aria-hidden="true">&lsaquo;</span>
                  </li>
              @else
                  <li class="page-item">
                      <a class="page-link" href="{{ $paid->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                  </li>
              @endif
      
              @php
              $numOfPages = $paid->lastPage();
              $currentPage = $paid->currentPage();
              $showPages = 5; 
              $half = floor($showPages / 2);
              $startPage = max($currentPage - $half, 1);
              $endPage = min($startPage + $showPages - 1, $numOfPages);
              @endphp
      
              @for ($i = $startPage; $i <= $endPage; $i++)
                  @if ($i == $paid->currentPage())
                      <li class="page-item active" aria-current="page">
                          <span class="page-link">{{ $i }}</span>
                      </li>
                  @else
                      <li class="page-item">
                          <a class="page-link" href="{{ $paid->url($i) }}">{{ $i }}</a>
                      </li>
                  @endif
              @endfor
      
              @if ($paid->hasMorePages())
                  <li class="page-item">
                      <a class="page-link" href="{{ $paid->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
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