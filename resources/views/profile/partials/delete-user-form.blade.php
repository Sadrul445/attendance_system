<section class="space-y-6">
    <header>
        <h2 class="fs-4 font-medium text-dark">
            {{ __('Delete Account') }}
        </h2>

    <div name="confirm-user-deletion" :show="$errors - > userDeletion - > isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="fs-6 mt-4 font-medium text-dark">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-dark">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input id="password" name="password" type="password" class="form-control"
                    placeholder="{{ __('Password') }}" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="my-2">
                <button class="btn btn-danger ml-3">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </div>
</section>
