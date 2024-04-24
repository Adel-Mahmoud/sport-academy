@extends('layouts.academy')
@section('section')
<x-section_add titlePage="إدارة المستخدمين" routeTo="users.store">
  <div class="card-block">
    @csrf
    <div class="form-group">
        <label for="nf-name">الإسم</label>
        <input type="text" id="nf-name" name="name" class="form-control" value="{{old('name')}}" placeholder="ادخل الإسم " required>
        @error('name')
            <span class="invalid-feedback text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="nf-email">البريد الالكتروني</label>
        <input type="email" id="nf-email" name="email" class="form-control" value="{{old('email')}}" placeholder="ادخل البريد الالكتروني" required>
        @error('email')
            <span class="invalid-feedback text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="nf-password">كلمة المرور</label>
        <input type="password" id="nf-password" name="password" class="form-control" value="{{old('password')}}" placeholder=" كلمة المرور" required>
        @error('password')
            <span class="invalid-feedback text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror              
    </div>
    <div class="form-group">
      <label for="nf-role">الصلاحيات</label>
      <select id="nf-role" name="role" class="form-control" required>
          <option value="">إختار الصلاحية</option>
          <!-- <option value="0" {{ old('role') == 0 ? 'selected' : '' }}>مستخدم</option> -->
          <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>مشرف</option>
          <option value="2" {{ old('role') == 2 ? 'selected' : '' }}>مدير</option>
      </select>
      @error('role')
          <span class="invalid-feedback text-danger" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror    
    </div>
  </div>
</x-section_add>
<x-section_table searchName="ابحث عن مستخدم..." dataName="المستخدمين" count="{{$count}}">
  <div class="card-block">
      <table class="table table-bordered table-striped table-condensed">
          <thead>
              <tr>
                  <th>رقم</th>
                  <th>اسم المستخدم</th>
                  <th> البريد الالكتروني</th>
                  <th>الصلاحية</th>
                  <th>التاريخ</th>
                  <th>حدث</th>
              </tr>
          </thead>
          <tbody>
            @if(count($users) > 0)
              @foreach ($users as $user)
                @php
                  $id = ($users->currentPage() - 1) * $users->perPage() + 1;
                @endphp
                <tr>
                    <td>{{ $id++ }}</td>
                    <td> {{ $user->name }} </td>
                    <td> {{ $user->email }} </td>
                    <td> 
                      @if($user->role == 0)
                          مستخدم
                      @elseif($user->role == 1)
                          مشرف
                      @else
                          مدير
                      @endif
                    </td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    <td>
                      <a href="{{ route('users.edit', $user->id) }}" class="btn-sm btn-success" >تعديل</a> | 
                      <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline" class="formDelete">
                          @csrf
                          @method('DELETE')
                          <button class="btn-sm btn-danger" style="border:none;outline:none;" > حذف</button>
                      </form>
                    </td>
                </tr>
              @endforeach
            @else
              <tr><td colspan="4" style="text-align: center;">لا يوجد بيانات</td></tr>
            @endif
          </tbody>
      </table>
      <div class="pagination">
          <ul class="pagination">
              @if ($users->onFirstPage())
                  <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                      <span class="page-link" aria-hidden="true">&lsaquo;</span>
                  </li>
              @else
                  <li class="page-item">
                      <a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                  </li>
              @endif
      
              @php
              $numOfPages = $users->lastPage();
              $currentPage = $users->currentPage();
              $showPages = 5; 
              $half = floor($showPages / 2);
              $startPage = max($currentPage - $half, 1);
              $endPage = min($startPage + $showPages - 1, $numOfPages);
              @endphp
      
              @for ($i = $startPage; $i <= $endPage; $i++)
                  @if ($i == $users->currentPage())
                      <li class="page-item active" aria-current="page">
                          <span class="page-link">{{ $i }}</span>
                      </li>
                  @else
                      <li class="page-item">
                          <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                      </li>
                  @endif
              @endfor
      
              @if ($users->hasMorePages())
                  <li class="page-item">
                      <a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
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
@endsection