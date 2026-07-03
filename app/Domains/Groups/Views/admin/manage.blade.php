@extends('layouts.master',['titlePage'=>$titlePage])
<x-page-header :sectionPage="$sectionPage" :titlePage="$titlePage" />

@section('content')
<div>
    <ul>
        @foreach($players as $player)
            <li>{{ $player->name }}</li>
        @endforeach
    </ul>
</div>
@endsection