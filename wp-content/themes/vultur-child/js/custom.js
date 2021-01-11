jQuery(document).ready(function ($) {
  $(document).on('click', '.mobile-filter', function () {
    $('.cat_sidebar').toggleClass('open');
  });

  $(document).on('click', '.close-sidebar, .facetwp-checkbox', function () {
    $('.cat_sidebar').removeClass('open');
  });

  // Start Facebook Pixel (initiate checkout and purchase)
  setTimeout(() => {
    const targetBody = document.querySelector("body");
    const observer = new MutationObserver(handleBodyChanges);

    let price = 0;
    let serviceName = '';
    let tutorName = '';

    // Observer for body changes
    observer.observe(targetBody, {
      childList: true,
      subtree: true,
    });

    function handleBodyChanges() {
      const dataLayer = window.dataLayer || [];
      const orderTab = document.querySelector('#amelia-app-booking0 #am-confirm-booking')
      const successTab = document.querySelector('#amelia-app-booking0 .am-success-payment')

      const layerEventExist = (layer, event) => layer.some(item => item['event'] === event);

      const addInlineScript = (content, id) => {
        const script = document.createElement('script')

        script.setAttribute('id', id)
        script.textContent  = content;
        document.head.appendChild(script)
      }

      const removeInlineScript = (id) => {
        const element = document.querySelector(`script#${id}`)

        element.parentNode.removeChild(element)
      }

      const getServiceAmount = (query) => {
        const amount = orderTab.querySelector(query).innerText

        return +amount.substring(1)
      }

      const eventBody = (content, price) => ({
        'content_ids' : content,
        'num_ids': 2,
        'content_type': 'product',
        'value' : price,
        'currency' : 'USD',
        'num_items' : 1,
        'content_name': content[1],
      });

      if (orderTab !== null && !layerEventExist(dataLayer, 'CheckoutInititated')) {
        price = getServiceAmount('.am-confirmation-total p.am-semi-strong.am-align-right');

        serviceName = orderTab.querySelector('.am-confirmation-booking-header img')
        serviceName = serviceName.getAttribute('alt')
        tutorName = document.querySelector('.am-employee-photo').parentElement.innerText

        dataLayer.push({
          'event' : 'CheckoutInititated',
          'customDataFB' : eventBody([serviceName, tutorName], price)
        })

        window.dataLayer = dataLayer
        addInlineScript(`fbq('track', 'InitiateCheckout', ${ JSON.stringify(eventBody([serviceName, tutorName], price)) })`, 'InitiateCheckout')
        
        // Handle Coupon changes
        const observerCoupon = new MutationObserver(handleCoupon);
        const targetCoupon = orderTab.querySelector(".am-confirmation-total");
        observerCoupon.observe(targetCoupon, {
          childList: true,
          characterData: true,
          subtree: true,
        });

        function handleCoupon() {
          price = getServiceAmount('.am-confirmation-total p.am-semi-strong.am-align-right');
          console.log(price)
        }
      }
      
      if (successTab !== null && !layerEventExist(dataLayer, 'TransactionSuccess')) {
        dataLayer.push({
          'event' : 'TransactionSuccess',
          'customDataFB' : eventBody([serviceName, tutorName], price)
          })
          window.dataLayer = dataLayer;
          removeInlineScript('InitiateCheckout')
          addInlineScript(`fbq('track', 'Purchase', ${ JSON.stringify(eventBody([serviceName, tutorName], price)) })`, 'TransactionSuccess')
      }
    }
    
  }, 1000)
  // End Facebook Pixel
});


