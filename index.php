<?php

require_once('php/loadLocalityList.php');

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Расчет стоимости и времени доставки в НП</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="js/components/FormStyler/jquery.formstyler.css">
    <link rel="stylesheet" href="js/components/FormStyler/jquery.formstyler.theme.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <table  class="container__parcel-info">
        <tr>
            <th colspan="2">
                Параметры посылки
            </th>
        </tr>
        <tr>
            <td>Стоимость:</td>
            <td>1000 грн.</td>
        </tr>
        <tr>
            <td>Вес:</td>
            <td>5 кг.</td>
        </tr>
    </table>
    <div class="container__col">
        <div class="container__col-title">
            Отправление
        </div>
        <div class="select-box">
            <label class="label" for="from_city">Город:</label>
            <select data-search="true" name="from_city" id="from_city" class="select select_city">
                <option></option>
                <?php
                    $settlement_list_output = '';
                    for ($count = $settlement_count; $count > 0; $count-- ) {
                        $settlement_item = mysqli_fetch_assoc($query_result);
                        $settlement_list_output .= '<option data-ref="' . $settlement_item['ref'] . '">';
                        $settlement_list_output .= $settlement_item['name'];
                        $settlement_list_output .= '</option>';
                    }
                    echo $settlement_list_output;
                ?>
            </select>
        </div>
        <div class="select-box">
            <label class="label" for="office_number">№ Отделения:</label>
            <select data-search="true" name="office_number" id="office_number" class="select select_office-number">
                <option></option>
            </select>
        </div>
    </div>
    <div class="container__col">
        <div class="container__col-title">
            Доставка
        </div>
        <div class="select-box">
            <label class="label" for="to_city">Город:</label>
            <select data-search="true" name="to_city" id="to_city" class="select select_city">
                <option></option>
                <?php echo $settlement_list_output; ?>
            </select>
        </div>
        <div class="select-box">
            <label class="label" for="office_number">№ Отделения:</label>
            <select data-search="true" name="office_number" id="office_number" class="select select_office-number">
                <option></option>
            </select>
        </div>
    </div>
    <table class="container__parcel-info">
        <tr>
            <th>
                Стоимость
            </th>
            <th>
                Ориентировочная дата прибытия груза
            </th>
        </tr>
        <tr>
            <td><span id="cost">0</span> грн.</td>
            <td><span id="date">~</span></td>
        </tr>
    </table>
</div>

<script defer src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script defer src="js/components/FormStyler/jquery.formstyler.min.js">

</script>
<script defer src="js/custom.js"></script>
</body>
</html>
