const petsServicesCards = document.querySelectorAll('.pets-services__card');

petsServicesCards.forEach((petServiceCard) => {
    const petsServicesDetails = petServiceCard.querySelector('.pets-services__details');
    const petsServicesImg = petServiceCard.querySelector('.pets-services__image');
    const petsServicesAbout = petServiceCard.querySelector('.pets-services__about');

    petServiceCard.addEventListener('mouseenter', () => {
        petsServicesImg.style.animation = 'opacityPetsAdd .4s ease forwards';
        petsServicesAbout.style.animation = 'opacityPetsAdd .4s ease forwards';
        petsServicesDetails.style.animation = 'cardDetailsUp .4s ease forwards';
    });

    petServiceCard.addEventListener('mouseleave', () => {
        petsServicesImg.style.animation = 'opacityPetsRemove .4s ease forwards';
        petsServicesAbout.style.animation = 'opacityPetsRemove .4s ease forwards';
        petsServicesDetails.style.animation = 'cardDetailsDown .4s ease forwards';
    });
});