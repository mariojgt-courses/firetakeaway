<template>
    <div class="grid place-items-center mx-2 my-20 sm:my-auto">
        <!-- Auth Card -->
        <div
            class="w-11/12 p-12 sm:w-8/12 md:w-6/12 lg:w-5/12 2xl:w-4/12 px-6 py-10 sm:px-10 sm:py-6 bg-white rounded-lg shadow-md lg:shadow-lg"
        >
            <!-- Card Title -->
            <h2
                class="text-center font-semibold text-3xl lg:text-4xl text-gray-800"
            >
                Add Order
            </h2>

            <div class="m-4 flex">
                <input
                    class="rounded-l-lg p-4 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white"
                    v-model="search"
                    placeholder="Search for a product"
                />
                <button
                    class="px-8 rounded-r-lg bg-yellow-400 text-gray-800 font-bold p-4 uppercase border-yellow-500 border-t border-b border-r"
                    @click="productSearch()"
                >
                    Search
                </button>
            </div>

            <!-- Display the search products -->
            <div
                class="grid grid-cols-3 gap-4 px-5 mt-5 overflow-y-auto h-3/4"
                v-if="products"
            >
                <div
                    class="px-3 py-3 flex flex-col border border-gray-200 rounded-md h-32 justify-between"
                    v-for="(item, key) in products"
                    :key="key"
                    @click="addProductToOrder(item)"
                >
                    <div>
                        <div class="font-bold text-gray-800">
                            {{ item.name }}
                        </div>
                        <span class="font-light text-sm text-gray-400">
                            {{ item.description }}
                        </span>
                    </div>
                    <div class="flex flex-row justify-between items-center">
                        <span
                            class="self-end font-bold text-lg text-yellow-500"
                        >
                            {{ item.price }}
                        </span>
                        <img
                            :src="item.img_path"
                            class="h-14 w-14 object-cover rounded-md"
                            alt=""
                        />
                    </div>
                </div>
            </div>

            <!-- Added Products -->
            <h1>Added Products</h1>
            <div class="px-5 py-4 mt-5 overflow-y-auto h-64">
                <div
                    class="flex flex-row justify-between items-center mb-4"
                    v-for="(item, index) in addedProducts"
                    :key="index"
                >
                    <div class="flex flex-row items-center w-2/5">
                        <img
                            :src="item.img_path"
                            class="w-10 h-10 object-cover rounded-md"
                            alt=""
                        />
                        <span class="ml-4 font-semibold text-sm">{{
                            item.name
                        }}</span>
                    </div>
                    <div class="font-semibold text-lg w-16 text-center">
                        {{ item.price }}
                    </div>
                    <div
                        class="w-32 flex justify-between"
                        @click="removeProductFromOrder(index)"
                    >
                        <span class="px-3 py-1 rounded-md bg-red-300"
                            >Remove</span
                        >
                    </div>
                </div>
            </div>
        </div>
        <!-- Confirm Order button -->
        <div class="m-6 space-y-3 w-72" @click="createOrder()">
            <button
                class="block w-full px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-700 rounded shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none waves-effect"
            >
                Confirm Order
            </button>
        </div>
    </div>
</template>
<script>
export default {
    name: "add-order",
    props: {
        userid: {
            type: String,
            default: "",
        },
    },
    data: function () {
        return {
            products: [], //  Product Search Return Request
            search: "", // Product Search
            addedProducts: [], //  Added Products
        };
    },
    methods: {
        productSearch() {
            // Check if the search field is empty if yes display a message
            if (this.search === "") {
                Toast.fire({
                    icon: "error",
                    title: "Empty Search",
                });
            } else {
                // Request the products
                axios
                    .post("/api/product/search", {
                        search: this.search,
                    })
                    .then((res) => {
                        // Add the return request to the products variables
                        this.products = res.data.data;
                        // if (res.data.status === true) {
                        //     this.page.props.flash.success = success;
                        // }
                    })
                    .catch((err) => {
                        if (err.response.status === 422) {
                            Toast.fire({
                                icon: "error",
                                title: "Validation Fail",
                            });
                        } else {
                            Toast.fire({
                                icon: "error",
                                title: "Validation Fail",
                            });
                        }
                    });
            }
        },
        addProductToOrder(productRef) {
            // Add the value to a temp array
            this.addedProducts.push(productRef);
        },
        removeProductFromOrder(index) {
            // Remove the item from the array
            this.addedProducts.splice(index, 1);
        },
        createOrder() {
            // Request the products
            axios
                .post("/api/order/create", {
                    products: this.addedProducts,
                    userid  : this.userid,
                })
                .then((res) => {
                    Toast.fire({
                        icon: "info",
                        title: "Order Placed",
                    });
                    // Reload the page
                    location.reload();
                })
                .catch((err) => {
                    if (err.response.status === 422) {
                        Toast.fire({
                            icon: "error",
                            title: "Validation Fail",
                        });
                    } else {
                        Toast.fire({
                            icon: "error",
                            title: "Validation Fail",
                        });
                    }
                });
        },
    },
    created() {
        console.log(this.userid);
    },
    computed: {},
    mounted() {},
};
</script>
<style></style>
