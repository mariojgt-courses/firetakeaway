// Load vue js
import { createApp, h } from 'vue';

import tabs from "./vue_components/Tabs";
import Tab from "./vue_components/Tab";
import Example from "./vue_components/Example";
// Load the component
import CreateNewOrder from "./vue_components/OrderCreate";
// Load the order dashboard
import OrderDash from "./vue_components/OrderDashboad";

const el = document.getElementById('app');

const app = createApp({});

// Reusable
app.component('tabs', tabs);
app.component('tab', Tab);
app.component('example', Example);
// Include the component to vue js
app.component('order-create', CreateNewOrder);
// Include the order Dashboard
app.component('order-dash', OrderDash);


app.mount(el);
