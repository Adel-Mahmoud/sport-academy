@extends('layouts.academy')
@section('section')
  <br/>
  <h1 class="text-primary" style="text-align: center;">
     بيانات اللاعبين الغير مشتركين
  </h1>
  <br/>
  <br/>
  <x-section_table searchName="ابحث عن اللاعب..." dataName=" الإشتراكات" count="{{$count}}">
    <div class="card-block">
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <tr>
                    <th>رقم</th>
                    <th>اسم اللاعب</th>
                    <th>اسم النشاط</th>
                    <th>قيمة الإشتراك </th>
                    <th>حدث</th>
                </tr>
            </thead>
            <tbody>
              @if(count($unpaid) > 0)
                @php
                  $id = ($unpaid->currentPage() - 1) * $unpaid->perPage() + 1;
                @endphp
                @foreach ($unpaid as $player)
                  <tr>
                      <td>{{ $id++ }}</td>
                      <td> {{ $player->player_name }} </td>
                      <td> {{ optional($player->sport)->sport_name }} </td>
                        <form action="{{ route('subscribe.store') }}" method="POST" style="display: inline">
                      <td>@csrf <input type="number" name="subscribe" class="form-control" placeholder="ادخل قيمة الاشتراك"> </td>
                      <td>
                            <input name="player_id" value="{{$player->id}}" type="hidden"/>
                            <input name="sport_id" value="{{$player->sport_id}}" type="hidden"/>
                            <button class="btn-sm btn-primary" style="border:none;outline:none;" type="submit"> دفع</button>
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
  </x-section_table>
@endsection