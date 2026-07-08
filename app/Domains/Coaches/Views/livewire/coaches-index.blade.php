<div>
    <div class="card">
        <div class="m-3 row g-3 align-items-center">
            <div class="col-12 col-md-4">
                <input type="text"
                       class="form-control"
                       placeholder="بحث باسم المدرب..."
                       wire:model.live.500ms="search">
            </div>

            <div class="col-12 col-md-8 text-md-end text-left">
                @if(count($selected) > 0)
                    <button wire:click="confirmDeleteSelected" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        حذف العناصر المحددة ({{ count($selected) }})
                    </button>

                    @can('delete coach')
                    @endcan
                @else
                    <a href="{{ route('admin.coaches.create') }}" class="btn btn-primary mb-2 mb-md-0">
                        <i class="fas fa-plus"></i>
                        إضافة مدرب جديد
                    </a>

                    @can('create coach')
                    @endcan
                @endif
            </div>
        </div>

        <div class="card-header pb-0">
            <h4 class="card-title">قائمة المدربين</h4>

            @if(count($selected) > 0)
                <div class="text-muted mt-1">
                    تم تحديد {{ count($selected) }} مدرب
                </div>
            @endif
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-md-nowrap">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" wire:model.live="selectAll">
                            </th>
                            <th>#</th>
                            <th>اسم المدرب</th>
                            <th>رقم الهاتف</th>
                            <th>البريد الإلكتروني</th>
                            <th>تاريخ التعيين</th>
                            <th>الراتب</th>
                            <th>الحالة</th>
                            <th width="150">الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($coaches as $coach)
                            <tr class="@if(in_array($coach->id, $selected)) table-active @endif">

                                <td>
                                    <input type="checkbox"
                                           wire:model.live="selected"
                                           value="{{ $coach->id }}"
                                           class="form-check-input">
                                </td>

                                <td>
                                    {{ $loop->iteration + ($coaches->currentPage() - 1) * $coaches->perPage() }}
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <span>{{ $coach->name }}</span>
                                    </div>
                                </td>

                                <td>{{ $coach->phone ?? '-' }}</td>

                                <td>{{ $coach->email }}</td>

                                <td>{{ $coach->hire_date }}</td>

                                <td>{{ number_format($coach->salary, 2) }}</td>

                                <td>
                                    @if($coach->is_active)
                                        <span class="badge bg-success">نشط</span>
                                    @else
                                        <span class="badge bg-danger">غير نشط</span>
                                    @endif
                                </td>
                                
                                <td>
                                    <a href="{{ route('admin.coaches.edit', $coach->id) }}"
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    @can('edit coach')
                                    @endcan

                                    <button wire:click="confirmDelete({{ $coach->id }})"
                                            class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    @can('delete coach')
                                    @endcan
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <i class="fas fa-chalkboard-teacher fa-2x text-muted mb-2"></i>
                                    <br>
                                    لا يوجد مدربين مضافين حالياً
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $coaches->links() }}
            </div>
        </div>
    </div>
</div>