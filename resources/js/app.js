import Alpine from "alpinejs";
import "./bootstrap";
import { createApp } from "vue";
import PostViewModal from "./PostViewModal.vue";

window.Alpine = Alpine;

Alpine.start();

const app = createApp({});

app.component("post-view-modal", PostViewModal);

app.mount("#app");
