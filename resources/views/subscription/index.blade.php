@extends('layouts.academy')
@section('section')
  <section style="max-width:700px !important;" class="container">
    <br/>
    <h1 class="text-primary" style="text-align: center;">
      صفحة 
      إدارة 
      الإشتراكات
    </h1>
    <br/>
    <br/>
    <div class="card" style="overflow:scroll;">
      <div class="card-header">
          <i class="fa fa-align-justify"></i> 
          بيانات الإشتراكات
      </div>
      <div class="card-block">
          <table class="table table-bordered table-striped table-condensed">
              <thead>
                  <tr>
                      <th>رقم</th>
                      <th>اسم اللاعب</th>
                      <th>اسم النشاط</th>
                      <th>الإشتراك</th>
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
                        <td> {{ optional($player->sport)->sport_name }} </td>
                        <td> <input type="number" class="form-control" placeholder="ادخل قيمة الإشتراك"> </td>
                        <td>
                          <form action="{{ route('subscribe.destroy', $player->id) }}" method="POST" style="display: inline" class="formDelete">
                              @csrf
                              @method('DELETE')
                              <button class="tag tag-success" style="border:none;outline:none;" > دفع</button>
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
              @if ($players->onFirstPage())
              <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
              </li>
              @else
              <li class="page-item">
                <a class="page-link" href="{{ $players->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
              </li>
              @endif
              
              @for ($i = 1; $i <= $players->lastPage(); $i++)
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
  </div>
  </section>

@endsection