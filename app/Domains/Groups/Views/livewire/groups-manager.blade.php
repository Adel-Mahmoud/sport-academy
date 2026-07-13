<div class="text-wrap">
    <div class="example">
        <div class="panel panel-primary tabs-style-2">
            <div class=" tab-menu-heading">
                <div class="tabs-menu1">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs main-nav-line">
                        <li><a href="#tab4" class="nav-link" data-toggle="tab">
                                ادارة لاعبين المجموعة
                            </a></li>
                        <li><a href="#tab5" class="nav-link active" data-toggle="tab">
                                  اضافة لاعبين جدد للمجموعة
                            </a></li>
                        <li><a href="#tab6" class="nav-link" data-toggle="tab">Tab 03</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body main-content-body-right border">
                <div class="tab-content">
                    <div class="tab-pane" id="tab4">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th>الاسم</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane active" id="tab5">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-md-nowrap table-striped">
                                        <thead>
                                            <tr>
                                                <th>الاسم</th>
                                                <th>تحديد</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($players as $player)
                                            <tr>
                                                <td>{{ $player->name }}</td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            class="custom-control-input"
                                                            id="player{{ $player->id }}"
                                                            value="{{ $player->id }}"
                                                            wire:model.live="selectedPlayers">
                                                        <label class="custom-control-label"
                                                            for="player{{ $player->id }}">
                                                        </label>
                                                    </div>
                                                </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab6">
                        <p>praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident,</p>
                        <p class="mb-0">similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>