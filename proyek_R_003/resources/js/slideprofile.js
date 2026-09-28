const btn = document.getElementById("profileDropdownBtn");
const menu = document.getElementById("profileDropdownMenu");

btn.addEventListener("click", (e) => {
    e.stopPropagation();
    const isHidden = menu.classList.contains("pointer-events-none");

    if (isHidden) {
        // tampilkan dengan animasi
        menu.classList.remove("opacity-0", "scale-95", "pointer-events-none");
        menu.classList.add("opacity-100", "scale-100");
    } else {
        // sembunyikan dengan delay animasi
        menu.classList.remove("opacity-100", "scale-100");
        menu.classList.add("opacity-0", "scale-95");
        setTimeout(() => {
            menu.classList.add("pointer-events-none");
        }, 200); // durasi sama dengan duration-200
    }
});

// klik luar menutup dropdown
document.addEventListener("click", (e) => {
    if (!btn.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.remove("opacity-100", "scale-100");
        menu.classList.add("opacity-0", "scale-95", "pointer-events-none");
    }
});
