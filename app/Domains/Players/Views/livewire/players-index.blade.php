<div>
    <div class="card">
        <div class="m-3 row g-3 align-items-center">
            <div class="col-12 col-md-4">
                <input type="text" class="form-control" placeholder="بحث باسم اللاعب..." wire:model.live.500ms="search">
            </div>
            <div class="col-12 col-md-8 text-md-end text-left">
                @if(count($selected) > 0)
                <button wire:click="confirmDeleteSelected" class="btn btn-danger">
                    <i class="fas fa-trash"></i> حذف العناصر المحددة ({{ count($selected) }})
                </button>
                     @can('delete user') 
                    @endcan
                @else
                    <a href="{{ route('admin.players.create') }}" class="btn btn-primary mb-2 mb-md-0">
                        <i class="fas fa-plus"></i> إضافة لاعب جديد
                    </a>
                    @can('create user')
                    @endcan
                @endif
            </div>
        </div>

        <div class="card-header pb-0">
            <h4 class="card-title">قائمة اللاعبين</h4>
            @if(count($selected) > 0)
                <div class="text-muted mt-1">تم تحديد {{ count($selected) }} لاعب</div>
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
                            <th>اسم اللاعب</th>
                            <th>رقم الهاتف</th>
                            <th>المدرسة</th>
                            <th>العمر</th>
                            <th>الجنس</th>
                            <th>الهوية الوطنية</th>
                            <th>تاريخ التسجيل</th>
                            <th width="150">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($players as $player)
                        <tr class="@if(in_array($player->id, $selected)) table-active @endif">
                            <td>
                                <input type="checkbox"
                                    wire:model.live="selected"
                                    value="{{ $player->id }}"
                                    class="form-check-input">
                            </td>
                            <td>{{ $loop->iteration + ($players->currentPage() - 1) * $players->perPage() }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($player->image)
                                        <img src="{{ asset('storage/' . $player->image) }}" class="rounded-circle me-2 ml-2" width="35" height="35" alt="">
                                    @else
                                        <i class="fas fa-user-circle fa-2x text-muted me-2"></i>
                                    @endif
                                    <span>{{ $player->name }}</span>
                                </div>
                            </td>
                            <td>{{ $player->phone }}</td>
                            <td>{{ $player->school ?? '-' }}</td>
                            <td>{{ $player->age }}</td>
                            <td>
                                @if($player->gender == 'male')
                                    <span class="badge bg-info">ذكر</span>
                                @else
                                    <span class="badge bg-danger">أنثى</span>
                                @endif
                            </td>
                            <td>{{ $player->national_id }}</td>
                            <td>
                                @if($player->is_active)
                                    <span class="badge bg-success">نشط</span>
                                @else
                                    <span class="badge bg-secondary">غير نشط</span>
                                @endif
                            </td>
                            <td>{{ $player->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('admin.players.edit', $player->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @can('edit user')
                                @endcan

                                <button wire:click="confirmDelete({{ $player->id }})" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @can('delete user')
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">
                                <i class="fas fa-users fa-2x text-muted mb-2"></i>
                                <br>
                                لا يوجد لاعبين مضافين حالياً
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $players->links() }}
            </div>
        </div>
    </div>
</div>
