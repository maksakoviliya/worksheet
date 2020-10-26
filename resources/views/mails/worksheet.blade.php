<!DOCTYPE html>
<html>
<head>
    <title>Анкетта была изменена</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);

        body {
            background-color: #3e94ec;
            font-family: "Roboto", helvetica, arial, sans-serif;
            font-size: 16px;
            font-weight: 400;
            text-rendering: optimizeLegibility;
        }

        div.table-title {
            display: block;
            margin: auto;
            max-width: 600px;
            padding: 5px;
            width: 100%;
        }

        .table-title h3 {
            color: #fafafa;
            font-size: 30px;
            font-weight: 400;
            font-style: normal;
            font-family: "Roboto", helvetica, arial, sans-serif;
            text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
            text-transform: uppercase;
        }


        /*** Table Styles **/

        .table-fill {
            background: white;
            border-radius: 3px;
            border-collapse: collapse;
            height: 320px;
            margin: auto;
            max-width: 600px;
            padding: 5px;
            width: 100%;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            animation: float 5s infinite;
        }

        th {
            color: #D5DDE5;;
            background: #1b1e24;
            border-bottom: 4px solid #9ea7af;
            border-right: 1px solid #343a45;
            font-size: 23px;
            font-weight: 100;
            padding: 24px;
            text-align: left;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            vertical-align: middle;
        }

        th:first-child {
            border-top-left-radius: 3px;
        }

        th:last-child {
            border-top-right-radius: 3px;
            border-right: none;
        }

        tr {
            border-top: 1px solid #C1C3D1;
            border-bottom-: 1px solid #C1C3D1;
            color: #666B85;
            font-size: 16px;
            font-weight: normal;
            text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
        }


        tr:first-child {
            border-top: none;
        }

        tr:last-child {
            border-bottom: none;
        }

        tr:nth-child(odd) td {
            background: #EBEBEB;
        }


        tr:last-child td:first-child {
            border-bottom-left-radius: 3px;
        }

        tr:last-child td:last-child {
            border-bottom-right-radius: 3px;
        }

        td {
            background: #FFFFFF;
            padding: 20px;
            text-align: left;
            vertical-align: middle;
            font-weight: 300;
            font-size: 18px;
            text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
            border-right: 1px solid #C1C3D1;
        }

        td:last-child {
            border-right: 0px;
        }

        th.text-left {
            text-align: left;
        }

        th.text-center {
            text-align: center;
        }

        th.text-right {
            text-align: right;
        }

        td.text-left {
            text-align: left;
        }

        td.text-center {
            text-align: center;
        }

        td.text-right {
            text-align: right;
        }

    </style>
</head>
<body>
<div class="table-wrapper">
    <div class="table-title">
        <h3>Общие данные</h3>
    </div>
    <table class="table-fill">
        <thead>
        <tr>
            <th class="text-left">Поле</th>
            <th class="text-left">Значение</th>
        </tr>
        </thead>
        <tbody class="table-hover">
        <tr>
            <td class="text-left">Ссылка на сделку в Envy</td>
            <td class="text-left">{{ $worksheet->envyID }}</td>
        </tr>
        <tr>
            <td class="text-left">ФИО клиента</td>
            <td class="text-left">{{ $worksheet->name }}</td>
        </tr>
        <tr>
            <td class="text-left">Телефон</td>
            <td class="text-left">{{ $worksheet->phone }}</td>
        </tr>
        <tr>
            <td class="text-left">Основной email</td>
            <td class="text-left">{{ $worksheet->email }}</td>
        </tr>
        <tr>
            <td class="text-left">Мессенджеры</td>
            <td class="text-left">{{ join(', ', $worksheet->messengers) }}</td>
        </tr>
        <tr>
            <td class="text-left">Город проживания</td>
            <td class="text-left">{{ $worksheet->livingCity }}</td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrapper">
    <div class="table-title">
        <h3>Паспортные данные</h3>
    </div>
    <table class="table-fill">
        <thead>
        <tr>
            <th class="text-left">Поле</th>
            <th class="text-left">Значение</th>
        </tr>
        </thead>
        <tbody class="table-hover">
        <tr>
            <td class="text-left">Дата рождения</td>
            <td class="text-left">{{ \Carbon\Carbon::parse($worksheet->birthday)->format('d.m.Y') }}</td>
        </tr>
        <tr>
            <td class="text-left">Серия Номер</td>
            <td class="text-left">{{ $worksheet->series }} {{ $worksheet->number }}</td>
        </tr>
        <tr>
            <td class="text-left">Дата выдачи</td>
            <td class="text-left">{{ \Carbon\Carbon::parse($worksheet->isssued)->format('d.m.Y') }}</td>
        </tr>
        <tr>
            <td class="text-left">Код подразделения</td>
            <td class="text-left">{{ $worksheet->code }}</td>
        </tr>
        <tr>
            <td class="text-left">Кем выдан</td>
            <td class="text-left">{{ $worksheet->issuedBy }}</td>
        </tr>
        <tr>
            <td class="text-left">Место рождения</td>
            <td class="text-left">{{ $worksheet->born }}</td>
        </tr>
        <tr>
            <td class="text-left">Индекс</td>
            <td class="text-left">{{ $worksheet->index }}</td>
        </tr>
        <tr>
            <td class="text-left">Регион</td>
            <td class="text-left">{{ $worksheet->region }}</td>
        </tr>
        <tr>
            <td class="text-left">Район</td>
            <td class="text-left">{{ $worksheet->area }}</td>
        </tr>
        <tr>
            <td class="text-left">Город (Населенный пункт)</td>
            <td class="text-left">{{ $worksheet->city }}</td>
        </tr>
        <tr>
            <td class="text-left">Улица</td>
            <td class="text-left">{{ $worksheet->street }}</td>
        </tr>
        <tr>
            <td class="text-left">Дом</td>
            <td class="text-left">{{ $worksheet->house }}</td>
        </tr>
        <tr>
            <td class="text-left">Корпус</td>
            <td class="text-left">{{ $worksheet->housing }}</td>
        </tr>
        <tr>
            <td class="text-left">Квартира</td>
            <td class="text-left">{{ $worksheet->room }}</td>
        </tr>
        <tr>
            <td class="text-left">Адрес регистрации</td>
            <td class="text-left">{{ $worksheet->registration }}</td>
        </tr>
        <tr>
            <td class="text-left">Почтовый адрес</td>
            <td class="text-left">{{ $worksheet->post }}</td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrapper">
    <div class="table-title">
        <h3>Кредиторы</h3>
    </div>
    <table class="table-fill">
        <thead>
        <tr>
            <th class="text-left">Банк</th>
            <th class="text-left">Тип кредита</th>
            <th class="text-left">Сумма кредита</th>
            <th class="text-left">Текущая задолженность</th>
            <th class="text-left">Ежемесячный платеж</th>
            <th class="text-left">Просрочка (мес)</th>
            <th class="text-left">Комментарий</th>
        </tr>
        </thead>
        <tbody class="table-hover">
        @if(count($worksheet->creditors))
            @foreach($worksheet->creditors as $creditor)
                <tr>
                    <td class="text-left">{{ $creditor['bank'] }}</td>
                    <td class="text-left">{{ $creditor['type'] }}</td>
                    <td class="text-left">{{ $creditor['total'] }}</td>
                    <td class="text-left">{{ $creditor['current'] }}</td>
                    <td class="text-left">{{ $creditor['monthly'] }}</td>
                    <td class="text-left">{{ $creditor['delay'] }}</td>
                    <td class="text-left">{{ $creditor['comment'] }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-left">Нет данных</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

<div class="table-wrapper">
    <div class="table-title">
        <h3>Официальный доход</h3>
    </div>
    <table class="table-fill">
        <thead>
        <tr>
            <th class="text-left">Место работы</th>
            <th class="text-left">Должность</th>
            <th class="text-left">Официальный доход</th>
            <th class="text-left">Неофициальный доход</th>
        </tr>
        </thead>
        <tbody class="table-hover">
        @if(count($worksheet->sources))
            @foreach($worksheet->sources as $item)
                <tr>
                    <td class="text-left">{{ $item['place'] }}</td>
                    <td class="text-left">{{ $item['position'] }}</td>
                    <td class="text-left">{{ $item['legal'] }}</td>
                    <td class="text-left">{{ $item['illegal'] }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-left">Нет данных</td>
            </tr>
        @endif
        </tbody>
    </table>
    <table class="table-fill">
        <thead>
        <tr>
            <th class="text-left">Поле</th>
            <th class="text-left">Значение</th>
        </tr>
        </thead>
        <tbody class="table-hover">
        <tr>
            <td class="text-left">Являетсь ли вы учредителем ООО/ИП?</td>
            <td class="text-left">
                @if($worksheet->isIp === 1)
                    Да
                @else
                    Нет
                @endif
            </td>
        </tr>
        <tr>
            <td class="text-left">Комментарий к ООО/ИП</td>
            <td class="text-left">{{ $worksheet->oooComment}}</td>
        </tr>
        <tr>
            <td class="text-left">Являетесь ли Вы генеральным директором в ООО?</td>
            <td class="text-left">@if($worksheet->isDirector === 1)
                    Да
                @else
                    Нет
                @endif</td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrapper">
    <div class="table-title">
        <h3>Семейное положение</h3>
    </div>
    <table class="table-fill">
        <thead>
        <tr>
            <th class="text-left">Поле</th>
            <th class="text-left">Значение</th>
        </tr>
        </thead>
        <tbody class="table-hover">
        <tr>
            <td class="text-left">Семейное положение</td>
            <td class="text-left">
                @if($worksheet->isMarried === 1)
                    Женат(Замужем)
                @else
                    Холост
                @endif
            </td>
        </tr>
        <tr>
            <td class="text-left">ФИО супруга(и)</td>
            <td class="text-left">{{ $worksheet->spouse}}</td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrapper">
    <div class="table-title">
        <h3>Дети</h3>
    </div>
    <table class="table-fill">
        <thead>
        <tr>
            <th class="text-left">ФИО</th>
            <th class="text-left">Дата рождения</th>
            <th class="text-left">Возраст</th>
        </tr>
        </thead>
        <tbody class="table-hover">
        @if(count($worksheet->children))
            @foreach($worksheet->children as $item)
                <tr>
                    <td class="text-left">{{ $item['name'] }}</td>
                    <td class="text-left">{{ \Carbon\Carbon::parse($item['birthday'])->format('d.m.Y') }}</td>
                    <td class="text-left">{{ \Carbon\Carbon::parse($item['birthday'])->age }}</td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-left">Нет данных</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

<div class="table-wrapper">
    <div class="table-title">
        <h3>Недвижимое имущество</h3>
    </div>
    <table class="table-fill">
        <thead>
        <tr>
            <th class="text-left">Вид иимущества</th>
            <th class="text-left">Вид собственности</th>
            <th class="text-left">Местонахождение</th>
            <th class="text-left">Площадь</th>
            <th class="text-left">Сведения о залоге</th>
            <th class="text-left">Основание приобретения</th>
            <th class="text-left">Стоимость</th>
            <th class="text-left">Дата приобретения</th>
        </tr>
        </thead>
        <tbody class="table-hover">
        @if(count($worksheet->immovable))
            @foreach($worksheet->immovable as $item)
                <tr>
                    <td class="text-left">{{ $item['type'] }}</td>
                    <td class="text-left">{{ $item['ownership'] }}</td>
                    <td class="text-left">{{ $item['address'] }}</td>
                    <td class="text-left">{{ $item['area'] }}</td>
                    <td class="text-left">{{ $item['pledge'] }}</td>
                    <td class="text-left">{{ $item['basis'] }}</td>
                    <td class="text-left">{{ $item['cost'] }}</td>
                    <td class="text-left">{{ \Carbon\Carbon::parse($item['date'])->format('d.m.Y') }}</td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-left">Нет данных</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

<div class="table-wrapper">
    <div class="table-title">
        <h3>Движимое имущество</h3>
    </div>
    <table class="table-fill">
        <thead>
        <tr>
            <th class="text-left">Вид иимущества</th>
            <th class="text-left">Вид собственности</th>
            <th class="text-left">Местонахождение</th>
            <th class="text-left">Марка и модель</th>
            <th class="text-left">VIN номер</th>
            <th class="text-left">Сведения о залоге</th>
            <th class="text-left">Стоимость</th>
            <th class="text-left">Дата приобретения</th>
        </tr>
        </thead>
        <tbody class="table-hover">
        @if(count($worksheet->movable))
            @foreach($worksheet->movable as $item)
                <tr>
                    <td class="text-left">{{ $item['type'] }}</td>
                    <td class="text-left">{{ $item['ownership'] }}</td>
                    <td class="text-left">{{ $item['address'] }}</td>
                    <td class="text-left">{{ $item['model'] }}</td>
                    <td class="text-left">{{ $item['vin'] }}</td>
                    <td class="text-left">{{ $item['pledge'] }}</td>
                    <td class="text-left">{{ $item['cost'] }}</td>
                    <td class="text-left">{{ \Carbon\Carbon::parse($item['date'])->format('d.m.Y') }}</td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-left">Нет данных</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

<div class="table-wrapper">
    <div class="table-title">
        <h3>Недвижимое имущество супруга(и)</h3>
    </div>
    <table class="table-fill">
        <thead>
        <tr>
            <th class="text-left">Вид иимущества</th>
            <th class="text-left">Вид собственности</th>
            <th class="text-left">Местонахождение</th>
            <th class="text-left">Площадь</th>
            <th class="text-left">Сведения о залоге</th>
            <th class="text-left">Основание приобретения</th>
            <th class="text-left">Стоимость</th>
            <th class="text-left">Дата приобретения</th>
        </tr>
        </thead>
        <tbody class="table-hover">
        @if(count($worksheet->spousesImmovable))
            @foreach($worksheet->spousesImmovable as $item)
                <tr>
                    <td class="text-left">{{ $item['type'] }}</td>
                    <td class="text-left">{{ $item['ownership'] }}</td>
                    <td class="text-left">{{ $item['address'] }}</td>
                    <td class="text-left">{{ $item['area'] }}</td>
                    <td class="text-left">{{ $item['pledge'] }}</td>
                    <td class="text-left">{{ $item['basis'] }}</td>
                    <td class="text-left">{{ $item['cost'] }}</td>
                    <td class="text-left">{{ \Carbon\Carbon::parse($item['date'])->format('d.m.Y') }}</td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-left">Нет данных</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

<div class="table-wrapper">
    <div class="table-title">
        <h3>Движимое имущество супруга(и)</h3>
    </div>
    <table class="table-fill">
        <thead>
        <tr>
            <th class="text-left">Вид иимущества</th>
            <th class="text-left">Вид собственности</th>
            <th class="text-left">Местонахождение</th>
            <th class="text-left">Марка и модель</th>
            <th class="text-left">VIN номер</th>
            <th class="text-left">Сведения о залоге</th>
            <th class="text-left">Стоимость</th>
            <th class="text-left">Дата приобретения</th>
        </tr>
        </thead>
        <tbody class="table-hover">
        @if(count($worksheet->spousesMovable))
            @foreach($worksheet->spousesMovable as $item)
                <tr>
                    <td class="text-left">{{ $item['type'] }}</td>
                    <td class="text-left">{{ $item['ownership'] }}</td>
                    <td class="text-left">{{ $item['address'] }}</td>
                    <td class="text-left">{{ $item['model'] }}</td>
                    <td class="text-left">{{ $item['vin'] }}</td>
                    <td class="text-left">{{ $item['pledge'] }}</td>
                    <td class="text-left">{{ $item['cost'] }}</td>
                    <td class="text-left">{{ \Carbon\Carbon::parse($item['date'])->format('d.m.Y') }}</td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-left">Нет данных</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
<?php $sources = [
    'Кредит (Ипотека',
    'Собственные сбережения',
    'Трейд–ИН',
    'Займ у родственников',
    'Материнский капитал'
] ?>
<div class="table-wrapper">
    <div class="table-title">
        <h3>Оспоримые сделки по движимому имуществу</h3>
    </div>
    <table class="table-fill">
        <thead>
        <tr>
            <th class="text-left">Объект</th>
            <th class="text-left">Дата сделки</th>
            <th class="text-left">Дата приобретения</th>
            <th class="text-left">На что приобритен</th>
            <th class="text-left">Дата регистрации</th>
        </tr>
        </thead>
        <tbody class="table-hover">
        @if(count($worksheet->voidableMovable))
            @foreach($worksheet->voidableMovable as $item)
                <tr>
                    <td class="text-left">{{ $item['object'] }}</td>
                    <td class="text-left">{{ \Carbon\Carbon::parse($item['date'])->format('d.m.Y') }}</td>
                    <td class="text-left">{{ \Carbon\Carbon::parse($item['buyDate'])->format('d.m.Y') }}</td>
                    <td class="text-left">{{ $sources[$item['source']] }}</td>
                    <td class="text-left">{{ \Carbon\Carbon::parse($item['registrationDate'])->format('d.m.Y') }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-left">Нет данных</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>


<div class="table-wrapper">
    <div class="table-title">
        <h3>Оспоримые сделки по недвижимому имуществу</h3>
    </div>
    <table class="table-fill">
        <thead>
        <tr>
            <th class="text-left">Объект</th>
            <th class="text-left">Дата сделки</th>
            <th class="text-left">Дата приобретения</th>
            <th class="text-left">На что приобритен</th>
            <th class="text-left">Дата регистрации</th>
        </tr>
        </thead>
        <tbody class="table-hover">

        @if(count($worksheet->voidableImmovable))
            @foreach($worksheet->voidableImmovable as $item)
                <tr>
                    <td class="text-left">{{ $item['object'] }}</td>
                    <td class="text-left">{{ \Carbon\Carbon::parse($item['date'])->format('d.m.Y') }}</td>
                    <td class="text-left">{{ \Carbon\Carbon::parse($item['buyDate'])->format('d.m.Y') }}</td>
                    <td class="text-left">{{ $sources[$item['source']] }}</td>
                    <td class="text-left">{{ \Carbon\Carbon::parse($item['registrationDate'])->format('d.m.Y') }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-left">Нет данных</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

<div class="table-wrapper">
    <div class="table-title">
        <h3>Данные по оплате</h3>
    </div>
    <table class="table-fill">
        <thead>
        <tr>
            <th class="text-left">Филиал</th>
            <th class="text-left">Менеджер</th>
            <th class="text-left">Бюджет</th>
            <th class="text-left">Ежемесячный платеж</th>
            <th class="text-left">Срок рассрочки (мес)</th>
            <th class="text-left">Дата платежа рассрочки</th>
            <th class="text-left">Онлайн продажа</th>
        </tr>
        </thead>
        <tbody class="table-hover">

        @if(count($worksheet->payment))
            @foreach($worksheet->payment as $item)
                <tr>
                    <td class="text-left">{{ $item['filial'] }}</td>
                    <td class="text-left">{{ $item['manager'] }}</td>
                    <td class="text-left">{{ $item['budget'] }}</td>
                    <td class="text-left">{{ $item['monthly'] }}</td>
                    <td class="text-left">{{ $item['installment'] }}</td>
                    <td class="text-left">{{ \Carbon\Carbon::parse($item['paymentDate'])->format('d.m.Y') }}</td>
                    <td class="text-left">
                        @if($item['online'] === 1)
                            Да
                        @else
                            Нет
                        @endif

                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-left">Нет данных</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
</body>
</html>
