<main class="main">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">{{ Auth::user()->name }}</li>
      <li class="breadcrumb-item active">
          <a class="text-danger" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              تسجيل الخروج
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
      </li>
    </ol>
</main>
<h1 style="background:#09f; text-align: center;">
  صفحة اولياء الأمور
</h1>