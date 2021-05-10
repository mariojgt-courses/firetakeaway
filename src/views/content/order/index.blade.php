<x-firetakeaway::layout.main>

    <p class="text-lg text-center font-bold m-5">Order</p>
    <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200">
        <tr class="text-left border-b border-gray-300">
            <th class="px-4 py-3">User</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Price</th>
            <th class="px-4 py-3">Actions</th>
        </tr>
        @foreach ($orders as $item)
        <tr class="bg-gray-700 border-b border-gray-600">
            <td class="px-4 py-3">{{ $item->user->email }}</td>
            <td class="px-4 py-3">
                {{ $item->status->name }}
            </td>
            <td class="px-4 py-3">
                {{ $item->total }}
            </td>
            <td class="px-4 py-3">
                {{-- <a href="{{ route('status.edit', $item->id) }}"
                    class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
                    Edit
                </a> --}}
                <a href="{{ route('order.delete', $item->id) }}"
                    class="border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">
                    Delete
                </a>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $orders->links() }}

    <order-create userid="{{ auth()->user()->id }}" > </order-create>

</x-firetakeaway::layout.main>
