@extends('layouts.master',['titlePage'=>$titlePage])

@section('content')
<x-page-header :titlePage="$titlePage" />
<livewire:players.players-index />
@endsection
