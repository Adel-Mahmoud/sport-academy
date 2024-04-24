  <section class="container">
    <h1 class="text-primary" style="text-align: center;">
      {{$titlePage}}
    </h1>
    <br/>
    <br/>
    <div class="card">
      <div class="card-header">
          <strong>اضافة </strong> البيانات
      </div>
      <form action="{{ route($routeTo) }}" method="POST" enctype="multipart/form-data">
          {{$slot}}
        <div class="card-footer">
            <button type="submit" class="btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>حفظ البيانات</button>
            <button type="reset" class="btn-sm btn-danger"><i class="fa fa-ban"></i>تفريغ الحقول</button>
        </div>
      </form>
    </div>
  </section>
  <br />
  <br />