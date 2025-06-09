<section>
    <div class="card-body p-4">
        <header class="mb-4">
            <h2 class="h4 fw-semibold text-danger mb-2">
                <i class="bi bi-exclamation-octagon-fill me-2"></i>{{ __('Delete Account') }}
            </h2>
            <p class="text-muted">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>
        </header>

        <button class="btn btn-danger px-4 py-2" data-bs-toggle="modal" data-bs-target="#confirmUserDeletion">
            <i class="bi bi-trash3-fill me-2"></i>{{ __('Delete Account') }}
        </button>

        <!-- Modal -->
        <div class="modal fade" id="confirmUserDeletion" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-danger border-2">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title text-danger" id="confirmUserDeletionLabel">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ __('Confirm Account Deletion') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="modal-body">
                            <p class="text-muted mb-4">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                            </p>

                            <div class="mb-3">
                                <label for="password" class="form-label visually-hidden">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <input type="password" class="form-control py-2" id="password"
                                           name="password" placeholder="{{ __('Password') }}" required>
                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password', 'userDeletion')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer border-top-0">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash3-fill me-1"></i>
                                {{ __('Delete Account') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .rounded-4 {
        border-radius: 1rem !important;
    }
    .toggle-password {
        border-top-right-radius: 0.375rem !important;
        border-bottom-right-radius: 0.375rem !important;
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
    });
</script>
