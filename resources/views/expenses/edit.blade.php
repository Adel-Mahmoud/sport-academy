@extends('layouts.academy')
@section('section')
  <section style="margin-top:150px;" class="container">
    <h1 class="text-primary" style="text-align: center;">
      صفحة 
      تعديل 
      المصروف
    </h1>
    <br/>
    <br/>
    <div class="card">
      <div class="card-header">
          <strong>تعديل </strong> البيانات
      </div>
      <form action="{{ route('expenses.update', $expens->id) }}" method="POST">
        <div class="card-block">
          @csrf
          @method('PUT')
          <div class="form-group">
              <label for="nf-name">المصروف</label>
              <input type="number" id="nf-expens" name="expens" class="form-control" value="{{ $expens->expens }}" placeholder="ادخل القيمة المصروفة" required>
              @error('expens')
                  <span class="invalid-feedback text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
          <div class="form-group">
              <label for="nf-reason">سبب الصرف</label>
              <input type="text" id="nf-reason" name="reason" class="form-control" value="{{ $expens->reason }}" placeholder="ادخل سبب الصرف" required>
              @error('reason')
                  <span class="invalid-feedback text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
          <div class="form-group">
              <label for="nf-date">تاريخ الصرف </label>
              <input type="date" id="nf-date" name="date_at" class="form-control" value="{{ $expens->date_at }}"">
          </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>حفظ البيانات</button>
        </div>
      </form>
    </div>
  </section>
  
@endsection