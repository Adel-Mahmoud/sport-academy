<section class="container">
    <h1 class="text-primary" style="text-align: center;">
      {{$titlePage}}
    </h1>
    <br/>
    <br/>
    <div class="card">
      <div class="card-header">
          <strong>تعديل </strong> البيانات
      </div>
      <form action="{{$routeTo}}" method="POST" enctype="multipart/form-data">
        {{$slot}}
        <div class="card-footer">
            <button type="submit" class="btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>حفظ البيانات</button>
        </div>
      </form>
    </div>
  </section>
  