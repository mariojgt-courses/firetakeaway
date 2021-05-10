<x-firetakeaway::layout.login>
    <x-firetakeaway::auth.authconteiner title="Register" >
        <x-slot name="form">
            <x-firetakeaway::form.form action="{{ route('register.user') }}" >
                <div class="px-5 py-7">
                    <x-firetakeaway::form.text name="name" label="Name" />
                    <x-firetakeaway::form.email name="email" label="Email" />
                    <x-firetakeaway::form.password name="password" label="Password" />
                    <x-firetakeaway::form.password name="password_confirmation" label="Password Confirm" />
                    <x-firetakeaway::form.submit name="Register" />
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

