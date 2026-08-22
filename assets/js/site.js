(function () {
    document.documentElement.classList.remove("no-js");

    var toggle = document.querySelector("[data-nav-toggle]");
    var mobile = document.getElementById("nav-mobile");
    if (toggle && mobile) {
        toggle.addEventListener("click", function () {
            var open = toggle.getAttribute("aria-expanded") === "true";
            toggle.setAttribute("aria-expanded", String(!open));
            mobile.hidden = open;
        });
        mobile.querySelectorAll("a").forEach(function (link) {
            link.addEventListener("click", function () {
                toggle.setAttribute("aria-expanded", "false");
                mobile.hidden = true;
            });
        });
    }

    var header = document.querySelector(".site-header");
    if (header) {
        var onScroll = function () {
            header.classList.toggle("is-scrolled", window.scrollY > 12);
        };
        onScroll();
        window.addEventListener("scroll", onScroll, { passive: true });
    }

    var music = document.getElementById("bgMusic");
    var musicBtn = document.getElementById("musicBtn");
    if (music && musicBtn) {
        music.volume = 0.18;
        musicBtn.addEventListener("click", function () {
            if (music.paused) {
                music.play().catch(function () {});
                musicBtn.classList.add("is-on");
                musicBtn.setAttribute("aria-pressed", "true");
            } else {
                music.pause();
                musicBtn.classList.remove("is-on");
                musicBtn.setAttribute("aria-pressed", "false");
            }
        });
    }
})();
