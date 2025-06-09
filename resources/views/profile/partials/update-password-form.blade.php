<section >
    <div class="card-body p-4">

        <form method="post" action="{{ route('password.update') }}" class="mt-4">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="update_password_current_password" class="form-label fw-medium">{{ __('Current Password') }}</label>
                <div class="input-group">
                    <input type="password" class="form-control py-2" id="update_password_current_password"
                           name="current_password" autocomplete="current-password">
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('current_password', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="update_password_password" class="form-label fw-medium">{{ __('New Password') }}</label>
                <div class="input-group">
                    <input type="password" class="form-control py-2" id="update_password_password"
                           name="password" autocomplete="new-password">
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                <div class="password-strength mt-1">
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                    </div>
                    <small class="text-muted password-strength-text">Password strength</small>
                </div>
                @error('password', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="update_password_password_confirmation" class="form-label fw-medium">{{ __('Confirm Password') }}</label>
                <div class="input-group">
                    <input type="password" class="form-control py-2" id="update_password_password_confirmation"
                           name="password_confirmation" autocomplete="new-password">
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-primary px-4 py-2">
                    {{ __('Save') }}
                </button>

                @if (session('status') === 'password-updated')
                    <div x-data="{ show: true }"
                         x-show="show"
                         x-transition
                         x-init="setTimeout(() => show = false, 2000)"
                         class="text-success fw-medium">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        {{ __('Password updated.') }}
                    </div>
                @endif
            </div>
        </form>
    </div>
</section>

<style>
    .toggle-password {
        border-top-right-radius: 0.375rem !important;
        border-bottom-right-radius: 0.375rem !important;
    }
    .password-strength {
        display: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        });

        // Password strength indicator
        const passwordInput = document.getElementById('update_password_password');
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const strengthBar = this.parentElement.parentElement.querySelector('.progress-bar');
                const strengthText = this.parentElement.parentElement.querySelector('.password-strength-text');
                const strengthContainer = this.parentElement.parentElement.querySelector('.password-strength');

                strengthContainer.style.display = 'block';

                const strength = calculatePasswordStrength(this.value);
                strengthBar.style.width = strength.percentage + '%';
                strengthBar.className = 'progress-bar bg-' + strength.color;
                strengthText.textContent = strength.text;
                strengthText.className = 'text-muted password-strength-text text-' + strength.color;
            });
        }

        function calculatePasswordStrength(password) {
            let strength = 0;
            if (password.length > 0) strength++;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            const strengthMap = [
                { percentage: 20, color: 'danger', text: 'Very weak' },
                { percentage: 40, color: 'warning', text: 'Weak' },
                { percentage: 60, color: 'info', text: 'Moderate' },
                { percentage: 80, color: 'primary', text: 'Strong' },
                { percentage: 100, color: 'success', text: 'Very strong' }
            ];

            return strengthMap[Math.min(strength, strengthMap.length - 1)];
        }
    });
</script>
