@extends('template')
@section('content')
<div class="main-container">
    <div class="cart-container d-flex justify-content-center" style="width: 500px;">
        <div style="width: 500px;">
            <div class="checkout-step-box">
                <div class="checkout-step-area">
                    <p class="checkout-step-num">01</p>
                    <p>カート</p>
                </div>
                <div class="checkout-step-separator">
                    <i class="bi bi-chevron-right"></i>
                </div>
                <div class="checkout-step-area active">
                    <p class="checkout-step-num">02</p>
                    <p>ご注文の確認</p>
                </div>
                <div class="checkout-step-separator">
                    <i class="bi bi-chevron-right"></i>
                </div>
                <div class="checkout-step-area">
                    <p class="checkout-step-num">03</p>
                    <p>ご注文完了</p>
                </div>
            </div>
            <div class="text-center mb-3 border-bottom">
                <h2 class="mb-3">ご注文完了</h2>
            </div>
            <div class="border-bottom  pl-2 pr-2 mb-3">
                <p class="mb-0 fw-bolder">ご注文ありがとうございました。</p>
                <p>ご指定のメールアドレス宛てに確認のメールをお送り致します。再度ご注文内容をこ確認ください。</p>
            </div>
            <div class="d-flex justify-content-between border-bottom pl-2 pr-2 mb-3" style="font-size: 0.9rem;">
                <div>
                    <p class="mb-0">ご注文番号</p>
                </div>
                <div>
                    <p>fafdafd</p>
                </div>
            </div>
            <div>
                <div class="checkout-item-info-box pl-2 pr-2" style="font-size: 0.9rem;">
                    <p>注文商品</p>
                    @foreach ($cart as $cart_item)
                    <div class="checkout-item-info">
                        <div class="cart-item-image">
                            <img src="{{ explode(',', $cart_item->path)[0] }}" alt="商品画像">
                        </div>
                        <div class="d-flex justify-content-between w-75">
                            <div>
                                <p class="mb-2">{{ $cart_item->name }}</p>
                                <p class="text-muted mb-2">{{ $cart_item->description }}</p>
                                <p class="text-muted mb-5">
                                    サイズ {{ $cart_item->size }} cm　数量 {{ $cart_item->amount }}
                                </p>
                            </div>
                            <div>
                                ¥ {{ number_format(($cart_item->price * $cart_item->amount) * 1.1) }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection