$(document).ready(function() {

   // plugins
    $('input, select').styler({
        onSelectOpened: function() {
            $(this).find('.jq-selectbox__search input').focus();
        }
    });
    // plugins

    // search offices
    $('body').on('change', '.jq-selectbox.select_city', function() {

        var current_city = $.trim( $(this).find('option:selected').text() );
        var container = $(this).closest('.container__col');

        if ( current_city == '' ) {
            return false;
        }

        var settings = {
          "async": true,
          "crossDomain": true,
          "url": "https://api.novaposhta.ua/v2.0/json/",
          "method": "POST",
          "headers": {
          "content-type": "application/json",
        },
          "processData": false,
          "data": "{\r\n\"apiKey\": \"cd605ed4ab43e54f994e40a2bd1c9801\",\r\n \"modelName\": \"Address\",\r\n \"calledMethod\": \"getWarehouses\",\r\n \"methodProperties\": {\"CityName\" : \""  + current_city + "\", \"Language\": \"ru\"}\r\n}"
        }

        $.ajax(settings).done(function (response) {
            container.find('select.select_office-number').empty();
            for (var office in response['data']) {
                var officesList = '';
                officesList += '<option>';
                officesList += response['data'][office]['DescriptionRu'];
                officesList += '</option>';
                container.find('select.select_office-number').append( officesList );
            }
            $('.select').trigger('refresh');
        });
    });
    // search offices

    // final calculate
    $('body').on('change', 'select', function() {

        if ( $('.select_city.changed').length === 2) {

            // calculate cost
            var fromCity = $('#from_city option:selected').data('ref');
            var toCity = $('#to_city option:selected').data('ref');

            var settings = {
              "async": true,
              "crossDomain": true,
              "url": "https://api.novaposhta.ua/v2.0/json/",
              "method": "POST",
              "headers": {
              "content-type": "application/json",
            },
              "processData": false,
              "data": "{\r\n\"apiKey\": \"cd605ed4ab43e54f994e40a2bd1c9801\",\r\n \"modelName\": \"InternetDocument\",\r\n \"calledMethod\": \"getDocumentPrice\",\r\n \"methodProperties\": {\"CitySender\" : \""  + fromCity + "\", \"CityRecipient\" : \""  + toCity + "\", \"Weight\" : \"5\", \"ServiceType\" : \"WarehouseWarehouse\", \"Cost\" : \"1000\", \"CargoType\" : \"Parcel\" }\r\n}"
            }

            $.ajax(settings).done(function (response) {
                $('#cost').text(response['data'][0]['Cost']);
            });
            // calculate cost

            // calculate date
            var settings2 = {
              "async": true,
              "crossDomain": true,
              "url": "https://api.novaposhta.ua/v2.0/json/",
              "method": "POST",
              "headers": {
              "content-type": "application/json",
            },
              "processData": false,
              "data": "{\r\n\"apiKey\": \"cd605ed4ab43e54f994e40a2bd1c9801\",\r\n \"modelName\": \"InternetDocument\",\r\n \"calledMethod\": \"getDocumentDeliveryDate\",\r\n \"methodProperties\": {\"ServiceType\" : \"WarehouseWarehouse\", \"CitySender\" : \""+ fromCity +"\", \"CityRecipient\" : \""+ toCity +"\"  }\r\n}"
            }


            $.ajax(settings2).done(function (response) {
                var date = response['data'][0]['DeliveryDate']['date'];
                date = date.split(' ')[0];
                $('#date').text(date);
            });
            // calculate date

        };

    })
    // final calculate

});
