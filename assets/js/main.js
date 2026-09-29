(function () {
  var header = document.querySelector(".site-header");
  var toggle = document.querySelector(".menu-toggle");
  var nav = document.querySelector(".site-nav");
  var reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  document.documentElement.classList.add("js");

  function onScroll() {
    if (!header) return;
    header.classList.toggle("is-stuck", window.scrollY > 8);
  }

  if (toggle && nav) {
    toggle.addEventListener("click", function () {
      var open = nav.classList.toggle("is-open");
      toggle.setAttribute("aria-expanded", open ? "true" : "false");
    });
    nav.querySelectorAll("a").forEach(function (link) {
      link.addEventListener("click", function () {
        nav.classList.remove("is-open");
        toggle.setAttribute("aria-expanded", "false");
      });
    });
    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape") {
        nav.classList.remove("is-open");
        toggle.setAttribute("aria-expanded", "false");
      }
    });
  }

  document.querySelectorAll(".hero").forEach(function (hero) {
    if (!hero.querySelector(".hero-stage")) {
      var stage = document.createElement("div");
      stage.className = "hero-stage";
      stage.setAttribute("aria-hidden", "true");
      stage.innerHTML = '<span class="hero-grid"></span><span class="orb orb-a"></span><span class="orb orb-b"></span><span class="orb orb-c"></span>';
      hero.insertBefore(stage, hero.firstChild);
    }
    if (reduce) return;
    hero.addEventListener("pointermove", function (event) {
      var rect = hero.getBoundingClientRect();
      hero.style.setProperty("--mx", ((event.clientX - rect.left) / rect.width) * 100 + "%");
      hero.style.setProperty("--my", ((event.clientY - rect.top) / rect.height) * 100 + "%");
    });
  });

  var groups = document.querySelectorAll(".pill-grid, .practice-grid, .job-list, .card-grid, .benefit-grid, .badge-row, .alliance-grid, .jobs-intro");
  groups.forEach(function (group) {
    Array.prototype.forEach.call(group.children, function (child, index) {
      child.classList.add("reveal");
      child.style.setProperty("--d", String(Math.min(index, 8)));
    });
  });
  document.querySelectorAll(".partner-panel, .story-copy, .page-head .container, .apply-card, .contact-card, .section-head, .marquee, .fabric, .sustain-grid").forEach(function (node, index) {
    node.classList.add("reveal");
    node.style.setProperty("--d", String(index % 4));
  });

  if (reduce || !("IntersectionObserver" in window)) {
    document.querySelectorAll(".reveal").forEach(function (node) {
      node.classList.add("is-in");
    });
  } else {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("is-in");
        observer.unobserve(entry.target);
      });
    }, { threshold: 0.18, rootMargin: "0px 0px -8% 0px" });
    document.querySelectorAll(".reveal").forEach(function (node) {
      observer.observe(node);
    });
  }

  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();
})();
