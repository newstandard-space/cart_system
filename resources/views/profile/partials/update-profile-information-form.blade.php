<div class="profile-container">
    <h4 class="mt-6">プロフィール編集</h4>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="form-item-box">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" class="form-item" id="name" name="name" placeholder="山田太郎" required autocomplete="name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="form-item-box">
            <label for="name_kana">氏名(カナ)</label>
            <input type="text" class="form-item" id="name_kana" name="name_kana" placeholder="ヤマダタロウ" required
                autocomplete="name_kana">
            <x-input-error :messages="$errors->get('name_kana')" class="mt-2" />
        </div>
        <div class="form-item-box">
            <label for="email">{{ __('Email Address') }}</label>
            <input type="email" class="form-item" id="email" name="email" placeholder="sample@gmail.com" required
                autocomplete="email">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="form-item-box">
            <label for="phone_number">{{ __('Phone Number') }}</label>
            <input type="tel" class="form-item" id="phone_number" name="phone_number" placeholder="sample@gmail.com"
                required autocomplete="phone_number">
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>
        <div align="center">
            <button type="submit" class="btn btn-primary mt-2 fw-bolder">{{ __('Update') }}</button>
        </div>
    </form>

</div>