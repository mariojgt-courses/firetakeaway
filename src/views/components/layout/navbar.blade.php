<nav
    class="font-sans flex flex-col text-center content-center sm:flex-row sm:text-left sm:justify-between py-2 px-6 bg-white shadow sm:items-baseline w-full">
    <div class="mb-2 sm:mb-0 inner">

        <a href="/home"
            class="text-2xl no-underline text-grey-darkest hover:text-blue-dark font-sans font-bold">Firetakeaway</a><br>
        <span class="text-xs text-grey-dark">Super food takeaway</span>

    </div>

    <div class="sm:mb-0 self-center">
        <!-- <div class="h-10" style="display: table-cell, vertical-align: middle;"> -->
        <a href="{{ route('product.index') }}"
            class="text-md no-underline text-black hover:text-blue-dark ml-2 px-1">Product</a>
        <a href="{{ route('status.index') }}"
            class="text-md no-underline text-black hover:text-blue-dark ml-2 px-1">Status</a>
        <a href="{{ route('order.index') }}" class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Order</a>
        <!-- <a href="/two" class="text-lg no-underline text-grey-darkest hover:text-blue-dark ml-2">About Us</a> -->
        <a href="{{ route('logout') }}"
            class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Logout</a>
        <!-- </div> -->

    </div>
</nav>
