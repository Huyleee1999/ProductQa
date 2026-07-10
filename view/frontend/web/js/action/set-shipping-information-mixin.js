define([
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote',
    'uiRegistry'
], function (wrapper, quote, registry) {
    'use strict';

    return function (setShippingInformationAction) {

        return wrapper.wrap(setShippingInformationAction, function (originalAction) {

            var shippingAddress = quote.shippingAddress();
            var provider = registry.get('checkoutProvider');

            if (!shippingAddress.extension_attributes) {
                shippingAddress.extension_attributes = {};
            }

            shippingAddress.extension_attributes.expert_question =
                provider.get('shippingAddress.expert_question');

            return originalAction();
        });
    };
});
