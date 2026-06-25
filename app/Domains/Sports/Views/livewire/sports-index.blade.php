<div>
    <div class="card">
        <div class="m-3 row g-3 align-items-center">
            <div class="col-12 col-md-4">
                <input type="text" class="form-control" placeholder="بحث باسم الرياضة..." wire:model.live.500ms="search">
            </div>
            <div class="col-12 col-md-8 text-md-end text-left">
                @if(count($selected) > 0)
                @can('delete sport')
                <button wire:click="confirmDeleteSelected" class="btn btn-danger">
                    <i class="fas fa-trash"></i> حذف العناصر المحددة ({{ count($selected) }})
                </button>
                @endcan
                @else
                <a href="{{ route('admin.sports.create') }}" class="btn btn-primary mb-2 mb-md-0">
                    <i class="fas fa-plus"></i> إضافة رياضة جديدة
                </a>
                @can('create sport')
                @endcan
                @endif
            </div>
        </div>

        <div class="card-header pb-0">
            <h4 class="card-title">قائمة الرياضات</h4>
            @if(count($selected) > 0)
            <div class="text-muted mt-1">تم تحديد {{ count($selected) }} عنصر</div>
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
                            <th>اسم الرياضة</th>
                            <th>الحالة</th>
                            <th>تاريخ الإنشاء</th>
                            <th width="150">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sports as $sport)
                        <tr class="@if(in_array($sport->id, $selected)) table-active @endif">
                            <td>
                                <input type="checkbox"
                                    wire:model.live="selected"
                                    value="{{ $sport->id }}"
                                    class="form-check-input">
                            </td>
                            <td>{{ $loop->iteration + ($sports->currentPage() - 1) * $sports->perPage() }}</td>
                            <td>{{ $sport->name }}</td>
                            <td>
                                @if($sport->status == 'active')
                                <span class="badge bg-success">نشط</span>
                                @else
                                <span class="badge bg-danger">غير نشط</span>
                                @endif
                            </td>
                            <td>{{ $sport->created_at->format('Y-m-d') }}</td>
                            <td>
                                @can('edit sport')
                                @endcan
                                <a href="{{ route('admin.sports.edit', $sport->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button wire:click="confirmDelete({{ $sport->id }})"
                                class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                                </button>
                                @can('delete sport')
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-futbol fa-2x text-muted mb-2"></i>
                                <br>
                                لا يوجد رياضات مضافة
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $sports->links() }}
            </div>
        </div>
    </div>
</div>
