document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("menu-btn");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    const openSidebar = () => {
        sidebar.classList.remove("-translate-x-full");
        overlay.classList.remove("hidden");
    };

    const closeSidebar = () => {
        sidebar.classList.add("-translate-x-full");
        overlay.classList.add("hidden");
    };

    btn.addEventListener("click", openSidebar);
    overlay.addEventListener("click", closeSidebar);
});
