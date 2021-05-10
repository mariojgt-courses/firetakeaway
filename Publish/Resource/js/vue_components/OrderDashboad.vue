<template>
    <div class="w-full h-screen">
        <!-- New Orders -->
        <div
            class="flex flex-col lg:grid lg:gap-4 2xl:gap-6 lg:grid-cols-4 2xl:row-span-2 2xl:pb-8 ml-2 pt-4 px-6"
        >
            <!-- Beginning of the component about Daniel Clifford -->
            <div
                class="bg-gray-600 lg:order-1 lg:row-span-1 2xl:row-span-1 lg:col-span-2 rounded-lg shadow-xl mb-5 lg:mb-0"
            >
                <div class="mx-6 my-8 2xl:mx-10">New Orders</div>
                <div class="-mt-6 relative">
                    <table
                        class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200"
                    >
                        <tbody>
                            <tr class="text-left border-b border-gray-300">
                                <th class="px-4 py-3">Customer</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Price</th>
                                <th class="px-4 py-3">Item</th>
                                <th class="px-4 py-3">Placed At</th>
                                <th class="px-4 py-3">Action</th>
                            </tr>

                            <tr
                                class="bg-gray-700 border-b border-gray-600"
                                v-for="(item, index) in newOrders"
                                :key="index"
                            >
                                <td class="px-4 py-3">{{ item.user.name }}</td>
                                <td class="px-4 py-3">
                                    {{ item.status.name }}
                                </td>
                                <td class="px-4 py-3">{{ item.total }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="text-sm font-medium bg-green-100 py-1 px-2 rounded text-green-500 align-middle"
                                        v-for="(product, itemKey) in item.items"
                                        :key="itemKey"
                                        >{{ product.name }}</span
                                    >
                                </td>
                                <td class="px-4 py-3">{{ item.created_at }}</td>
                                <td class="px-4 py-3">
                                    <button
                                        class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline"
                                        @click="completeOrder(item.id)"
                                    >
                                        <span>Read for collection</span>
                                    </button>
                                </td>
                            </tr>
                            <!-- each row -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Completed Orders -->
            <div
                class="bg-gray-600 lg:order-1 lg:row-span-1 2xl:row-span-1 lg:col-span-2 rounded-lg shadow-xl mb-5 lg:mb-0"
            >
                <div class="mx-6 my-8 2xl:mx-10">Completed Orders</div>
                <div class="-mt-6 relative">
                    <table
                        class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200"
                    >
                        <tbody>
                            <tr class="text-left border-b border-gray-300">
                                <th class="px-4 py-3">Customer</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Price</th>
                                <th class="px-4 py-3">Item</th>
                                <th class="px-4 py-3">Placed At</th>
                            </tr>

                            <tr
                                class="bg-gray-700 border-b border-gray-600"
                                v-for="(item, index) in oldOrders"
                                :key="index"
                            >
                                <td class="px-4 py-3">{{ item.user.name }}</td>
                                <td class="px-4 py-3">
                                    {{ item.status.name }}
                                </td>
                                <td class="px-4 py-3">{{ item.total }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="text-sm font-medium bg-green-100 py-1 px-2 rounded text-green-500 align-middle"
                                        v-for="(product, itemKey) in item.items"
                                        :key="itemKey"
                                        >{{ product.name }}</span
                                    >
                                </td>
                                <td class="px-4 py-3">{{ item.created_at }}</td>
                            </tr>
                            <!-- each row -->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Ending of the component about Daniel Clifford -->
        </div>
    </div>
</template>
<script>
export default {
    name: "Order-dash",
    props: {
        editroute: {
            type: String,
            default: "",
        },
    },
    data: function () {
        return {
            // new orders
            newOrders: [],
            count: 0,
            // Old Orders
            oldOrders: [],
            countOld: 0,
        };
    },
    methods: {
        loadNewOrders() {
            // Axios request to get the new orders
            axios
                .get("/api/order/new", {})
                .then((res) => {
                    // Get the data andd assing to a varaible so we can loop
                    this.newOrders = res.data.data;
                    if (this.count != this.newOrders.length) {
                        Toast.fire({
                            icon: "info",
                            title: "New Order",
                        });
                        this.count = this.newOrders.length;
                    }
                })
                .catch(function (error) {});
        },
        loadOldOrders() {
            // Axios request to get the new orders
            axios
                .get("/api/order/old", {})
                .then((res) => {
                    // Get the data andd assing to a varaible so we can loop
                    this.oldOrders = res.data.data;
                    if (this.countOld != this.oldOrders.length) {
                        Toast.fire({
                            icon: "info",
                            title: "New Order Complete",
                        });
                        this.countOld = this.oldOrders.length;
                    }
                })
                .catch(function (error) {});
        },
        async completeOrder(id) {
            await axios
                .post("/api/order/complete", {
                    order_id: id,
                })
                .then(function (response) {
                    Toast.fire({
                        icon: "info",
                        title: "Order Compelte",
                    });
                })
                .catch(function (error) {});

            this.loadNewOrders();
        },
    },
    created() {
        // On load
        this.loadNewOrders();
        this.loadOldOrders();
        // Auto laod the new orders
        setInterval(() => {
            this.loadNewOrders();
            this.loadOldOrders();
        }, 5000);
    },
    computed: {},
    mounted() {},
};
</script>
<style></style>
