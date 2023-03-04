@extends('template')
@section('content')
<div class="product-container">
    <h1>Products</h1>
    <div class="item-list">
        @foreach ($item_list as $item)
        <div class="item-detail">
            <div class="item-image">
                <a href="{{ route('product.detail', $item->id) }}">
                    <img src="{{ $item->path }}" alt="{{ $item->name }}"">
                    </a>
                </div>
                <div class=" item-description">
                    <p>{{ $item->name }}</p>
                    <p class="text-muted">{!! nl2br(e($item->description)) !!}</p>
                    <br>
                    <p>¥{{ number_format($item->price) }}</p>
                    <p class="text-muted">(税込)</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection