@extends('template')
@section('content')
<div class="main-container">
    <h1>{{ $item->name }}</h1>
    <div class="item-detail-2">
        <div class="item-image-2">
            <img src="{{ $item->path }}" alt="{{ $item->name }}"">
        </div>
        <div class="item-description-2">
            <div class="item-description-detail-2">
                <p>{{ $item->name }}</p>
                <p>{{ number_format($item->price) }}円</p>
            </div>
        </div>
    </div>
</div>
@endsection