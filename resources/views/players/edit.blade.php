@extends('layouts.academy')
@section('section')
<x-section_edit titlePage="تعديل بيانات اللاعب" routeTo="{{route('players.update', $player->id)}}">
  <div class="card-block">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group">
            <label for="player_name">إسم اللاعب</label>
            <input type="text" id="player_name" name="player_name" class="form-control" value="{{$player->player_name}}" placeholder="ادخل إسم اللاعب " required>
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
            <input type="date" id="date_of_pirth" value="{{$player->date_of_pirth}}" name="date_of_pirth" class="form-control" value="{{old('date_of_pirth')}}" placeholder="تاريخ الميلاد" required>
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
            <input type="number" id="phone" name="phone" class="form-control" value="{{$player->phone}}" placeholder="رقم الهاتف" required>
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
            <input type="email" id="email" name="email" class="form-control" value="{{$player->email}}" placeholder="البريد الالكتروني" required>
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
            <input type="file" id="profile_picture" name="profile_picture" style="display:none;" accept="image/*">
            <input type="text" value="{{$player->profile_picture}}" name="profile_picture_static" style="display:none;">
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
        <a href="{{ asset('images/players/'.$player->profile_picture) }}">
          <img src="{{ asset('images/players/'.$player->profile_picture) }}" id="imagePreview1" style="width:70px;height:70px;">
        </a>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <div class="form-group">
            <label for="id_card_picture">صورة البطاقة الشخصية</label>
            <input type="file" id="id_card_picture" name="id_card_picture" class="form-control" style="display:none;" accept="image/*">
            <input type="text" value="{{$player->id_card_picture}}" name="id_card_picture_static" style="display:none;">
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
        <a href="{{ asset('images/players/'.$player->id_card_picture) }}">
          <img src="{{ asset('images/players/'.$player->id_card_picture) }}" id="imagePreview2" style="width:70px;height:70px;">
        </a>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <div class="form-group">
            <label for="club_membership_picture">الصورة كارنيه النادي</label>
            <input type="file" id="club_membership_picture" name="club_membership_picture" class="form-control" style="display:none;" accept="image/*">
            <input type="text" value="{{$player->club_membership_picture}}" name="club_membership_picture_static" style="display:none;">
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
        <a href="{{ asset('images/players/'.$player->club_membership_picture) }}">
          <img src="{{ asset('images/players/'.$player->club_membership_picture) }}" id="imagePreview3" style="width:70px;height:70px;">
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <div class="form-group">
          <label for="nf-role">النشاط</label>
          <select id="nf-role" name="sport_id" class="form-control" required>
              <option value="">إختار النشاط</option>
              @foreach ($sports as $sport)
                <option value="{{ $sport->id }}" {{$sport->id == $player->sport_id ? 'selected' : ''}}>{{ $sport->sport_name }}</option>
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
              <option value="">إختار الفريق</option>
              @foreach ($teams as $team)
                <option value="{{ $team->id }}" {{$team->id == $player->team_id ? 'selected' : ''}}>{{ $team->team_name }}</option>
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
</x-section_edit>
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