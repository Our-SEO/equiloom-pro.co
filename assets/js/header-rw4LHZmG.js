document.addEventListener("DOMContentLoaded", () => {
  const a = document.getElementById("header-menu-btn");
  a && B(a);
  const o = document.getElementById("header-mobile-menu"),
    r = document.getElementById("header");

  const w = "a[href], button:not([disabled]), textarea, input, select";
  let d, b;
  function A() {
    const e = o?.querySelectorAll(w);
    e && ((d = e[0]), (b = e[e.length - 1]));
  }
  function h() {
    a?.setAttribute("aria-expanded", "true"),
      o?.classList.remove("opacity-0", "invisible", "scale-95"),
      o?.classList.add("opacity-100", "visible", "scale-100"),
      document.body.classList.add("overflow-hidden"),
      a?.setAttribute("aria-label", "Close menu"),
      A(),
      d && d.focus();
  }
  function y() {
    a?.setAttribute("aria-expanded", "false"),
      o?.classList.remove("opacity-100", "visible", "scale-100"),
      o?.classList.add("opacity-0", "invisible", "scale-95"),
      document.body.classList.remove("overflow-hidden"),
      a?.setAttribute("aria-label", "Open menu"),
      a?.focus();
  }
  function x() {
    a?.getAttribute("aria-expanded") === "true" ? y() : h();
  }
  a?.addEventListener("click", x),
    o?.addEventListener("keydown", (e) => {
      e.key === "Tab" &&
        o?.contains(e.target) &&
        (e.shiftKey
          ? document.activeElement === d && (e.preventDefault(), b.focus())
          : document.activeElement === b && (e.preventDefault(), d.focus()));
    });
  function p(e, u) {
    const t = document.getElementById(e),
      c = document.getElementById(u);
    if (!t || !c) return;
    const s = t,
      i = c;
    function L() {
      s.setAttribute("aria-expanded", "true"),
        i.classList.remove("opacity-0", "scale-95", "invisible"),
        i.classList.add("opacity-100", "scale-100", "visible");
    }
    function f() {
      s.setAttribute("aria-expanded", "false"),
        i.classList.remove("opacity-100", "scale-100", "visible"),
        i.classList.add("opacity-0", "scale-95", "invisible");
    }
    function m() {
      return s.getAttribute("aria-expanded") === "true";
    }
    function k() {
      m() ? f() : L();
    }
    s.addEventListener("click", (n) => {
      n.stopPropagation(), E(e), k();
    }),
      s.addEventListener("keydown", (n) => {
        (n.key === "Enter" || n.key === " ") && (n.preventDefault(), k()),
          n.key === "ArrowDown" &&
            (n.preventDefault(),
            L(),
            i.querySelector('[role="menuitem"], a, button')?.focus()),
          n.key === "Escape" && m() && (n.preventDefault(), f());
      }),
      document.addEventListener("click", (n) => {
        !i.contains(n.target) && !s.contains(n.target) && m() && f();
      }),
      i.addEventListener("keydown", (n) => {
        n.key === "Escape" && m() && (n.preventDefault(), f(), s.focus());
      });
  }
  function E(e) {
    [
      document.getElementById("resources-btn"),
      document.getElementById("lang-btn"),
    ]
      .filter(Boolean)
      .forEach((t) => {
        if (t.id !== e && t.getAttribute("aria-expanded") === "true") {
          const c = t.getAttribute("aria-controls");
          if (!c) return;
          const s = document.getElementById(c);
          if (!s) return;
          t.setAttribute("aria-expanded", "false"),
            s.classList.remove("opacity-100", "scale-100", "visible"),
            s.classList.add("opacity-0", "scale-95", "invisible");
        }
      });
  }
  p("resources-btn", "resources-menu"),
    p("lang-btn", "lang-menu"),
    p("nft-btn", "nft-menu"),
    document.addEventListener("keydown", (e) => {
      e.key === "Escape" && a?.getAttribute("aria-expanded") === "true" && y(),
        e.key === "Escape" && E("");
    });
  const g = ["backdrop-blur-2xl", "shadow-md", "bg-[#0F0F0FCC]"];
  window.scrollY > 50 && r?.classList.add(...g),
    window.addEventListener("scroll", () => {
      window.scrollY > 50 ? r?.classList.add(...g) : r?.classList.remove(...g);
    }),
    v("mobile-lang-btn", "mobile-lang-menu"),
    v("mobile-resources-btn", "mobile-resources-menu"),
    v("mobile-nft-btn", "mobile-nft-menu");
  function v(e, u) {
    const t = document.getElementById(e),
      c = document.getElementById(u);
    function s() {
      if (!t) return;
      const i = t.getAttribute("aria-expanded") === "true";
      t.setAttribute("aria-expanded", (!i).toString());
    }
    t &&
      c &&
      (t.addEventListener("click", (i) => {
        i.stopPropagation(), s();
      }),
      document.addEventListener("click", (i) => {
        !c.contains(i.target) &&
          !t.contains(i.target) &&
          t.getAttribute("aria-expanded") === "true" &&
          t.setAttribute("aria-expanded", "false");
      }));
  }
});
function B(a) {
  const o = document.querySelectorAll("[data-lang-img]");
  a.addEventListener(
    "click",
    () => {
      o.forEach((l) => {
        const r = l.getAttribute("data-src") || "";
        l.setAttribute("src", r);
      });
    },
    { once: !0 }
  );
}
