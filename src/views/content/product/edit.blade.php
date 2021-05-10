<x-firetakeaway::layout.main>


    <div class="grid place-items-center mx-2 my-20 sm:my-auto">
        <!-- Auth Card -->
        <div class="w-11/12 p-12 sm:w-8/12 md:w-6/12 lg:w-5/12 2xl:w-4/12
            px-6 py-10 sm:px-10 sm:py-6
            bg-white rounded-lg shadow-md lg:shadow-lg">

            <!-- Card Title -->
            <h2 class="text-center font-semibold text-3xl lg:text-4xl text-gray-800">
                Edit Product
            </h2>
            <img alt="product" width="200" class="w-45 rounded-md border-2 border-gray-300"
                src="{{ url($product->img_path) }}">

            <x-firetakeaway::form.form action="{{ route('product.update', $product->id) }}" file="true" method="PUT">
                <div class="px-5 py-7">
                    <x-firetakeaway::form.text value="{{ $product->name }}" name="name" label="Name" required="true" />
                    <x-firetakeaway::form.text value="{{ $product->description }}" name="description"
                        label="Description" />
                    <x-firetakeaway::form.number value="{{ $product->price }}" name="price" label="Price"
                        required="true" />
                    <br>
                    <input type="file" name="file">
                    <br>
                    <br>
                    <x-firetakeaway::form.submit name="Update" />
                </div>
            </x-firetakeaway::form.form>
        </div>
    </div>

</x-firetakeaway::layout.main>
