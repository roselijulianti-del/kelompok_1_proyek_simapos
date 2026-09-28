const kategori = document.getElementById("kategori");
const formBalita = document.getElementById("form-balita");
const formIbuHamil = document.getElementById("form-ibu-hamil");
const kategoriHidden = document.getElementById("kategori_hidden");
const form = document.querySelector("form");

function toggleForm(value) {
    if (value === "balita") {
        formBalita.classList.remove("hidden");
        formIbuHamil.classList.add("hidden");

        formBalita
            .querySelectorAll("input, select, textarea")
            .forEach((i) => (i.disabled = false));
        formIbuHamil
            .querySelectorAll("input, select, textarea")
            .forEach((i) => (i.disabled = true));
    } else if (value === "ibu_hamil") {
        formIbuHamil.classList.remove("hidden");
        formBalita.classList.add("hidden");

        formIbuHamil
            .querySelectorAll("input, select, textarea")
            .forEach((i) => (i.disabled = false));
        formBalita
            .querySelectorAll("input, select, textarea")
            .forEach((i) => (i.disabled = true));
    } else {
        formBalita.classList.add("hidden");
        formIbuHamil.classList.add("hidden");
    }
}

kategori.addEventListener("change", (e) => {
    const value = e.target.value;
    kategoriHidden.value = value;
    toggleForm(value);
});

document.addEventListener("DOMContentLoaded", () => {
    const oldKategori = kategori.value;
    kategoriHidden.value = oldKategori;
    toggleForm(oldKategori);
});
