@extends('layouts.master', ['titlePage' => $titlePage])
<x-page-header :sectionPage="$sectionPage" :titlePage="$titlePage" />

@section('content')
<x-form
    :action="route('admin.coaches.store')"
    submitLabel="إضافة مدرب جديد"
    cancelRoute="admin.coaches.index">
    <div class="row">

        <div class="col-12 mb-3">
            <div class="custom-control custom-checkbox bg-light p-3 rounded border">
                <input type="checkbox"
                    name="has_account"
                    id="has_account"
                    value="1"
                    class="custom-control-input"
                    {{ old('has_account') ? 'checked' : '' }}>
                <label class="custom-control-label fw-bold text-dark" for="has_account">
                    إنشاء حساب دخول للمدرب (البريد الإلكتروني وكلمة المرور)
                </label>
            </div>
            @error('has_account') <span class="text-danger d-block">{{ $message }}</span> @enderror
        </div>

        <div id="account_fields_container" class="col-12 mb-3 {{ old('has_account') ? '' : 'd-none' }}">
            <div class="p-3 border rounded bg-white">
                <x-auth.login-fields />
            </div>
        </div>

        <!-- Basic Data Header -->
        <div class="col-12 mb-3 mt-2">
            <div class="bg-primary text-white p-2 rounded">
                <strong>البيانات الأساسية</strong>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">رقم الهاتف</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">تاريخ التعيين</label>
            <input type="date" name="hire_date" class="form-control" value="{{ old('hire_date') }}">
            @error('hire_date') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">الراتب</label>
            <input type="number" step="0.01" name="salary" class="form-control" value="{{ old('salary') }}">
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
                    حالة المدرب (نشط)
                </label>
            </div>
            @error('is_active') <span class="text-danger d-block ms-2">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6 mb-3 d-flex align-items-center">
            <livewire:sports.sport-group-tree
                :oldSports="[]"
                :oldGroups="[]" />
        </div>
    </div>
</x-form>

@endsection
@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hasAccountCheckbox = document.getElementById('has_account');
        const accountContainer = document.getElementById('account_fields_container');

        function toggleAccountFields() {
            if (!hasAccountCheckbox || !accountContainer) return;

            const isChecked = hasAccountCheckbox.checked;

            // 1. إظهار/إخفاء الحاوية
            if (isChecked) {
                accountContainer.classList.remove('d-none');
            } else {
                accountContainer.classList.add('d-none');
            }

            // 2. إضافة أو إزالة required من المدخلات داخل الحاوية
            const inputs = accountContainer.querySelectorAll('input, select');
            inputs.forEach(input => {
                if (isChecked) {
                    input.setAttribute('required', 'required');
                } else {
                    input.removeAttribute('required');
                }
            });
        }

        // تشغيل الدالة فور تحميل الصفحة (لتغطية حالة وجود خطأ وإعادة old data)
        toggleAccountFields();

        // التسمع لحدث التغيير في الـ Checkbox
        hasAccountCheckbox.addEventListener('change', toggleAccountFields);
    });
</script>
@endsection