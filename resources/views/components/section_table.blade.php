<section class="container">
    <div class="card" style="overflow-x:scroll;">
      <div class="card-header">
          
          <form action="" method="GET" style=" float:right;display:flex;">
            <button class="btn-xs btn-primary" type="submit">بحث</button>
            <input style="width:200px;" type="text" class="form-control" name="search" placeholder="{{$searchName}}">
          </form>
          
          <div style="float:left;">
            المجموع
            [<strong>{{$count}}</strong>]
          </div>
      </div>
      <div class="card-block" style="padding-bottom:0px;">
          {{$slot}}
      </div>
  </div>
</section>