const requestsProducts = document.querySelectorAll('.requests-products');

requestsProducts.forEach(requestsProduct => {
  const buttons = requestsProduct.querySelectorAll('.user-solicites__button');
  const views = requestsProduct.querySelectorAll('.view-card__info');

  buttons.forEach(button => {
    button.addEventListener('click', () => {
      const target = button.getAttribute('data-target');

      views.forEach(view => {
        if (view.getAttribute('id') === target) {
          view.classList.add('active');
        } else {
          view.classList.remove('active');
        }
      });

      buttons.forEach(btn => {
        if (btn === button) {
          btn.classList.add('active');
        } else {
          btn.classList.remove('active');
        }
      });

      const targetView = requestsProduct.querySelector(target);
      if (targetView) {
        targetView.classList.add('active');
      }
    });
  });
});

