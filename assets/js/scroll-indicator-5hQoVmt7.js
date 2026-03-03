function S() {
  return window.innerWidth < 1024;
}
function L(t) {
  if (!t.classList.contains("j-lazy-slide")) return;
  const o = t.querySelector("picture.hidden"),
    e = t.querySelector(".j-lazy-slide-image");
  o && o.classList.remove("hidden"),
    e && (e.style.display = "none"),
    t.classList.remove("j-lazy-slide");
}
function z(t) {
  if (!S()) return;
  Array.from(t.querySelectorAll(".j-lazy-slide")).forEach((e) => {
    const n = e.getBoundingClientRect(),
      s = t.getBoundingClientRect();
    n.left < s.right && n.right > s.left && L(e);
  });
}
function b(t, o) {
  const e = document.getElementById(t),
    n = Array.from(document.querySelectorAll(o));
  if (!e || n.length === 0) return;
  const s = "bg-slate-100/40",
    a = ["bg-gradient-to-r", "from-[#5D5FEF]", "to-[#48C6EF]"];
  function f(i, l) {
    a.forEach((r) => i.classList.toggle(r, l)), i.classList.toggle(s, !l);
  }
  let c = !1;
  function u(i) {
    const l = n.length;
    if (l === 0) {
      c = !1;
      return;
    }
    const r = Math.max(i.scrollWidth - i.clientWidth, 1),
      g = i.scrollLeft / r,
      h = Math.min(l - 1, Math.max(0, Math.round(g * (l - 1))));
    n.forEach((y, m) => {
      f(y, m === h);
    }),
      t === "sw-how-to-by-slider" && z(i),
      (c = !1);
  }
  function d(i) {
    c || ((c = !0), requestAnimationFrame(() => u(i)));
  }
  e.addEventListener("scroll", () => d(e), { passive: !0 }), u(e);
}
b("sw-how-to-by-slider", ".j-how-to-by-bullet");
