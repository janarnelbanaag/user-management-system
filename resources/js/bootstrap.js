import axios from "axios";
window.axios = axios;

window.axios.defaults.baseURL = import.meta.env.VITE_API_URL;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

const token = localStorage.getItem("auth_token");
if (token) {
    window.axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
}
