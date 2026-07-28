<div class="card mb-3">
    <div class="card-header bg-light">
        <strong class="text-dark">الرياضات والمجموعات التابعة</strong>
    </div>
    <div class="card-body p-2">

        <div class="accordion" id="sportsAccordion">
            @foreach($sports as $sport)
                @php
                    $hasGroups = $sport->groups->count() > 0;
                    $isExpanded = in_array($sport->id, $expandedSports);
                    $isSportChecked = in_array($sport->id, $selectedSports);
                @endphp

                <div class="border rounded mb-2 bg-white">
                    <div class="p-2 d-flex align-items-center justify-content-between bg-light">
                        
                        <!-- Checkbox اللعبة -->
                        <div class="custom-control custom-checkbox d-flex align-items-center">
                            <input type="checkbox"
                                   name="sports[]"
                                   value="{{ $sport->id }}"
                                   id="sport_{{ $sport->id }}"
                                   wire:model.live="selectedSports"
                                   class="custom-control-input me-2">
                            <label class="custom-control-label fw-bold mb-0 ms-2" for="sport_{{ $sport->id }}">
                                {{ $sport->name }}
                                @if($hasGroups)
                                    <span class="badge badge-secondary fs-xs ms-1">({{ $sport->groups->count() }} مجموعات)</span>
                                @endif
                            </label>
                        </div>

                        <!-- سهم/زر الفتح والإغلاق (يظهر فقط إذا كان للعبة مجموعات) -->
                        @if($hasGroups)
                            <button type="button" 
                                    class="btn btn-sm btn-link text-dark text-decoration-none p-0"
                                    wire:click="toggleExpand({{ $sport->id }})">
                                <i class="fas {{ $isExpanded ? 'fa-chevron-up' : 'fa-chevron-down' }}"></i>
                            </button>
                        @endif

                    </div>

                    <!-- قائمة المجموعات (تظهر عند الضغط على التبويب) -->
                    @if($hasGroups && $isExpanded)
                        <div class="p-3 border-top bg-white">
                            <div class="row">
                                @foreach($sport->groups as $group)
                                    <div class="col-md-4 mb-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                   name="groups[]"
                                                   value="{{ $group->id }}"
                                                   id="group_{{ $group->id }}"
                                                   wire:model.live="selectedGroups"
                                                   class="custom-control-input">
                                            <label class="custom-control-label text-muted" for="group_{{ $group->id }}">
                                                {{ $group->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>

        @error('sports') <span class="text-danger d-block fs-sm mt-1">{{ $message }}</span> @enderror
        @error('groups') <span class="text-danger d-block fs-sm mt-1">{{ $message }}</span> @enderror

    </div>
</div>