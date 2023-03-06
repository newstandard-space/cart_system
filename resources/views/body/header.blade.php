<header id="header">
    <div>
        <span class="site-title">
            <a href="{{ route('product') }}">Web カートシステム</a>
        </span>
    </div>
    <div class="header-menu">
        <div>
            <a href="/cart" class="cart-icon-link">
                <i class="bi bi-cart header-cart-icon"></i>
                <div id="header_component"></div>
            </a>
        </div>
        <div class="header-separater"> | </div>
        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
        </div>
    </div>
</header>