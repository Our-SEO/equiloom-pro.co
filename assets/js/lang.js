const langSelectors = document.querySelectorAll(
  ".lang-select, .lang-select-desktop"
);
langSelectors.forEach((langSelect) => {
  const langBtn = langSelect.querySelector(".lang-btn");
  const langMenu = langSelect.querySelector(".lang-menu");

  if (!langBtn || !langMenu) return;

  const langOptions = langMenu.querySelectorAll(".lang-option a");
  langOptions.forEach((option) => {
    option.addEventListener("click", (e) => {
      // e.preventDefault();
      const langText = option.querySelector("span:last-child").textContent;
      const langCode = option.getAttribute("href").replace("/", "");

      const flagImg = option.querySelector(".flag img").cloneNode(true);
      const label = langBtn.querySelector(".label");
      const flagContainer = langBtn.querySelector(".flag");

      flagContainer.innerHTML = "";
      flagContainer.appendChild(flagImg);
      label.textContent = `${langText} (${langCode.toUpperCase()})`;
    });
  });
});



