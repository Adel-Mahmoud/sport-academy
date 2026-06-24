@extends('layouts.master')
<x-page-header titlePage="الرئيسية" />

@section('css')
<link href="{{URL::asset('assets/plugins/morris.js/morris.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/custom/css/dashboard.css')}}" rel="stylesheet">
@endsection

@section('content')
@can('view dashboard')
<div class="container my-5" dir="rtl">
    <div class="row">
        <!-- 1. الاشتراكات المنتهية -->
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h2 class="font-weight-bold mb-1">5</h2>
                        <span class="text-muted small">الاشتراكات المنتهية</span>
                    </div>
                    <div class="bg-danger-subtle text-danger p-3 rounded-3">
                        <i class="fas fa-user-times fa-3x"></i>
                    </div>
                </div>
                <div class="mt-auto pt-2 border-top">
                    <span class="text-secondary small font-weight-bold">
                        <i class="fas fa-exclamation-triangle mr-1"></i> بحاجة إلى تجديد
                    </span>
                </div>
            </div>
        </div>

        <!-- 2. الاشتراكات النشطة -->
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h2 class="font-weight-bold mb-1">45</h2>
                        <span class="text-muted small">الاشتراكات النشطة</span>
                    </div>
                    <div class="bg-success-subtle text-success p-3 rounded-3">
                        <i class="fas fa-user-check fa-3x"></i>
                    </div>
                </div>
                <div class="mt-auto pt-2 border-top">
                    <span class="text-secondary small font-weight-bold">
                        <i class="fas fa-arrow-up mr-1"></i> +12% من الشهر الماضي
                    </span>
                </div>
            </div>
        </div>

        <!-- 3. إجمالي اللاعبين -->
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h2 class="font-weight-bold mb-1">120</h2>
                        <span class="text-muted small">إجمالي اللاعبين</span>
                    </div>
                    <div class="bg-primary-subtle text-primary p-3 rounded-3">
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                </div>
                <div class="mt-auto pt-2 border-top">
                    <span class="text-secondary small font-weight-bold">
                        <i class="fas fa-arrow-up mr-1"></i> +8 لاعبين جدد
                    </span>
                </div>
            </div>
        </div>

        <!-- 4. مصروفات الشهر -->
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h2 class="font-weight-bold mb-1">450$</h2>
                        <span class="text-muted small">مصروفات الشهر</span>
                    </div>
                    <div class="bg-warning-subtle text-warning p-3 rounded-3">
                        <i class="fas fa-money-bill-wave fa-3x"></i>
                    </div>
                </div>
                <div class="mt-auto pt-2 border-top">
                    <span class="text-secondary small font-weight-bold">
                        <i class="fas fa-chart-line mr-1"></i> فواتير وصيانة
                    </span>
                </div>
            </div>
        </div>

        <!-- 5. إيرادات الشهر -->
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h2 class="font-weight-bold mb-1">1,500$</h2>
                        <span class="text-muted small">إيرادات الشهر</span>
                    </div>
                    <div class="bg-info-subtle text-info p-3 rounded-3">
                        <i class="fas fa-wallet fa-3x"></i>
                    </div>
                </div>
                <div class="mt-auto pt-2 border-top">
                    <span class="text-secondary small font-weight-bold">
                        <i class="fas fa-arrow-up mr-1"></i> +5% من الشهر الماضي
                    </span>
                </div>
            </div>
        </div>

        <!-- 6. غياب اليوم -->
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h2 class="font-weight-bold mb-1">14</h2>
                        <span class="text-muted small">غياب اليوم</span>
                    </div>
                    <div class="bg-secondary-subtle text-secondary p-3 rounded-3">
                        <i class="fas fa-user-slash fa-3x"></i>
                    </div>
                </div>
                <div class="mt-auto pt-2 border-top">
                    <span class="text-secondary small font-weight-bold">
                        <i class="fas fa-clock mr-1"></i> تم التحديث اليوم
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-5 col-lg-4 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="font-weight-bold mb-0 text-dark">الأكثر غياباً</h4>
                    <span class="badge badge-danger-subtle text-danger px-2 py-1 small rounded">هذا الشهر</span>
                </div>

                <div class="absent-list">
                    
                    <div class="d-flex align-items-center p-2 mb-2 border-bottom last-border-0">
                        <img src="http://127.0.0.1:8000/assets/img/faces/6.jpg" class="rounded-circle ml-3" alt="صورة المستخدم" width="45" height="45">
                        <div>
                            <h6 class="font-weight-bold mb-0 text-secondary">أحمد محمد علي</h6>
                            <span class="text-danger small font-weight-normal">
                                <i class="fas fa-calendar-times mr-1"></i> غياب: <strong>7 أيام</strong>
                            </span>
                        </div>
                    </div>

                    <!-- الشخص الثاني -->
                    <div class="d-flex align-items-center p-2 mb-2 border-bottom last-border-0">
                        <img src="http://127.0.0.1:8000/assets/img/faces/6.jpg" class="rounded-circle ml-3" alt="صورة المستخدم" width="45" height="45">
                        <div>
                            <h6 class="font-weight-bold mb-0 text-secondary">سارة أحمد حسن</h6>
                            <span class="text-danger small font-weight-normal">
                                <i class="fas fa-calendar-times mr-1"></i> غياب: <strong>5 أيام</strong>
                            </span>
                        </div>
                    </div>

                    <!-- الشخص الثالث -->
                    <div class="d-flex align-items-center p-2 mb-2 border-bottom last-border-0">
                        <img src="http://127.0.0.1:8000/assets/img/faces/6.jpg" class="rounded-circle ml-3" alt="صورة المستخدم" width="45" height="45">
                        <div>
                            <h6 class="font-weight-bold mb-0 text-secondary">خالد محمود عبد الله</h6>
                            <span class="text-danger small font-weight-normal">
                                <i class="fas fa-calendar-times mr-1"></i> غياب: <strong>4 أيام</strong>
                            </span>
                        </div>
                    </div>

                </div>

                <!-- أسفل البطاقة -->
                <div class="mt-auto pt-2 text-left">
                    <a href="#" class="btn btn-sm btn-block border btn-link text-primary font-weight-bold p-2">
                        عرض جميع الغياب 
                        <i class="fas fa-arrow-left mr-1"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="col-12 col-md-7 col-lg-8 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="mb-3">
                    <div>
                        <h4 class="font-weight-bold mb-0 text-dark">
                            الايرادات و المصروفات (هذا الشهر)
                        </h4>
                    </div>
                    <div class="p-3">
                        <div class="card mg-b-md-20 overflow-hidden">
                            <div class="chartjs-wrapper-demo">
                                <canvas id="chartLine1"></canvas>
                            </div>
                        </div>    
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 col-lg-6 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="mb-3">
                    <div>
                        <h4 class="font-weight-bold mb-0 text-dark">
                            توزيع اللاعبين حسب الرياضة
                        </h4>
                    </div>
                    <div class="p-3">
                        <div class="card mg-b-md-20 overflow-hidden">
                            <div class="card-body">
                                <div class="chartjs-wrapper-demo">
                                    <canvas id="chartPie"></canvas>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-6 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="font-weight-bold mb-0 text-dark">
                        الاشتراكات التي تنتهي قريبا
                    </h4>
                </div>

                <div class="absent-list">
                    
                <!-- الصندوق الحاوي: يوزع العناصر أقصى اليمين وأقصى اليسار ويحاذيها عمودياً في المنتصف -->
                    <div class="d-flex justify-content-between align-items-center p-2 mb-2 border-bottom last-border-0">
                        
                        <!-- القسم الأيمن: الصورة والبيانات بجانب بعضهما -->
                        <div class="d-flex align-items-center">
                            <!-- الصورة أقصى اليمين مع مسافة يسارها -->
                            <img src="http://127.0.0.1:8000/assets/img/faces/6.jpg" class="rounded-circle ml-3" alt="صورة المستخدم" width="45" height="45">
                            <div>
                                <h6 class="font-weight-bold mb-0 text-secondary">أحمد محمد علي</h6>
                                <span class="text-danger small font-weight-normal">
                                    <i class="fas fa-user-times mr-1"></i> باقي: <strong>7 أيام</strong>
                                </span>
                            </div>
                        </div>
                        
                        <!-- القسم الأيسر: البادج أو مربع الأيام أقصى اليسار -->
                        <div class="bg-warning-subtle text-warning px-3 py-2 rounded font-weight-bold small">
                            3 أيام
                        </div>

                    </div>

                </div>

                <!-- أسفل البطاقة -->
                <div class="mt-auto pt-2 text-left">
                    <a href="#" class="btn btn-sm btn-block border btn-link text-primary font-weight-bold p-2">
                        عرض جميع الاشتراكات 
                        <i class="fas fa-arrow-left mr-1"></i>
                    </a>
                </div>
            </div>

        </div>

    </div>
    
    <div class="row">
        <div class="card">
        <div class="card h-100 border-0 shadow-sm p-3">
    <!-- عنوان قسم الأنشطة -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="font-weight-bold mb-0 text-dark">آخر الأنشطة</h4>
        <i class="fas fa-history text-muted"></i>
    </div>

    <!-- قائمة الأنشطة -->
    <div class="activity-timeline">

        <!-- النشاط 1: اشتراك جديد -->
        <div class="d-flex justify-content-between align-items-start p-2 mb-3 border-bottom last-border-0">
            <!-- القسم الأيمن: الأيقونة مع النصوص -->
            <div class="d-flex align-items-start">
                <!-- أيقونة النشاط بخلفية خفيفة دائرية -->
                <div class="bg-success-subtle text-success p-2 rounded-circle ml-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="fas fa-user-plus small"></i>
                </div>
                <div>
                    <h6 class="font-weight-bold mb-1 text-dark">تسجيل لاعب جديد</h6>
                    <p class="text-muted small mb-0">تم تسجيل الكابتن محمد علي في باقة الاشتراكات الذهبية.</p>
                </div>
            </div>
            <!-- القسم الأيسر: المدة الزمنية -->
            <div class="text-left">
                <span class="text-secondary small font-weight-normal text-nowrap">منذ 10 دقائق</span>
            </div>
        </div>

        <!-- النشاط 2: تجديد اشتراك -->
        <div class="d-flex justify-content-between align-items-start p-2 mb-3 border-bottom last-border-0">
            <div class="d-flex align-items-start">
                <div class="bg-primary-subtle text-primary p-2 rounded-circle ml-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="fas fa-sync-alt small"></i>
                </div>
                <div>
                    <h6 class="font-weight-bold mb-1 text-dark">تجديد اشتراك شهري</h6>
                    <p class="text-muted small mb-0">قام اللاعب أحمد حسين بتجديد اشتراك صالة الحديد والياقة.</p>
                </div>
            </div>
            <div class="text-left">
                <span class="text-secondary small font-weight-normal text-nowrap">منذ ساعتين</span>
            </div>
        </div>

        <!-- النشاط 3: تسجيل غياب أو إنذار -->
        <div class="d-flex justify-content-between align-items-start p-2 mb-3 border-bottom last-border-0">
            <div class="d-flex align-items-start">
                <div class="bg-danger-subtle text-danger p-2 rounded-circle ml-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="fas fa-exclamation-triangle small"></i>
                </div>
                <div>
                    <h6 class="font-weight-bold mb-1 text-dark">تجاوز حد الغياب</h6>
                    <p class="text-muted small mb-0">تنبيه: اللاعب عمر خالد تخطى 5 أيام غياب متتالية.</p>
                </div>
            </div>
            <div class="text-left">
                <span class="text-secondary small font-weight-normal text-nowrap">منذ 3 أيام</span>
            </div>
        </div>

        <!-- النشاط 4: عملية دفع مصروفات -->
        <div class="d-flex justify-content-between align-items-start p-2 mb-3 border-bottom last-border-0">
            <div class="d-flex align-items-start">
                <div class="bg-warning-subtle text-warning p-2 rounded-circle ml-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="fas fa-receipt small"></i>
                </div>
                <div>
                    <h6 class="font-weight-bold mb-1 text-dark">تسجيل مصروفات جديدة</h6>
                    <p class="text-muted small mb-0">تم دفع فاتورة صيانة المعدات الرياضية الدورية.</p>
                </div>
            </div>
            <div class="text-left">
                <span class="text-secondary small font-weight-normal text-nowrap">منذ أسبوع</span>
            </div>
        </div>

    </div>
</div>

        </div>
    </div>
</div>
@else
<div class="card">
    <div class="card-body">
        <img src="{{ config('settings.brand_image') ? asset('storage/' . config('settings.brand_image')) : URL::asset('assets/img/media/login.png') }}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="شعار الدخول">
    </div>
</div>
@endcan
@endsection

@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal Chartjs js -->
<script>
    /* LINE CHART */
	var ctx8 = document.getElementById('chartLine1');
	new Chart(ctx8, {
		type: 'line',
		data: {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			datasets: [{
				data: [12, 15, 18, 40, 35, 38, 32, 20, 25, 15, 25, 30],
				borderColor: '#f7557a ',
				borderWidth: 1,
				fill: false
			}, {
				data: [10, 20, 25, 55, 50, 45, 35, 30, 45, 35, 55, 40],
				borderColor: '#007bff',
				borderWidth: 1,
				fill: false
			}]
		},
		options: {
			maintainAspectRatio: false,
			legend: {
				display: false,
				labels: {
					display: false
				}
			},
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
						fontSize: 10,
						max: 80,
						fontColor: "rgb(171, 167, 167,0.9)",
					},
					gridLines: {
						display: true,
						color: 'rgba(171, 167, 167,0.2)',
						drawBorder: false
					},
				}],
				xAxes: [{
					ticks: {
						beginAtZero: true,
						fontSize: 11,
						fontColor: "rgb(171, 167, 167,0.9)",
					},
					gridLines: {
						display: true,
						color: 'rgba(171, 167, 167,0.2)',
						drawBorder: false
					},
				}]
			}
		}
	});
    /** PIE CHART **/
	var datapie = {
		labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
		datasets: [{
			data: [20, 20, 30, 5, 25],
			backgroundColor: ['#285cf7', '#f10075', '#8500ff', '#7987a1', '#74de00']
		}]
	};
	var optionpie = {
		maintainAspectRatio: false,
		responsive: true,
		legend: {
			display: false,
		},
		animation: {
			animateScale: true,
			animateRotate: true
		}
	};
    // For a doughnut chart
	var ctx6 = document.getElementById('chartPie');
	var myPieChart6 = new Chart(ctx6, {
		type: 'doughnut',
		data: datapie,
		options: optionpie
	});
</script>
@endsection