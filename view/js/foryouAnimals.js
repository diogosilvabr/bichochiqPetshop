const foryouCards = document.querySelectorAll('.foryou-animals__card');

foryouCards.forEach(foryouCard => {
    const foryouCardsImg = foryouCard.querySelector('.foryou-animals__card > img');

    foryouCard.addEventListener('mouseenter', () => {
        foryouCardsImg.classList.remove("animacao-removeOpacidade");
        foryouCardsImg.classList.add("animacao-opacidade");
    
        // Aguarda o fim da animação para remover o display
        foryouCardsImg.addEventListener("transitionend", () => {
          setTimeout(() => {
            foryouCardsImg.style.display = "none";
          }, 200);
        });

        const foryouLinks = foryouCard.querySelectorAll('.foryou__link');

        foryouLinks.forEach((foryouLink) => {
          timeoutLink = setTimeout(() => {
            foryouLink.style.display = "flex";
          }, 200);
        });
    });

    foryouCard.addEventListener('mouseleave', () => {
        foryouCardsImg.classList.remove("animacao-opacidade");
        foryouCardsImg.classList.add("animacao-removeOpacidade");
        
        const foryouLinks = foryouCard.querySelectorAll('.foryou__link');

        foryouLinks.forEach((foryouLink) => {
          clearTimeout(timeoutLink);
          foryouLink.style.display = "none";
        });
    });
});