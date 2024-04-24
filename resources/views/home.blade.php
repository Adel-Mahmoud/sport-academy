@extends('layouts.academy')

@section('section')

  <h1 class="text-primary" style="text-align: center;">
    {{ $settings['title'] }}  
  </h1>
  <div class="container-fluid">
      @if(Auth::user()->role == 2)
      <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" style="aspect-ratio:16/9 !important;">
            <a href="{{url('users')}}">
              <div class="card card-inverse card-primary">
                  <div class="card-block p-b-0">
                      <h4 class="m-b-0">{{$usersCount}}</h4>
                      <i class="fa fa-users fa-xl" style="float:left;"></i>
                      <p>المستخدمين</p>
                  </div>
                  <div class="chart-wrapper p-x-1" style="height:70px;">
                      <canvas id="card-chart1" class="chart" height="70"></canvas>
                  </div>
              </div>
            </a>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" style="aspect-ratio:16/9 !important;">
            <a href="{{url('players')}}">
              <div class="card card-inverse card-info">
                  <div class="card-block p-b-0">
                      <h4 class="m-b-0">{{$playerCount}}</h4>
                      <i class="fa fa-running fa-xl" style="float:left;"></i>
                      <p> اللاعبين</p>
                  </div>
                  <div class="chart-wrapper p-x-1" style="height:70px;">
                      <canvas id="card-chart2" class="chart" height="70"></canvas>
                  </div>
              </div>
            </a>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4" style="aspect-ratio:16/9 !important;">
            <a href="{{url('coaches')}}">
              <div class="card card-inverse card-warning">
                  <div class="card-block p-b-0">
                      <h4 class="m-b-0">{{$coachesCount}}</h4>
                      <i class="fa fa-chalkboard-teacher fa-xl" style="float:left;"></i>
                      <p> المدربين</p>
                  </div>
                  <div class="chart-wrapper" style="height:70px;">
                      <canvas id="card-chart3" class="chart" height="70"></canvas>
                  </div>
              </div>
            </a>
          </div>
      </div>
      @else
      <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="aspect-ratio:16/9 !important;">
            <a href="{{url('players')}}">
              <div class="card card-inverse card-info">
                  <div class="card-block p-b-0">
                      <h4 class="m-b-0">{{$playerCount}}</h4>
                      <i class="fa fa-running fa-xl" style="float:left;"></i>
                      <p> اللاعبين</p>
                  </div>
                  <div class="chart-wrapper p-x-1" style="height:70px;">
                      <canvas id="card-chart2" class="chart" height="70"></canvas>
                  </div>
              </div>
            </a>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="aspect-ratio:16/9 !important;">
            <a href="{{url('coaches')}}">
              <div class="card card-inverse card-warning">
                  <div class="card-block p-b-0">
                      <h4 class="m-b-0">{{$coachesCount}}</h4>
                      <i class="fa fa-chalkboard-teacher fa-xl" style="float:left;"></i>
                      <p> المدربين</p>
                  </div>
                  <div class="chart-wrapper" style="height:70px;">
                      <canvas id="card-chart3" class="chart" height="70"></canvas>
                  </div>
              </div>
            </a>
          </div>
      </div>
      @endif
    <!--
    <div class="row">
      <div class="col-6 col-sm-6 col-md-6 col-lg-3" style="aspect-ratio:16/9 !important;">
        <a href="{{url('users')}}">
          <div class="card card-inverse card-primary">
              <div class="card-block p-b-0">
                  <h4 class="m-b-0">{{$usersCount}}</h4>
                  <p>المستخدمين</p>
              </div>
              <div class="chart-wrapper p-x-1" style="height:70px;">
                  <canvas id="card-chart1" class="chart" height="70"></canvas>
              </div>
          </div>
        </a>
      </div>

      <div class="col-6 col-sm-6 col-md-6 col-lg-3" style="aspect-ratio:16/9 !important;">
        <a href="{{url('players')}}">
          <div class="card card-inverse card-info">
              <div class="card-block p-b-0">
                  <h4 class="m-b-0">{{$playerCount}}</h4>
                  <p> اللاعبين</p>
              </div>
              <div class="chart-wrapper p-x-1" style="height:70px;">
                  <canvas id="card-chart2" class="chart" height="70"></canvas>
              </div>
          </div>
        </a>
      </div>

      <div class="col-6 col-sm-6 col-md-6 col-lg-3" style="aspect-ratio:16/9 !important;">
        <a href="{{url('coaches')}}">
          <div class="card card-inverse card-warning">
              <br>
              <div class="card-block p-b-0">
                  <h4 class="m-b-0">{{$coachesCount}}</h4>
                  <p> المدربين</p>
              </div>
              <div class="chart-wrapper" style="height:70px;">
                  <canvas id="card-chart3" class="chart" height="70"></canvas>
              </div>
          </div>
        </a>
      </div>

      <div class="col-6 col-sm-6 col-md-6 col-lg-3" style="aspect-ratio:16/9 !important;">
          <div class="card card-inverse card-danger">
              <div class="card-block p-b-0">
                  <br>
                  <p> التقارير</p>
                  <br>
              </div>
              <div class="chart-wrapper p-x-1" style="height:70px;">
                  <canvas id="card-chart4" class="chart" height="70"></canvas>
              </div>
          </div>
      </div>

  </div>
    -->
    <br/>
    <br/>
    <section>
    <div class="card" style="overflow-x:scroll;">
      <div class="card-header">
          <i class="fa fa-align-justify"></i> 
          إجمالي إشتراكات الشهر الحالي
      </div>
      <div class="card-block">
          <table class="table table-bordered table-striped table-condensed">
              <thead>
                  <tr>
                      <th>م</th>
                      <th>اللعبة</th>
                      <th>الإجمالي</th>
                      <th>نسبة {{$settings['ratio1']}}%</th>
                      <th>نسبة {{$settings['ratio2']}}%</th>
                      <th>نسبة {{$settings['ratio3']}}%</th>
                  </tr>
              </thead>
              <tbody>
                @php
                     $id = 1;
                     $sum1 = 0;
                     $sum2 = 0;
                     $sum3 = 0;
                     $sum4 = 0;
                     foreach ($sports as $sport) {
                          
                          $totalSubscriptions = $sport->players->flatMap(function ($player) {
                              return $player->subscriptions;
                          })->sum('subscribe');
                          $sum2 += ($totalSubscriptions * $settings['ratio1']) / 100;
                          $sum3 += ($totalSubscriptions * $settings['ratio2']) / 100;
                          $sum4 += ($totalSubscriptions * $settings['ratio3']) / 100;
                    echo '<tr>
                            <td> ' . $id++ .' </td>
                            <td>' . $sport->sport_name . '</td>
                            <td>' . $totalSubscriptions . '</td>
                            <td>' . ($totalSubscriptions * $settings['ratio1']) / 100 . '</td>
                            <td>' . ($totalSubscriptions * $settings['ratio2']) / 100 . '</td>
                            <td>' . ($totalSubscriptions * $settings['ratio3']) / 100 . '</td>
                        </tr>';
                      }
                @endphp
                  <tr>
                      <td colspan="2"><strong class="text-info">الإجمالي</strong></td>
                      <td><strong class="text-info">{{$subscribe}}</strong></td>
                      <td><strong class="text-info">{{$sum2}}</strong></td>
                      <td><strong class="text-info">{{$sum3}}</strong></td>
                      <td><strong class="text-info">{{$sum4}}</strong></td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-primary">
                      مصاريف
                    </td>
                    <td colspan="4" class="text-primary">
                      [ {{$totalExpens}} ] 
                       تخصم المصاريف من كل الاشتراكات 
                    </td>
                  </tr>
                  <!--
                  <tr>
                      <td colspan="2"><strong class="text-info">الرواتب الشهرية </strong></td>
                      <td><strong class="text-info">{{$ratio}}</strong></td>
                      <td><strong class="text-info">{{$ratio1}}</strong></td>
                      <td><strong class="text-info">{{$ratio2}}</strong></td>
                      <td><strong class="text-info">{{$ratio3}}</strong></td>
                  </tr>
                  -->
                  <tr>
                      <td colspan="2"><strong class="text-info">صافي الأشتراكات</strong></td>
                      <td><strong class="text-info">{{$totalSub = $subscribe - $totalExpens}}</strong></td>
                      <td><strong class="text-info">{{ ( ($totalSub * $settings['ratio1']) / 100 ) }}</strong></td>
                      <td><strong class="text-info">{{ ( ($totalSub * $settings['ratio2']) / 100 ) }}</strong></td>
                      <td><strong class="text-info">{{ ( ($totalSub * $settings['ratio3']) / 100 ) }}</strong></td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
  </section>
    
  </div>
  <!--/.container-fluid-->

@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
