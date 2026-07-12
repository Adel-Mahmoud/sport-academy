@extends('layouts.master',['titlePage'=>$titlePage])
<x-page-header :sectionPage="$sectionPage" :titlePage="$titlePage" />

@section('content')
<div>
    <div class="col-xl-12">
        <!-- div -->
        <div class="card mg-b-20" id="tabs-style2">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    إدارة اللاعبين والمدربين
                </div>
                <p class="mg-b-20">يمكن اضافة و ازالة و نقل لاعبين و مدربين </p>
                <livewire:groups.group-manager />
            </div>
        </div>
    </div>
</div>
@endsection

