@extends('layouts.academy')
@section('section')
<x-section_add titlePage="إدارة المصروفات" routeTo="expenses.store">
  <div class="card-block">
    @csrf
    <div class="form-group">
        <label for="expens">المصروف</label>
        <input type="number" id="expens" name="expens" class="form-control" value="{{old('expens')}}" placeholder="ادخل القيمة المصروفة  " required>
        @error('expens')
            <span class="invalid-feedback text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="nf-name">سبب الصرف</label>
        <input type="text" id="nf-reason" name="reason" class="form-control" value="{{old('reason')}}" placeholder="ادخل سبب الصرف  " required>
        @error('reason')
            <span class="invalid-feedback text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="nf-date">تاريخ الصرف </label>
        <input type="date" id="nf-date" name="date_at" class="form-control" value="{{date('Y-m-d')}}">
    </div>
  </div>

</x-section_add>
  
<x-section_table searchName="ابحث عن مصروف..." dataName=" الانشطة" count="{{$count}}">
  <div class="card-block">
    <table class="table table-bordered table-striped table-condensed">
        <thead>
            <tr>
                <th>رقم</th>
                <th>القيمة المصروفة</th>
                <th>سبب الصرف</th>
                <th>التاريخ</th>
                <th>حدث</th>
            </tr>
        </thead>
        <tbody>
          @if(count($expenses) > 0)
            @php
                $id = ($expenses->currentPage() - 1) * $expenses->perPage() + 1;
            @endphp
            @foreach ($expenses as $expens)
              <tr>
                  <td>{{ $id++ }}</td>
                  <td>{{ $expens->expens }}</td>
                  <td>{{ $expens->reason }}</td>
                  <td>{{ $expens->date_at}}</td>
                  <td>
                    <a href="{{ route('expenses.edit', $expens->id) }}" class="btn-sm btn-success" >تعديل</a> | 
                    <form action="{{ route('expenses.destroy', $expens->id) }}" method="POST" style="display: inline" class="formDelete">
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
        <tfoot>
          <tr>
            <td colspan="2">الإجمالي</td>
            <td colspan="3">{{$total}}</td>
          </tr>
          <tr>
            <td colspan="2">المبلغ المتبقي</td>
            <td colspan="3">{{$remaining_amount}}</td>
          </tr>
        </tfoot>
    </table>
    <div class="pagination">
        <ul class="pagination">
            @if ($expenses->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $expenses->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif
    
            @php
            $numOfPages = $expenses->lastPage();
            $currentPage = $expenses->currentPage();
            $showPages = 5; 
            $half = floor($showPages / 2);
            $startPage = max($currentPage - $half, 1);
            $endPage = min($startPage + $showPages - 1, $numOfPages);
            @endphp
    
            @for ($i = $startPage; $i <= $endPage; $i++)
                @if ($i == $expenses->currentPage())
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">{{ $i }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $expenses->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor
    
            @if ($expenses->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $expenses->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
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
<script>
  document.querySelector('form').addEventListener('submit', function (evt) {
    evt.preventDefault();
  /*  var expenseValue = number(document.querySelector('#expens').value);
    var remainingAmount = 500 || 0;
    if (expenseValue > remainingAmount) {
      alert('Error'+remainingAmount)
      //  swal("تنبيه", "الخزنة لا تكفي   !", "warning");
    } */
  });
  
</script>
@endsection