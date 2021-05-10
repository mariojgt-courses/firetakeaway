<x-firetakeaway::layout.login>
    <x-firetakeaway::auth.authconteiner
    title="Login"
    image="/vendor/Firetakeaway/image/firetakeaway.png"
    >
        <x-slot name="form">
            <x-firetakeaway::form.form action="{{ route('login.user') }}" >
                <div class="px-5 py-7">
                    <x-firetakeaway::form.email name="email" label="Email" />
                    <x-firetakeaway::form.password name="password" label="Password" />
                    <x-firetakeaway::form.submit />
                </div>
            </x-firetakeaway::form.form>
        </x-slot>

        <x-slot name="links">
            <div class="grid grid-cols-2 gap-1">
                <div class="text-center sm:text-center whitespace-nowrap">
                    <x-firetakeaway::form.link route="{{ route('forgot-password') }}" name="Forgot Password" />
                </div>
                <div class="text-center sm:text-center whitespace-nowrap" >
                    <x-firetakeaway::form.link route="{{ route('register') }}" name="Register" />
                </div>
                <div class="text-center sm:text-center whitespace-nowrap" >
                    <x-firetakeaway::form.dark_light />
                </div>
            </div>
        </x-slot>
    </x-firetakeaway::auth.authconteiner>

</x-firetakeaway::layout.login>
