@extends('layouts.academy')
@section('section')
  <br/>
  <h1 class="text-primary" style="text-align: center;">
    عرض بيانات لاعبين نشاط : 
    {{$sport_name}}
  </h1>
  <br/>
  <br/>
  <x-section_table searchName="ابحث عن اللاعب..." dataName=" الانشطة" count="{{$count}}">
    <div class="card-block">
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <tr>
                    <th>رقم</th>
                    <th>اسم اللاعب</th>
                    <th>حدث</th>
                </tr>
            </thead>
            <tbody>
              @if(count($players) > 0)
                @php $id = 1;@endphp
                @foreach ($players as $player)
                  <tr>
                      <td>{{ $id++ }}</td>
                      <td> {{ $player->player_name }} </td>
                      <td>
                        <a href="{{ route('players.edit', $player->id) }}" class="tag tag-success" >تعديل</a> | 
                        <form action="{{ route('players.destroy', $player->id) }}" method="POST" style="display: inline" class="formDelete">
                            @csrf
                            @method('DELETE')
                            <button class="tag tag-danger" style="border:none;outline:none;" > حذف</button>
                        </form>
                      </td>
                  </tr>
                @endforeach
              @else
                <tr>
                      <td colspan="4" style="text-align: center;">
                        لا يوجد بيانات
                      </td>
                </tr>
              @endif
            </tbody>
        </table>
        <div class="pagination">
          <ul class="pagination">
              @if ($players->onFirstPage())
                  <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                      <span class="page-link" aria-hidden="true">&lsaquo;</span>
                  </li>
              @else
                  <li class="page-item">
                      <a class="page-link" href="{{ $players->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                  </li>
              @endif
      
              @php
              $numOfPages = $players->lastPage();
              $currentPage = $players->currentPage();
              $showPages = 5; 
              $half = floor($showPages / 2);
              $startPage = max($currentPage - $half, 1);
              $endPage = min($startPage + $showPages - 1, $numOfPages);
              @endphp
      
              @for ($i = $startPage; $i <= $endPage; $i++)
                  @if ($i == $players->currentPage())
                      <li class="page-item active" aria-current="page">
                          <span class="page-link">{{ $i }}</span>
                      </li>
                  @else
                      <li class="page-item">
                          <a class="page-link" href="{{ $players->url($i) }}">{{ $i }}</a>
                      </li>
                  @endif
              @endfor
      
              @if ($players->hasMorePages())
                  <li class="page-item">
                      <a class="page-link" href="{{ $players->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
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