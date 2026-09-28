document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll(".tab-button");
    const contents = document.querySelectorAll("[data-content]");
    const nav = tabs[0].parentElement;

    // Tambahkan elemen garis bawah
    const underline = document.createElement("div");
    underline.className =
        "absolute bottom-0 h-0.5 bg-posyanduu transition-all duration-300";
    nav.style.position = "relative";
    nav.appendChild(underline);

    // Fungsi posisi underline
    const setUnderline = (tab) => {
        const { offsetLeft, offsetWidth } = tab;
        underline.style.left = offsetLeft + "px";
        underline.style.width = offsetWidth + "px";
    };

    // Reset semua tab dan konten
    tabs.forEach((t) => {
        t.classList.remove("border-posyanduu", "text-posyanduu");
        t.classList.add("border-transparent", "text-gray-500");
    });
    contents.forEach((c) =>
        c.classList.add(
            "hidden",
            "opacity-0",
            "transition-all",
            "duration-300",
            "translate-y-2"
        )
    );

    // 🔹 Cek URL parameter tab
    const params = new URLSearchParams(window.location.search);
    const tabParam = params.get("tab");

    // Tentukan tab & konten default
    let activeTab, activeContent;

    if (tabParam === "ibu_hamil") {
        activeTab = document.getElementById("ibu-hamil-tab");
        activeContent = document.getElementById("ibu-hamil-content");
    } else {
        activeTab = document.getElementById("balita-tab");
        activeContent = document.getElementById("balita-content");
    }

    // Tampilkan tab aktif
    activeTab.classList.add("text-posyanduu");
    activeContent.classList.remove("hidden");
    setTimeout(() => {
        activeContent.classList.remove("opacity-0", "translate-y-2");
        activeContent.classList.add("opacity-100", "translate-y-0");
    }, 10);
    setUnderline(activeTab);

    // Event click untuk tiap tab
    tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
            tabs.forEach((t) => {
                t.classList.remove("text-posyanduu");
                t.classList.add("text-gray-500");
            });
            tab.classList.remove("text-gray-500");
            tab.classList.add("text-posyanduu");

            // Animasi underline
            setUnderline(tab);

            // Animasi konten keluar
            contents.forEach((c) => {
                c.classList.remove("opacity-100", "translate-y-0");
                c.classList.add("opacity-0", "translate-y-2");
                setTimeout(() => c.classList.add("hidden"), 300);
            });

            // Tampilkan konten baru
            const targetId =
                tab.id === "balita-tab"
                    ? "balita-content"
                    : "ibu-hamil-content";
            const targetContent = document.getElementById(targetId);

            setTimeout(() => {
                targetContent.classList.remove("hidden");
                setTimeout(() => {
                    targetContent.classList.remove(
                        "opacity-0",
                        "translate-y-2"
                    );
                    targetContent.classList.add("opacity-100", "translate-y-0");
                }, 10);
            }, 300);

            // 🔹 Update URL sesuai tab
            const newTab = tab.id === "balita-tab" ? "balita" : "ibu_hamil";
            const newUrl = window.location.pathname + "?tab=" + newTab;
            window.history.replaceState({}, "", newUrl);
        });
    });

    // Reposisi underline saat resize
    window.addEventListener("resize", () => {
        const activeTab = document.querySelector(".tab-button.text-posyanduu");
        if (activeTab) setUnderline(activeTab);
    });
});
