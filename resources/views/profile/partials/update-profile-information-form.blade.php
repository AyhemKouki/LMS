<section >
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="mt-4">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label for="name" class="form-label fw-medium">{{ __('Name') }}</label>
                <input type="text" class="form-control py-2" id="name" name="name"
                       value="{{ old('name', $user->name) }}"
                       required autofocus autocomplete="name">
                @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="form-label fw-medium">{{ __('Email') }}</label>
                <input type="email" class="form-control py-2" id="email" name="email"
                       value="{{ old('email', $user->email) }}"
                       required autocomplete="username">
                @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="alert alert-warning mt-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <div>
                                <p class="mb-1">{{ __('Your email address is unverified.') }}</p>
                                <button form="send-verification"
                                        class="btn btn-link p-0 text-decoration-none">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                                @if (session('status') === 'verification-link-sent')
                                    <div class="alert alert-success mt-2 mb-0 py-2">
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-primary px-4 py-2">
                    {{ __('Save') }}
                </button>

                @if (session('status') === 'profile-updated')
                    <div x-data="{ show: true }"
                         x-show="show"
                         x-transition
                         x-init="setTimeout(() => show = false, 2000)"
                         class="text-success fw-medium">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        {{ __('Saved.') }}
                    </div>
                @endif
            </div>
        </form>

</section>
