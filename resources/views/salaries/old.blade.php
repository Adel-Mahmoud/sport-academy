@extends('layouts.academy')
@section('section')
  <section class="container">
    <br/>
    <h1 class="text-primary" style="text-align: center;">
      سجل الرواتب المدفوعة سابقاً
    </h1>
    <br/>
    <br/>
    <div class="card" style="overflow-x:scroll;">
      <div class="card-header">
          <i class="fa fa-align-justify"></i> 
          بيانات الرواتب
        <div style="float:left; display:flex;">
          المجموع
          [<strong>{{$count}}</strong>]
        </div>
      </div>
      <div class="card-block" style="padding:10px 0 0 20px">
        <form method="POST" action="{{route('salary_delete_old')}}" class="formDelete">
          @csrf
          @method('DELETE')
          <button class="text-danger bg-light" style="border:none;float:left;">
  حذف السجلات السابقة
          </button>
        </form>
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
                  </tr>
              </thead>
              <tbody>
                @if(count($old) > 0)
                  @php
                      $id = ($old->currentPage() - 1) * $old->perPage() + 1;
                  @endphp
                  @foreach ($old as $employee)
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td> {{ optional($employee->employee)->emp_name }} </td>
                        <td> {{ optional(optional($employee->employee)->job)->job_name }} </td>
                        <td>{{ $settings['currency'] . $employee->salary }}</td>
                        <td>{{ $employee->created_at->format('Y-m-d') }}</td>
                    </tr>
                  @endforeach
                @else
                  <tr><td colspan="5" style="text-align: center;">لا يوجد بيانات</td></tr>
                @endif
              </tbody>
          </table>
          <div class="pagination">
              <ul class="pagination">
                  @if ($old->onFirstPage())
                      <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                          <span class="page-link" aria-hidden="true">&lsaquo;</span>
                      </li>
                  @else
                      <li class="page-item">
                          <a class="page-link" href="{{ $old->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                      </li>
                  @endif
          
                  @php
                  $numOfPages = $old->lastPage();
                  $currentPage = $old->currentPage();
                  $showPages = 5; 
                  $half = floor($showPages / 2);
                  $startPage = max($currentPage - $half, 1);
                  $endPage = min($startPage + $showPages - 1, $numOfPages);
                  @endphp
          
                  @for ($i = $startPage; $i <= $endPage; $i++)
                      @if ($i == $old->currentPage())
                          <li class="page-item active" aria-current="page">
                              <span class="page-link">{{ $i }}</span>
                          </li>
                      @else
                          <li class="page-item">
                              <a class="page-link" href="{{ $old->url($i) }}">{{ $i }}</a>
                          </li>
                      @endif
                  @endfor
          
                  @if ($old->hasMorePages())
                      <li class="page-item">
                          <a class="page-link" href="{{ $old->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                      </li>
                  @else
                      <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                          <span class="page-link" aria-hidden="true">&rsaquo;</span>
                      </li>
                  @endif
              </ul>
          </div>
      </div>
  </div>
  </section>
@endsection