@extends('layouts.academy')
@section('section')
  <br/>
  <h1 class="text-primary" style="text-align: center;">
    عرض بيانات موظفين : 
    {{$job_name}}
  </h1>
  <br/>
  <br/>
  <x-section_table searchName="ابحث عن موظف..." dataName="الوظائف" count="{{$count}}">
    <div class="card-block">
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <tr>
                    <th>رقم</th>
                    <th>اسم الموظف</th>
                    <th>التاريخ</th>
                    <th>حدث</th>
                </tr>
            </thead>
            <tbody>
              @if(count($employees) > 0)
                @php $id = 1;@endphp
                @foreach ($employees as $employee)
                  <tr>
                      <td>{{ $id++ }}</td>
                      <td> {{ $employee->emp_name }} </td>
                      <td>{{ $employee->created_at->format('Y-m-d') }}</td>
                      <td>
                        <a href="{{ route('employees.edit', $employee->id) }}" class="tag tag-success" >تعديل</a> | 
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline" class="formDelete">
                            @csrf
                            @method('DELETE')
                            <button class="tag tag-danger" style="border:none;outline:none;" > حذف</button>
                        </form>
                      </td>
                  </tr>
                @endforeach
              @else
                <tr>
                      <td colspan="5" style="text-align: center;">
                        لا يوجد بيانات
                      </td>
                </tr>
              @endif
            </tbody>
        </table>
    </div>
  </x-section_table>
@endsection