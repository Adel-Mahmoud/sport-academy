@extends('layouts.master',['titlePage'=>$titlePage])

@section('content')
<x-page-header :titlePage="$titlePage" />
<livewire:subscriptions.subscriptions-index />
@endsection