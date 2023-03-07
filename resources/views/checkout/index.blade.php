@extends('template')
@section('content')
<div class="main-container">
    <div class="cart-container">
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
        <h3 class="mb-0">ご注文の確認</h3>
        <div class="checkout-area">
            <form id="checkout-button" method="POST" action="{{ route('checkout.create') }}">
                @csrf
                <div style="width: 600px; font-size: 14px;" class="mb-8">
                    <div class="checkout-info-area">
                        <div class="checkout-info-title">
                            注文者情報
                        </div>
                        <div>
                            <p class="fw-bolder mb-0">{{ $user->name }}</p>
                            <div style="font-size: 0.8rem;">
                                <p class="mb-0">〒 {{ $user_address->postal_code }}</p>
                                <p class="mb-0">{{ $user_address->address_1 . $user_address->address_2 }}</p>
                                <p class="mb-0">{{ $user->phone_number }}</p>
                                <p class="mb-0">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="checkout-info-area">
                        <div class="checkout-info-title">
                            配送先情報
                        </div>
                        <div class="">
                            <div class="mb-3">
                                <input type="radio" checked name="shipping_address_type" value="1" class="mr-2"><span
                                    class="fw-bolder">注文者情報で受け取る</span>
                            </div>
                            <div>
                                <input type="radio" name="shipping_address_type" value="2" class="mr-2">別の住所で受け取る
                            </div>
                        </div>
                    </div>
                    <div class="checkout-info-area">
                        <div class="checkout-info-title">
                            お届け日時
                        </div>
                        <div class="d-flex justify-content-between" style="width: 80%;">
                            <div>
                                <p class="fw-bolder mb-1">指定なし</p>
                                <input type="hidden" name="delivery_date" value="2023-03-10">
                                <p class="text-muted">最短で3/10<span class="order-delivery-day"> 木 </span>にお届け</p>
                            </div>
                            <div>
                                <span class="text-primary cursor-pointer">変更</span>
                            </div>
                        </div>
                    </div>
                    <div class="checkout-info-area">
                        <div class="checkout-info-title">
                            決済方法
                        </div>
                        <div class="">
                            <div class="mb-3">
                                <input type="radio" checked name="payment_method_type" value="1" class="mr-2"><span
                                    class="fw-bolder">代金引換</span>
                            </div>
                            <div>
                                <input type="radio" name="payment_method_type" value="2" class="mr-2">GMO後払い
                            </div>
                        </div>
                    </div>
            </form>

            <div class="checkout-info-area">
                <div class="checkout-item-info-box">
                    <p>注文商品</p>
                    @foreach ($cart as $cart_item)
                    <div class="checkout-item-info">
                        <div class="cart-item-image">
                            <img src="{{ explode(',', $cart_item->path)[0] }}" alt="商品画像">
                        </div>
                        <div class="d-flex justify-content-between w-75">
                            <div>
                                <p class="fw-bolder mb-2">{{ $cart_item->name }}</p>
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
        <div style="width:300px;" class="ml-6 mt-3">
            <h5>サマリー</h5>
            <div class="cart-box-info-item">
                <div>
                    <div>小計</div>
                    <div>¥ {{ number_format($subtotal) }}</div>
                </div>
                <div class="mt-1 mb-3">
                    <div>配送手数料</div>
                    <div>配送無料</div>
                </div>
                <div class="cart-box-info-item-3 pt-3 pb-3">
                    <div>合計（税込）</div>
                    <div style="color: #fa5400;">¥ {{ number_format($subtotal) }}</div>
                </div>
                <div class="cart-box-info-item-4 mt-4">
                    <a href="/checkout">
                        <button form="checkout-button">ご注文を確定する</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection