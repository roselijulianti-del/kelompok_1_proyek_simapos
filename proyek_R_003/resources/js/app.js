// resources/js/app.js
import "./slideprofile.js";
import "./bootstrap";
import "./pagination.js";
import Chart from "chart.js/auto";
window.Chart = Chart;
import "./chart.js";
import "./tab.js";
import "./sidebar.js";
import "./tambahd.js";

document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("login-form");
    const registerForm = document.getElementById("register-form");
    const loginToggle = document.getElementById("login-toggle");
    const registerToggle = document.getElementById("register-toggle");
    const toRegister = document.getElementById("to-register");
    const toLogin = document.getElementById("to-login");

    if (!loginForm || !registerForm) return;

    // Switch to Register form
    toRegister?.addEventListener("click", (e) => {
        e.preventDefault();
        loginForm.classList.add("hidden");
        registerForm.classList.remove("hidden");
        loginToggle.classList.remove("text-posyandu", "border-posyandu");
        loginToggle.classList.add("text-gray-500");
        registerToggle.classList.add("text-posyandu", "border-posyandu");
        registerToggle.classList.remove("text-gray-500");
    });

    // Switch to Login form
    toLogin?.addEventListener("click", (e) => {
        e.preventDefault();
        registerForm.classList.add("hidden");
        loginForm.classList.remove("hidden");
        registerToggle.classList.remove("text-posyandu", "border-posyandu");
        registerToggle.classList.add("text-gray-500");
        loginToggle.classList.add("text-posyandu", "border-posyandu");
        loginToggle.classList.remove("text-gray-500");
    });

    // Toggle buttons
    loginToggle?.addEventListener("click", () => {
        registerForm.classList.add("hidden");
        loginForm.classList.remove("hidden");
        registerToggle.classList.remove("text-posyandu", "border-posyandu");
        registerToggle.classList.add("text-gray-500");
        loginToggle.classList.add("text-posyandu", "border-posyandu");
        loginToggle.classList.remove("text-gray-500");
    });

    registerToggle?.addEventListener("click", () => {
        loginForm.classList.add("hidden");
        registerForm.classList.remove("hidden");
        loginToggle.classList.remove("text-posyandu", "border-posyandu");
        loginToggle.classList.add("text-gray-500");
        registerToggle.classList.add("text-posyandu", "border-posyandu");
        registerToggle.classList.remove("text-gray-500");
    });

    // Fake form submissions
    loginForm?.addEventListener("submit", (e) => {
        e.preventDefault();
        alert("Login berhasil! Redirecting...");
    });

    registerForm?.addEventListener("submit", (e) => {
        e.preventDefault();
        alert("Pendaftaran berhasil! Silakan login.");
        registerForm.classList.add("hidden");
        loginForm.classList.remove("hidden");
    });
});
