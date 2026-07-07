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
                    <a href="{{ route('admin.subscriptions.create') }}" class="btn btn-primary mb-2 mb-md-0">
                        <i class="fas fa-plus"></i>
                        إضافة Subscription جديد
                    </a>
                @endif
            </div>
        </div>

        <div class="card-header pb-0">
            <h4 class="card-title">قائمة Subscriptions</h4>

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
                            <th width="150">الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($subscriptions as $subscription)
                            <tr class="@if(in_array($subscription->id, $selected)) table-active @endif">
                                <td>
                                    <input type="checkbox"
                                           wire:model.live="selected"
                                           value="{{ $subscription->id }}"
                                           class="form-check-input">
                                </td>

                                <td>
                                    {{ $loop->iteration + ($subscriptions->currentPage() - 1) * $subscriptions->perPage() }}
                                </td>

                                <td>{{ $subscription->name }}</td>

                                <td>
                                    <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}"
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button wire:click="confirmDelete({{ $subscription->id }})"
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
                {{ $subscriptions->links() }}
            </div>
        </div>
    </div>
</div>