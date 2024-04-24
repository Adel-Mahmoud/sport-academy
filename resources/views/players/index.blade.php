@extends('layouts.academy')
@section('section')
<x-section_add titlePage="إدارة اللاعبين" routeTo="players.store">
  <div class="card-block">
    @csrf
    
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group">
            <label for="player_name">إسم اللاعب</label>
            <input type="text" id="player_name" name="player_name" class="form-control" value="{{old('player_name')}}" placeholder="ادخل إسم اللاعب " required>
            @error('player_name')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>الحقل فارغ</strong>
                </span>
            @enderror
        </div>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group">
            <label for="date_of_pirth">تاريخ الميلاد</label>
            <input type="date" id="date_of_pirth" name="date_of_pirth" class="form-control" value="{{old('date_of_pirth')}}" placeholder="تاريخ الميلاد" required>
            @error('date_of_pirth')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>الحقل فارغ</strong>
                </span>
            @enderror
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group">
            <label for="phone">رقم الهاتف</label>
            <input type="number" id="phone" name="phone" class="form-control" value="{{old('phone')}}" placeholder="رقم الهاتف" required>
            @error('phone')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>الحقل فارغ</strong>
                </span>
            @enderror
        </div>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group">
            <label for="email">البريد الالكتروني</label>
            <input type="email" id="email" name="email" class="form-control" value="{{old('email')}}" placeholder="البريد الالكتروني" required>
            @error('email')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>الحقل فارغ</strong>
                </span>
            @enderror
        </div>
      </div>
    </div>
    <hr>
    
    <div class="row">
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <div class="form-group">
            <label for="profile_picture">الصورة الشخصية</label>
            <input type="file" id="profile_picture" name="profile_picture" class="form-control" style="display:none;" accept="image/*" required>
            @error('profile_picture')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>الحقل فارغ</strong>
                </span>
            @enderror
        </div>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-center">
        <br>
        <label for="profile_picture"><i class="fa fa-upload fa-xl text-info"></i></label>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <img src="{{ asset('images/no-image.jpg') }}" id="imagePreview1" style="width:70px;height:70px;">
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <div class="form-group">
            <label for="id_card_picture">صورة البطاقة الشخصية</label>
            <input type="file" id="id_card_picture" name="id_card_picture" class="form-control" style="display:none;" accept="image/*" required>
            @error('id_card_picture')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>الحقل فارغ</strong>
                </span>
            @enderror
        </div>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-center">
        <br>
        <label for="id_card_picture"><i class="fa fa-upload fa-xl text-info"></i></label>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <img src="{{ asset('images/no-image.jpg') }}" id="imagePreview2" style="width:70px;height:70px;">
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <div class="form-group">
            <label for="club_membership_picture">الصورة كارنيه النادي</label>
            <input type="file" id="club_membership_picture" name="club_membership_picture" class="form-control" style="display:none;" accept="image/*" required>
            @error('club_membership_picture')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>الحقل فارغ</strong>
                </span>
            @enderror
        </div>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-center">
        <br>
        <label for="club_membership_picture"><i class="fa fa-upload fa-xl text-info"></i></label>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <img src="{{ asset('images/no-image.jpg') }}" id="imagePreview3" style="width:70px;height:70px;">
      </div>
    </div>

    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group">
          <label for="nf-role">النشاط</label>
          <select id="nf-role" name="sport_id" class="form-control" required>
              <option value="">إختار النشاط</option>
              @foreach ($sports as $sport)
                <option value="{{ $sport->id }}">{{ $sport->sport_name }}</option>
              @endforeach
          </select>
          @error('sport_id')
              <span class="invalid-feedback text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror    
        </div>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group">
          <label for="nf-role">الفريق</label>
          <select id="nf-role" name="team_id" class="form-control">
              <option value="">تحديد الفريق </option>
              @foreach ($teams as $team)
                <option value="{{ $team->id }}">{{ $team->team_name }}</option>
              @endforeach
          </select>
          @error('team_id')
              <span class="invalid-feedback text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror    
        </div>
      </div>
    </div>
    
  </div>
</x-section_add>

<x-section_table searchName="ابحث عن لاعب..." dataName="اللاعبين" count="{{$count}}">
  <div class="card-block">
      <table class="table table-bordered table-striped table-condensed">
          <thead>
              <tr>
                  <th>رقم</th>
                  <th>اسم اللاعب</th>
                  <th>اسم النشاط</th>
                  <th>اسم الفريق</th>
                  <th>التاريخ</th>
                  <th>حدث</th>
              </tr>
          </thead>
          <tbody>
            @if(count($players) > 0)
              @php
                  $id = ($players->currentPage() - 1) * $players->perPage() + 1;
              @endphp
              @foreach ($players as $player)
                <tr>
                    <td>{{ $id++ }}</td>
                    <td> {{ $player->player_name }} </td>
                    <td> {{ optional($player->sport)->sport_name }} </td>
                    <td> {{ optional($player->team)->team_name }} </td>
                    <td>{{ $player->created_at->format('Y-m-d') }}</td>
                    <td>
                      <a href="{{ route('players.edit', $player->id) }}" class="btn-sm btn-success" >تعديل</a> | 
                      <form action="{{ route('players.destroy', $player->id) }}" method="POST" style="display: inline" class="formDelete">
                          @csrf
                          @method('DELETE')
                          <button class="btn-sm btn-danger" style="border:none;outline:none;" > حذف</button>
                      </form>
                    </td>
                </tr>
              @endforeach
            @else
              <tr><td colspan="6" style="text-align: center;">لا يوجد بيانات</td></tr>
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
<script>
  const profilePictureInput = document.getElementById("profile_picture");
  const idCardPictureInput = document.getElementById("id_card_picture");
  const clubMembershipPictureInput = document.getElementById("club_membership_picture");

  const imagePreview1 = document.getElementById("imagePreview1");
  const imagePreview2 = document.getElementById("imagePreview2");
  const imagePreview3 = document.getElementById("imagePreview3");

  function imageView(input, imagePreview) {
    input.addEventListener('change', function () {
      const file = input.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          imagePreview.src = e.target.result;
        };
        reader.readAsDataURL(file);
      } else {
        imagePreview.src = '';
      }
    });
  }
  
  imageView(profilePictureInput, imagePreview1);
  imageView(idCardPictureInput, imagePreview2);
  imageView(clubMembershipPictureInput, imagePreview3);
</script>
@endsection