<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-item-box">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" class="form-item" id="name" name="name" placeholder="山田太郎" required autocomplete="name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="form-item-box">
            <label for="name_kana">氏名(カナ)</label>
            <input type="text" class="form-item" id="name_kana" name="name_kana" placeholder="ヤマダタロウ" required autocomplete="name_kana">
            <x-input-error :messages="$errors->get('name_kana')" class="mt-2" />
        </div>
        <div class="form-item-box">
            <label for="email">{{ __('Email Address') }}</label>
            <input type="email" class="form-item" id="email" name="email" placeholder="sample@gmail.com" required autocomplete="email">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="form-item-box">
            <label for="phone_number">{{ __('Phone Number') }}</label>
            <input type="tel" class="form-item" id="phone_number" name="phone_number" placeholder="sample@gmail.com" required  autocomplete="phone_number">
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>
        <div class="form-item-box">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" class="form-item" id="password" name="password" placeholder="12345678" required autocomplete="password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="form-item-box">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input type="password" class="form-item" id="password_confirmation" name="password_confirmation" placeholder="12345678" required autocomplete="password_confirmation">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div align="center">
            <button type="submit" class="btn btn-primary mt-2 fw-bolder">{{ __('Register') }}</button>
        </div>
    </form>
</x-guest-layout>