document.addEventListener("DOMContentLoaded", () => {
    const params = new URLSearchParams(window.location.search);
    const tab = params.get("tab");
    const balitaTab = document.getElementById("balita-tab");
    const ibuTab = document.getElementById("ibu-hamil-tab");
    const balitaContent = document.getElementById("balita-content");
    const ibuContent = document.getElementById("ibu-hamil-content");

    const activateTab = (
        activeTab,
        inactiveTab,
        activeContent,
        inactiveContent,
        param
    ) => {
        activeContent.classList.add("active");
        inactiveContent.classList.remove("active");
        activeTab.classList.add("border-posyanduu", "text-posyanduu");
        inactiveTab.classList.remove("border-posyanduu", "text-posyanduu");
        history.replaceState(null, "", `?tab=${param}`);
    };

    if (tab === "ibu_hamil") {
        activateTab(ibuTab, balitaTab, ibuContent, balitaContent, "ibu_hamil");
    } else {
        activateTab(balitaTab, ibuTab, balitaContent, ibuContent, "balita");
    }

    balitaTab.addEventListener("click", () =>
        activateTab(balitaTab, ibuTab, balitaContent, ibuContent, "balita")
    );
    ibuTab.addEventListener("click", () =>
        activateTab(ibuTab, balitaTab, ibuContent, balitaContent, "ibu_hamil")
    );
});
