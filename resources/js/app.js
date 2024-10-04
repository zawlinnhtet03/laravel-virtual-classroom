import { createApp } from 'vue/dist/vue.esm-bundler';  // Import Vue

import ExampleComponent from './components/ExampleComponent.vue';  // Import your Vue component

const app = createApp({});
app.component('example-component', ExampleComponent);
app.mount('#app');  // Mount the app to the DOM element with the id 'app'