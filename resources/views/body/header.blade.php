<header id="header">
    <div>
        <span class="site-title">
            <a href="{{ route('product') }}">Web カートシステム</a>
        </span>
    </div>
    <div class="header-menu">
        <div>
            <a href="/cart" class="header-link">
                <i class="bi bi-cart header-cart-icon"></i>
                <div id="header_component"></div>
            </a>
        </div>
        <div class="header-separater"> | </div>
        <div>
            <a href="{{ route('profile.edit') }}" class="header-link">マイアカウント</a>
        </div>
    </div>
</header>