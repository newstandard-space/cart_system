<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-item-box">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" class="form-item" id="name" name="name" placeholder="例：山田太郎" required
                autocomplete="name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="form-item-box">
            <label for="name_kana">氏名(カナ)</label>
            <input type="text" class="form-item" id="name_kana" name="name_kana" placeholder="例：ヤマダタロウ" required
                autocomplete="name_kana">
            <x-input-error :messages="$errors->get('name_kana')" class="mt-2" />
        </div>
        <div class="form-item-box">
            <label for="phone_number">{{ __('Phone Number') }}</label>
            <input type="tel" class="form-item" id="phone_number" name="phone_number" placeholder="例：0312345678"
                required autocomplete="phone_number">
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>
        <div class="form-item-box">
            <label for="postal_code">郵便番号</label>
            <input type="tel" class="form-item" id="postal_code" name="postal_code" placeholder="ハイフンなし" required
                autocomplete="postal_code">
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>
        <div class="form-item-box">
            <label for="address_1">住所</label>
            <input type="tel" class="form-item" id="address_1" name="address_1" placeholder="例：東京都港区六本木" required
                autocomplete="address_1">
            <x-input-error :messages="$errors->get('address_1')" class="mt-2" />
            <input type="tel" class="form-item" id="address_2" name="address_2"
                placeholder="番地以降（例：⚪︎-⚪︎-⚪︎、⚪︎番地△△ビル⚪︎⚪︎号）" required autocomplete="address_2">
            <x-input-error :messages="$errors->get('address_2')" class="mt-2" />
        </div>
        <div class="form-item-box">
            <label for="email">{{ __('Email Address') }}</label>
            <input type="email" class="form-item" id="email" name="email" placeholder="例：○○○@gmail.com" required
                autocomplete="email">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <input type="email" class="form-item" id="email_confirmation" name="email_confirmation"
                placeholder="上記メールアドレス再入力" required autocomplete="email_confirmation">
            <x-input-error :messages="$errors->get('email_confirmation')" class="mt-2" />
        </div>
        <div class="form-item-box">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" class="form-item" id="password" name="password" placeholder="12345678" required
                autocomplete="password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input type="password" class="form-item" id="password_confirmation" name="password_confirmation"
                placeholder="上記パスワード再入力" required autocomplete="password_confirmation">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div align="center">
            <button type="submit" class="btn btn-primary mt-2 fw-bolder">{{ __('Register') }}</button>
        </div>
    </form>
</x-guest-layout>