@extends('layouts.academy')
@section('section')
<x-section_edit titlePage="إعداد بيانات النظام" routeTo="{{route('settings.update', ['setting' => 'id'])}}">
  <div class="card-block">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nf-title">العنوان الاساسي</label>
        <input type="text" id="nf-title" name="title" class="form-control" value="{{ $settings['title'] }}" placeholder="" required>
    </div>
    <!--
    <div class="form-group">
        <label for="nf-color">اللون الاساسي</label>
        <input type="text" id="nf-color" name="color" class="form-control" value="{{ $settings['color'] }}" placeholder="" required>
    </div>
    -->
    
    <div class="row">
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <div class="form-group">
            <label for="logo"> شعار النظام</label>
            <input type="file" id="logo" name="logo" class="form-control" style="display:none;" accept="image/*">
        </div>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-center">
        <label for="logo" style="margin-top:20px"><i class="fa fa-upload fa-xl text-info"></i></label>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <img src="{{ asset('images/logo/'.$settings['logo']) }}" id="imagePreview" style="width:70px;height:70px;">
      </div>
    </div>
    
    <div class="form-group">
        <label for="nf-ratio1">النسبة الاولي </label>
        <input type="number" id="nf-ratio1" name="ratio1" class="form-control" value="{{ $settings['ratio1'] }}" placeholder="" required>
    </div>
    <div class="form-group">
        <label for="nf-ratio2">النسبة الثانية </label>
        <input type="number" id="nf-ratio2" name="ratio2" class="form-control" value="{{ $settings['ratio2'] }}" placeholder="" required>
    </div>
    <div class="form-group">
        <label for="nf-ratio3">النسبة الثالثة </label>
        <input type="number" id="nf-ratio3" name="ratio3" class="form-control" value="{{ $settings['ratio3'] }}" placeholder="" required>
    </div>
    <div class="form-group">
        <label for="nf-currency">اسم او رمز العمله </label>
        <input type="text" id="nf-currency" name="currency" class="form-control" value="{{ $settings['currency'] }}" placeholder="" required>
    </div>
  </div>
</x-section_edit>
<script>
  function imageView(Input,Image){ 
     imageInput = document.getElementById(Input);
    const imagePreview = document.getElementById(Image);
    imageInput.addEventListener('change', function () {
        const file = imageInput.files[0];
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
  imageView('logo','imagePreview');
</script>
@endsection