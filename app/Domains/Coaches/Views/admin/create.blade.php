@extends('layouts.master', ['titlePage' => $titlePage])
<x-page-header :sectionPage="$sectionPage" :titlePage="$titlePage" />

@section('content')
<x-form
    :action="route('admin.coaches.store')"
    submitLabel="إضافة مدرب جديد"
    cancelRoute="admin.coaches.index">

    <div class="panel panel-primary tabs-style-2">
        <div class="tab-menu-heading">
            <div class="tabs-menu1">
                <!-- Tabs -->
                <ul class="nav panel-tabs main-nav-line">
                    <li>
                        <a href="#tab4" class="nav-link active" data-toggle="tab">
                            البيانات الاساسية
                        </a>
                    </li>
                    <li>
                        <a href="#tab5" class="nav-link" data-toggle="tab">
                            انشاء حساب
                        </a>
                    </li>
                    <li>
                        <a href="#tab6" class="nav-link" data-toggle="tab">
                            الرياضات والمجموعات التابعة
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel-body tabs-menu-body main-content-body-right border">
            <div class="tab-content">

                <div class="tab-pane active" id="tab4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Basic Data Header -->
                                <div class="col-12 mb-3 mt-2">
                                    <div class="bg-primary text-white p-2 rounded">
                                        <strong>البيانات الأساسية</strong>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">الاسم</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">رقم الهاتف</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">تاريخ التعيين</label>
                                    <input type="date" name="hire_date" class="form-control" value="{{ old('hire_date',now()->format('Y-m-d') ) }}">
                                    @error('hire_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">الراتب</label>
                                    <input type="number" step="0.01" name="salary" class="form-control" value="{{ old('salary') }}" required>
                                    @error('salary') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-3 d-flex align-items-center">
                                    <div class="custom-control custom-checkbox mt-4">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox"
                                            name="is_active"
                                            id="is_active"
                                            value="1"
                                            class="custom-control-input"
                                            {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                                        <label class="custom-control-label fw-bold" for="is_active">
                                            حالة المدرب
                                        </label>
                                    </div>
                                    @error('is_active') <span class="text-danger d-block ms-2">{{ $message }}</span> @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="tab5">
                    <div id="account_fields_container">
                        <div class="p-3 border rounded bg-white">
                            <x-auth.login-fields :emailRequired="false" :passwordRequired="false" />
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="tab6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <strong class="text-dark">الرياضات والمجموعات التابعة</strong>
                                </div>
                                <div class="card-body p-2">

                                    <div class="accordion" id="sportsAccordion">
                                        @foreach($sports as $sport)
                                        @php
                                        $hasGroups = $sport->groups->count() > 0;
                                        @endphp

                                        <div class="border rounded mb-2 bg-white sport-item-container" data-sport-id="{{ $sport->id }}">
                                            <div class="p-2 d-flex align-items-center justify-content-between bg-light">

                                                <div class="custom-control custom-checkbox d-flex align-items-center">
                                                    <input type="checkbox"
                                                        name="sports[]"
                                                        value="{{ $sport->id }}"
                                                        id="sport_{{ $sport->id }}"
                                                        class="custom-control-input me-2 sport-checkbox">
                                                    <label class="custom-control-label fw-bold mb-0 ms-2" for="sport_{{ $sport->id }}">
                                                        {{ $sport->name }}
                                                        @if($hasGroups)
                                                        <span class="badge badge-secondary fs-xs ms-1">({{ $sport->groups->count() }} مجموعات)</span>
                                                        @endif
                                                    </label>
                                                </div>

                                                @if($hasGroups)
                                                <button type="button"
                                                    class="btn btn-sm btn-link text-dark text-decoration-none p-0 toggle-groups-btn">
                                                    <i class="fas fa-chevron-down toggle-icon"></i>
                                                </button>
                                                @endif

                                            </div>

                                            @if($hasGroups)
                                            <div class="p-3 border-top bg-white groups-container d-none">
                                                <div class="row">
                                                    @foreach($sport->groups as $group)
                                                    <div class="col-md-4 mb-2">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio"
                                                                name="groups[{{ $sport->id }}]"
                                                                value="{{ $group->id }}"
                                                                id="group_{{ $group->id }}"
                                                                class="custom-control-input group-radio"
                                                                data-parent-sport="{{ $sport->id }}">
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
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-form>

@endsection
@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {

        document.querySelectorAll('.toggle-groups-btn').forEach(button => {
            button.addEventListener('click', function() {
                const container = this.closest('.sport-item-container');
                const groupsDiv = container.querySelector('.groups-container');
                const icon = this.querySelector('.toggle-icon');

                if (groupsDiv) {
                    groupsDiv.classList.toggle('d-none');

                    if (groupsDiv.classList.contains('d-none')) {
                        icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
                    } else {
                        icon.classList.replace('fa-chevron-down', 'fa-chevron-up');
                    }
                }
            });
        });

        document.querySelectorAll('.sport-checkbox').forEach(sportCheckbox => {
            sportCheckbox.addEventListener('change', function() {
                const container = this.closest('.sport-item-container');
                const groupRadios = container.querySelectorAll('.group-radio');
                const groupsDiv = container.querySelector('.groups-container');

                if (this.checked) {
                    const anyChecked = container.querySelector('.group-radio:checked');
                    if (!anyChecked && groupRadios.length > 0) {
                        groupRadios[0].checked = true;
                    }

                    if (groupsDiv && groupsDiv.classList.contains('d-none')) {
                        container.querySelector('.toggle-groups-btn').click();
                    }
                } else {
                    groupRadios.forEach(radio => {
                        radio.checked = false;
                    });
                }
            });
        });

        document.querySelectorAll('.group-radio').forEach(groupRadio => {
            groupRadio.addEventListener('change', function() {
                if (this.checked) {
                    const container = this.closest('.sport-item-container');
                    const sportCheckbox = container.querySelector('.sport-checkbox');

                    if (!sportCheckbox.checked) {
                        sportCheckbox.checked = true;
                    }
                }
            });
        });
    });
</script>
<script>
    const requiredFields = {
        name: '',
        phone: '',
        salary: '',
    };

    document.querySelector('[name="name"]').addEventListener('input', e => {
        requiredFields.name = e.target.value.trim();
    });

    document.querySelector('[name="phone"]').addEventListener('input', e => {
        requiredFields.phone = e.target.value.trim();
    });

    document.querySelector('[name="salary"]').addEventListener('input', e => {
        requiredFields.salary = e.target.value.trim();
    });
    document.querySelector('.submit').addEventListener('click', function(e) {

        if (!requiredFields.name || !requiredFields.phone || !requiredFields.salary) {
            const tabId = 'tab4';
            document.querySelector(`a[href="#${tabId}"]`).click();
            return;
        }
    });
</script>
@endsection