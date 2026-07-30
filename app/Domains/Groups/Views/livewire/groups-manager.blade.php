<div class="text-wrap">
    <div class="example">
        <div class="text-wrap">
            <div class="example">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="panel panel-primary tabs-style-2">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu1">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs main-nav-line">
                                <li><a href="#tab4" class="nav-link active" data-toggle="tab">إدارة ونقل لاعبين المجموعة</a></li>
                                <li><a href="#tab5" class="nav-link" data-toggle="tab">إضافة لاعبين جدد للمجموعة</a></li>
                                <li><a href="#tab6" class="nav-link" data-toggle="tab">مدربين المجموعة</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body tabs-menu-body main-content-body-right border">
                        <div class="tab-content">

                            <div class="tab-pane active" id="tab4">
                                <div class="card">
                                    <div class="card-body">
                                        @if ($currentPlayers->isNotEmpty())
                                        <form action="{{ route('admin.groups.transferPlayers') }}" method="POST">
                                            @method("PUT")
                                            @csrf
                                            <input type="hidden" name="from_group_id" value="{{ $groupId }}">

                                            <div class="table-responsive">
                                                <table class="table text-md-nowrap table-striped align-middle">
                                                    <thead>
                                                        <tr>
                                                            <th>الاسم</th>
                                                            <th class="text-center">
                                                                <label for="selectAllCurrent" class="mb-0 ms-1">تحديد </label>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($currentPlayers as $player)
                                                        <tr>
                                                            <td>{{ $player->name }}</td>
                                                            <td class="text-center">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox"
                                                                        class="custom-control-input current_player_check"
                                                                        id="current_player_{{ $player->id }}"
                                                                        value="{{ $player->id }}"
                                                                        name="player_ids[]">
                                                                    <label class="custom-control-label" for="current_player_{{ $player->id }}"></label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            @if ($getOtherGroupsInSameSport->isNotEmpty())
                                            <div class="d-flex align-items-center justify-content-center gap-2 mt-4">

                                                <button type="submit" class="btn btn-primary submit d-inline-flex align-items-center gap-2">
                                                    نقل اللاعبين المحددين
                                                </button>

                                                <select name="target_group_id" class="form-control w-auto" required>
                                                    <option value="" disabled selected>-- اختر المجموعة المراد النقل إليها --</option>
                                                    @foreach($getOtherGroupsInSameSport as $group)
                                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @else
                                            <div class="alert alert-warning text-center mt-3 mb-0" role="alert">
                                                لا توجد مجموعات أخرى تابعة لنفس اللعبة للنقل إليها.
                                            </div>
                                            @endif
                                        </form>
                                        @else
                                        <div class="alert alert-info text-center my-3" role="alert">
                                            لا يوجد لاعبين في هذه المجموعة حالياً.
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab5">
                                <div class="card">
                                    <div class="card-body">
                                        @if ($availablePlayers->isNotEmpty())
                                        <form action="{{ route('admin.groups.addPlayersToGroup') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="group_id" value="{{ $groupId }}">

                                            <div class="table-responsive">
                                                <table class="table text-md-nowrap table-striped align-middle">
                                                    <thead>
                                                        <tr>
                                                            <th>الاسم</th>
                                                            <th class="text-center">
                                                                <label for="selectAllAvailable" class="mb-0 ms-1">تحديد </label>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($availablePlayers as $player)
                                                        <tr>
                                                            <td>{{ $player->name }}</td>
                                                            <td class="text-center">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox"
                                                                        class="custom-control-input available_player_check"
                                                                        id="available_player_{{ $player->id }}"
                                                                        value="{{ $player->id }}"
                                                                        name="player_ids[]">
                                                                    <label class="custom-control-label" for="available_player_{{ $player->id }}"></label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="text-center mt-3">
                                                <button type="submit" class="btn btn-success submit d-inline-flex align-items-center gap-2">
                                                    إضافة اللاعبين المحددين للمجموعة
                                                </button>
                                            </div>
                                        </form>
                                        @else
                                        <div class="alert alert-info text-center my-3" role="alert">
                                            لا يوجد لاعبين متاحين للإضافة حالياً.
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab6">
                                <div class="card">
                                    <div class="card-body">
                                        @if ($coaches->isNotEmpty())
                                        <div class="table-responsive">
                                            <table class="table text-md-nowrap table-striped align-middle">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th class="text-center">
                                                            الدور
                                                        </th>
                                                        <th class="text-center">
                                                            اساسي
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($coaches as $coach)
                                                    <tr>
                                                        <td>{{ $coach->name }}</td>
                                                        <td>{{ $coach->role }}</td>
                                                        <td>{{ $coach->is_primary }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @else
                                        <div class="alert alert-info text-center my-3" role="alert">
                                            لا يوجد مدربين في هذه المجموعة حالياً.
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>