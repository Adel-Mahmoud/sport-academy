<div>
    <div class="card">
        <div class="m-3 row g-3 align-items-center">
            <div class="col-12 col-md-4">
                <input type="text"
                       class="form-control"
                       placeholder="بحث بالاسم..."
                       wire:model.live.500ms="search">
            </div>

            <div class="col-12 col-md-8 text-md-end text-left">
                @if(count($selected) > 0)
                    <button wire:click="confirmDeleteSelected" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        حذف العناصر المحددة ({{ count($selected) }})
                    </button>
                @else
                    <a href="{{ route('admin.branches.create') }}" class="btn btn-primary mb-2 mb-md-0">
                        <i class="fas fa-plus"></i>
                        إضافة فرع جديد
                    </a>
                @endif
            </div>
        </div>

        <div class="card-header pb-0">
            <h4 class="card-title">قائمة الفروع</h4>

            @if(count($selected) > 0)
                <div class="text-muted mt-1">
                    تم تحديد {{ count($selected) }} عنصر
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
                            <th>الاسم</th>
                            <th>العنوان</th>
                            <th>رقم الهاتف</th>
                            <th>الحالة</th>
                            <th width="150">الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($branches as $branch)
                            <tr class="@if(in_array($branch->id, $selected)) table-active @endif">
                                <td>
                                    <input type="checkbox"
                                           wire:model.live="selected"
                                           value="{{ $branch->id }}"
                                           class="form-check-input">
                                </td>

                                <td>
                                    {{ $loop->iteration + ($branches->currentPage() - 1) * $branches->perPage() }}
                                </td>

                                <td>{{ $branch->name }}</td>

                                <td>{{ $branch->address }}</td>

                                <td>{{ $branch->phone }}</td>

                                <td>
                                    @if($branch->is_active)
                                        <span class="badge badge-success">نشط</span>
                                    @else
                                        <span class="badge badge-danger">غير نشط</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.branches.edit', $branch->id) }}"
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button wire:click="confirmDelete({{ $branch->id }})"
                                            class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                    <br>
                                    لا توجد بيانات حالياً
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $branches->links() }}
            </div>
        </div>
    </div>
</div>