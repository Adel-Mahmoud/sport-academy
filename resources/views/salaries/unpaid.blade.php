@extends('layouts.academy')
@section('section')
  <br/>
  <h1 class="text-primary" style="text-align: center;">
     سجل الرواتب الغير مدفوعة
  </h1>
  <br/>
  <br/>
  
  <x-section_table searchName="ابحث عن الموظف..." dataName=" المرتبات" count="{{$count}}">
      <div class="card-block">
          <table class="table table-bordered table-striped table-condensed">
              <thead>
                  <tr>
                      <th>رقم</th>
                      <th>اسم الموظف</th>
                      <th>اسم الوظيفة</th>
                      <th> الراتب الشهري </th>
                      <th> يخصم الراتب من </th>
                      <th>حدث</th>
                  </tr>
              </thead>
              <tbody>
                @if(count($unpaid) > 0)
                  @php
                    $id = ($unpaid->currentPage() - 1) * $unpaid->perPage() + 1;
                  @endphp
                  @foreach ($unpaid as $employee)
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td> {{ $employee->emp_name }} </td>
                        <td> {{ $employee->job->job_name }} </td>
                          <form action="{{ route('salary.store') }}" method="POST" style="display: inline">
                        <td>@csrf <input type="number" name="salary" class="form-control" placeholder="ادخل قيمة الراتب " required> </td>
                        <td>
                          <select class="form-control" name="ratio" required>
                            <option value="">إختار النسبة</option>
                            <option value="1">{{$settings['ratio1']}}%</option>
                            <option value="2">{{$settings['ratio2']}}%</option>
                            <option value="3">{{$settings['ratio3']}}%</option>
                          </select>
                        </td>
                        <td>
                              <input name="emp_id" value="{{$employee->id}}" type="hidden"/>
                              <input name="job_id" value="{{$employee->job_id}}" type="hidden"/>
                              <button class="btn-sm btn-primary" style="border:none;outline:none;" type="submit"> قبض</button>
                        </td>
                          </form>
                    </tr>
                  @endforeach
                @else
                  <tr>
                        <td colspan="5" style="text-align: center;">
                          لا يوجد بيانات
                        </td>
                  </tr>
                @endif
              </tbody>
          </table>
          <div class="pagination">
              <ul class="pagination">
                  @if ($unpaid->onFirstPage())
                      <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                          <span class="page-link" aria-hidden="true">&lsaquo;</span>
                      </li>
                  @else
                      <li class="page-item">
                          <a class="page-link" href="{{ $unpaid->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                      </li>
                  @endif
          
                  @php
                  $numOfPages = $unpaid->lastPage();
                  $currentPage = $unpaid->currentPage();
                  $showPages = 5; 
                  $half = floor($showPages / 2);
                  $startPage = max($currentPage - $half, 1);
                  $endPage = min($startPage + $showPages - 1, $numOfPages);
                  @endphp
          
                  @for ($i = $startPage; $i <= $endPage; $i++)
                      @if ($i == $unpaid->currentPage())
                          <li class="page-item active" aria-current="page">
                              <span class="page-link">{{ $i }}</span>
                          </li>
                      @else
                          <li class="page-item">
                              <a class="page-link" href="{{ $unpaid->url($i) }}">{{ $i }}</a>
                          </li>
                      @endif
                  @endfor
          
                  @if ($unpaid->hasMorePages())
                      <li class="page-item">
                          <a class="page-link" href="{{ $unpaid->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
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
  </x-section_table>
@endsection