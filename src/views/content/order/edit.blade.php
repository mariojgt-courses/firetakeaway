<x-firetakeaway::layout.main>


    <div class="grid place-items-center mx-2 my-20 sm:my-auto">
        <!-- Auth Card -->
        <div class="w-11/12 p-12 sm:w-8/12 md:w-6/12 lg:w-5/12 2xl:w-4/12
            px-6 py-10 sm:px-10 sm:py-6
            bg-white rounded-lg shadow-md lg:shadow-lg">

            <!-- Card Title -->
            <h2 class="text-center font-semibold text-3xl lg:text-4xl text-gray-800">
                Edit Status
            </h2>

            <x-firetakeaway::form.form action="{{ route('status.update', $status) }}" method="PUT" >

                <div class="px-5 py-7">
                    <x-firetakeaway::form.text name="name" value="{{ $status->name }}" label="Name" required="true" />

                    <label class="font-semibold text-sm text-gray-600 dark:text-white pb-1 block">Color</label>
                    <input type="color" value="{{ $status->color }}" name="color">

                    <x-firetakeaway::form.submit name="Update" />
                </div>
            </x-firetakeaway::form.form>
        </div>
    </div>

</x-firetakeaway::layout.main>
