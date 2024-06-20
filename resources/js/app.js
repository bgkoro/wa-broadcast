import "./bootstrap";
import "flowbite";
import DateRangePicker from "flowbite-datepicker/DateRangePicker";

// dark mode
const root = document.documentElement;

document.addEventListener('livewire:init', () => {
    Livewire.on('reloadPage', () => {
        window.location.reload(false);
    });
});


// form validation
(() => {
    "use strict";

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll("form[novalidate]");

    // Loop over them and prevent submission
    Array.from(forms).forEach((form) => {
        form.addEventListener(
            "submit",
            (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                const inputs = form.getElementsByClassName("needs-validation");

                Array.from(inputs).forEach((input) => {
                    const isValidate = input.checkValidity();
                    if (!isValidate) {
                        input.classList.remove(
                            "border-dark-300",
                            "bg-light-50",
                            "focus:border-primary-600",
                            "focus:ring-primary-600",
                            "text-dark-900",
                            "dark:border-dark-600",
                            "dark:focus:ring-primary-500",
                            "dark:focus:border-primary-500"
                        );
                        input.classList.add(
                            "border-danger-500",
                            "bg-danger-50",
                            "focus:border-danger-600",
                            "focus:ring-danger-600",
                            "text-danger-600"
                        );

                        const errorEl = form.querySelector(
                            "#error" + input.name
                        );

                        if (errorEl) {
                            errorEl.innerHTML = input.validationMessage;
                            errorEl.classList.remove("hidden");
                        }
                    }
                });
            },
            false
        );
    });
})();

if (document.forms["create_campaign"]) {
    const form = document.forms["create_campaign"];
    const campaignMessage = form["message"];
    const messageSimulation = document.getElementById("message_simulation");
    const characterCount = document.getElementById("character_count");

    campaignMessage.oninput = () => {
        // campaign message simulation
        messageSimulation.innerText = campaignMessage.value;

        // message character count
        characterCount.innerText =
            campaignMessage.maxLength - campaignMessage.value.length;

        if (campaignMessage.value.length >= campaignMessage.maxLength) {
            campaignMessage.classList.remove(
                "border-dark-300",
                "bg-light-50",
                "focus:border-primary-600",
                "focus:ring-primary-600",
                "text-dark-900",
                "dark:border-dark-600",
                "dark:focus:ring-primary-500",
                "dark:focus:border-primary-500"
            );
            campaignMessage.classList.add(
                "border-danger-500",
                "bg-danger-50",
                "focus:border-danger-600",
                "focus:ring-danger-600",
                "text-danger-600"
            );
        } else {
            campaignMessage.classList.add(
                "border-dark-300",
                "bg-light-50",
                "focus:border-primary-600",
                "focus:ring-primary-600",
                "text-dark-900",
                "dark:border-dark-600",
                "dark:focus:ring-primary-500",
                "dark:focus:border-primary-500"
            );
            campaignMessage.classList.remove(
                "border-danger-500",
                "bg-danger-50",
                "focus:border-danger-600",
                "focus:ring-danger-600",
                "text-danger-600"
            );
        }
    };
}

// datepicker range
if (document.getElementById("dateRangePicker")) {
    const dateRangePickerEl = document.getElementById("dateRangePicker");
    const today = new Date();
    new DateRangePicker(dateRangePickerEl, {
        autohide: true,
        format: "yyyy-mm-dd",
        minDate: new Date(
            today.getFullYear(),
            today.getMonth() - 3,
            today.getDate()
        ),
        maxDate: today,
    });
}


if (import.meta.env.VITE_DARK_MODE === 'true' || import.meta.env.VITE_DARK_MODE === undefined) {
    const toggleThemeButton = document.getElementById("toggle-theme");
    const themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
    const themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");
    if (
        localStorage.getItem("theme") === "dark" ||
        (!("theme" in localStorage) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
        root.classList.add("dark");
        if (toggleThemeButton) {
            themeToggleLightIcon.classList.remove("hidden");
            themeToggleDarkIcon.classList.add("hidden");
        }
    } else {
        root.classList.remove("dark");
        if (toggleThemeButton) {
            themeToggleDarkIcon.classList.remove("hidden");
            themeToggleLightIcon.classList.add("hidden");
        }
    }

    function toggleTheme() {
        root.classList.toggle("dark");
        if (root.classList.contains("dark")) {
            localStorage.setItem("theme", "dark");
            themeToggleLightIcon.classList.remove("hidden");
            themeToggleDarkIcon.classList.add("hidden");
        } else {
            localStorage.setItem("theme", "light");
            themeToggleDarkIcon.classList.remove("hidden");
            themeToggleLightIcon.classList.add("hidden");
        }
    }

    if (toggleThemeButton) toggleThemeButton.addEventListener("click", toggleTheme);
}
