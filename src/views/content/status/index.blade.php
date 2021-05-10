<x-firetakeaway::layout.main>

    <p class="text-lg text-center font-bold m-5">Status</p>
    <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200">
        <tr class="text-left border-b border-gray-300">
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Color</th>
            <th class="px-4 py-3">Actions</th>
        </tr>
        @foreach ($status as $item)
        <tr class="bg-gray-700 border-b border-gray-600">
            <td class="px-4 py-3">{{ $item->name }}</td>
            <td class="px-4 py-3">
                <div class="h-12 w-12 mx-auto rounded-md" style="background: {{ $item->color }}" ></div>
            </td>
            <td class="px-4 py-3">
                <a href="{{ route('status.edit', $item->id) }}"
                    class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
                    Edit
                </a>
                <a href="{{ route('status.delete', $item->id) }}"
                    class="border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">
                    Delete
                </a>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $status->links() }}

    <div class="grid place-items-center mx-2 my-20 sm:my-auto">
        <!-- Auth Card -->
        <div class="w-11/12 p-12 sm:w-8/12 md:w-6/12 lg:w-5/12 2xl:w-4/12
            px-6 py-10 sm:px-10 sm:py-6
            bg-white rounded-lg shadow-md lg:shadow-lg">

            <!-- Card Title -->
            <h2 class="text-center font-semibold text-3xl lg:text-4xl text-gray-800">
                Add Status
            </h2>

            <x-firetakeaway::form.form action="{{ route('status.store') }}" file="true">
                <div class="px-5 py-7">
                    <x-firetakeaway::form.text name="name" label="Name" required="true" />

                    <label class="font-semibold text-sm text-gray-600 dark:text-white pb-1 block">Color</label>
                    <input type="color" name="color">

                    <x-firetakeaway::form.submit name="Create" />
                </div>
            </x-firetakeaway::form.form>
        </div>
    </div>

</x-firetakeaway::layout.main>
