define(['jquery', 'underscore'], ($, _) => {
    return function () {
        const self = this;

        this.getNumericCustomFields = () => $('div.linked-form__field__value').find('input[type="numeric"].linked-form__cf.js-control-allow-numeric-float.text-input');

        this.getTemplate = _.bind(function (template, callback) {
            template = template || '';

            return this.render({
                href: '/templates/' + template + '.twig',
                base_path: this.params.path,
                v: this.get_version(),
                load: callback
            }, {});
        }, this);

        const currencyTags = {
            RUB: '₽',
            USD: '$',
            EUR: '€',
            TRY: '₺',
            GBP: '£',
            JPY: '¥',
            CNY: '¥',
            ILS: '₪',
            INR: '₨',
            NGN: '₦',
            THB: '฿',
            VND: '₫',
            LAK: '₭',
            KHR: '៛',
            MNT: '₮',
            PHP: '₱',
            IRR: '﷼',
            CRC: '₡',
            PYG: '₲',
            AFN: '؋',
            GHS: '₵',
            KZT: '₸',
            AZN: '₼',
            GEL: '₾',
            BTC: '฿',
        };

        this.callbacks = {
            render: () => {
                self.getNumericCustomFields().each(function () {
                    const $input = $(this);

                    const labelText = $input.closest('div.linked-form__field.linked-form__field-numeric').find('div.linked-form__field__label span').text();

                    const promise = new Promise(resolve => {
                        $.each(currencyTags, (currency, tag) => {
                            const labelTextLowered = labelText.toLowerCase();
                            const currencyLowered = currency.toLowerCase();

                            if (-1 !== labelTextLowered.indexOf(`-${currencyLowered}`)) {
                                self.getTemplate('sale', template => {
                                    const html = template.render({
                                        name: $input.attr('name'),
                                        value: $input.val(),
                                        tag: tag
                                    });

                                    $input.closest('div.linked-form__field__value').addClass('card-budget linked-form__field-text');

                                    $input.replaceWith(html);
                                });
                                return false;
                            }
                        });
                        setTimeout(() => resolve(), 200);
                    });

                    promise.then(() => $('input.custom-sale').trigger('input'));
                });

                $('body').on('click', 'div.card-tabs__item.js-card-tab', () => setTimeout(() => $('input.custom-sale').trigger('autosize:important'), 200));

                return true;
            },
            init: () => {
                return true;
            },
            bind_actions: function () {
                return true;
            },
            settings: $modal => {
                $modal.find('input[name="options"]').val(JSON.stringify({date: Date()})).trigger('change');
                $modal.find('button').trigger('click');
                return true;
            },
            onSave: function () {
                return true;
            },
            destroy: function () {

            }
        };
        return this;
    };
});