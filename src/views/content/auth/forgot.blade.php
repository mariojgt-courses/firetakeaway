<x-firetakeaway::layout.login>
    <x-firetakeaway::auth.authconteiner title="Password Reset" >
        <x-slot name="form">
            <x-firetakeaway::form.form action="{{ route('password-reset') }}" >
                <div class="px-5 py-7">
                    <x-firetakeaway::form.email name="email" label="Email" />
                    <x-firetakeaway::form.submit name="Reset" />
                </div>
            </x-firetakeaway::form.form>
        </x-slot>

        <x-slot name="links">
            <div class="px-5 py-7">
                <div class="grid grid-cols-1 gap-3">
                    <x-firetakeaway::form.link route="{{ route('login') }}" name="Login" />
                </div>
            </div>
        </x-slot>
    </x-firetakeaway::auth.authconteiner>
</x-firetakeaway::layout.login>
