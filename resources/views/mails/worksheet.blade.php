<!DOCTYPE html>
<html>
<head>
    <title>Анкетта была изменена</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);

        body {
            font-family: "Roboto", helvetica, arial, sans-serif;
            font-size: 16px;
            font-weight: 400;
            text-rendering: optimizeLegibility;
        }
    </style>
</head>
<body>
<div class="table-wrapper">
    <div class="table-title">
        <h3>Общие данные</h3>
    </div>
    <div>
        <p class="text-left">Филиал: <span class="text-left">{{$worksheet->filial->name}}</span></p>
        <p class="text-left">Ссылка на сделку в Envy : <span class="text-left">{{ $worksheet->envyID }}</span></p>
        <p class="text-left">ФИО клиента : <span class="text-left">{{ $worksheet->name }}</span></p>
        <p class="text-left">Телефон : <span class="text-left">{{ $worksheet->phone }}</span></p>
        <p class="text-left">Основной email : <span class="text-left">{{ $worksheet->email }}</span></p>
        <p class="text-left">Мессенджеры : <span class="text-left">{{ join(', ', $worksheet->messengers) }}</span></p>
        <p class="text-left">Город проживания : <span class="text-left">{{ $worksheet->livingCity }}</span></p>
    </div>

    <div class="table-wrapper">
        <div class="table-title">
            <h3>Паспортные данные</h3>
        </div>
        <p class="text-left">Дата рождения: <span
                class="text-left">{{ \Carbon\Carbon::parse($worksheet->birthday)->format('d.m.Y') }}</span></p>
        <p class="text-left">Серия:<span class="text-left">{{ $worksheet->series }}</span></p>
        <p class="text-left">Номер: <span class="text-left">{{ $worksheet->number }}</span></p>
        <p class="text-left">Дата выдачи: <span
                class="text-left">{{ \Carbon\Carbon::parse($worksheet->isssued)->format('d.m.Y') }}</span></p>
        <p class="text-left">Код подразделения: <span class="text-left">{{ $worksheet->code }}</span></p>
        <p class="text-left">Кем выдан: <span class="text-left">{{ $worksheet->issuedBy }}</span></p>
        <p class="text-left">Место рождения: <span class="text-left">{{ $worksheet->born }}</span></p>
        <p class="text-left">Индекс: <span class="text-left">{{ $worksheet->index }}</span></p>
        <p class="text-left">Регион: <span class="text-left">{{ $worksheet->region }}</span></p>
        <p class="text-left">Район: <span class="text-left">{{ $worksheet->area }}</span></p>
        <p class="text-left">Город (Населенный пункт): <span class="text-left">{{ $worksheet->city }}</span></p>
        <p class="text-left">Улица: <span class="text-left">{{ $worksheet->street }}</span></p>
        <p class="text-left">Дом: <span class="text-left">{{ $worksheet->house }}</span></p>
        <p class="text-left">Корпус: <span class="text-left">{{ $worksheet->housing }}</span></p>
        <p class="text-left">Квартира: <span class="text-left">{{ $worksheet->room }}</span></p>
        <p class="text-left">Адрес регистрации: <span class="text-left">{{ $worksheet->registration }}</span></p>
        <p class="text-left">Почтовый адрес: <span class="text-left">{{ $worksheet->post }}</span></p>
    </div>

    <div class="table-wrapper">
        <div class="table-title">
            <h3>Кредиторы</h3>
        </div>

        @if(count($worksheet->creditors))
            @foreach($worksheet->creditors as $creditor)
                <p>
                    Банк: <span class="text-left">{{ $creditor['bank'] }}</span>
                    Тип кредита: <span class="text-left">{{ $creditor['type'] }}</span>
                    Сумма кредита: <span class="text-left">{{ $creditor['total'] }}</span>
                    Текущая задолженность: <span class="text-left">{{ $creditor['current'] }}</span>
                    Ежемесячный платеж: <span class="text-left">{{ $creditor['monthly'] }}</span>
                    Просрочка (мес): <span class="text-left">{{ $creditor['delay'] }}</span>
                    Комментарий: <span class="text-left">{{ $creditor['comment'] }}</span>
                </p>
            @endforeach
        @else
            <p class="text-left">Нет данных</p>
        @endif
    </div>

    <div class="table-wrapper">
        <div class="table-title">
            <h3>Официальный доход</h3>
        </div>
        @if(count($worksheet->sources))
            @foreach($worksheet->sources as $item)
                <p>
                    Место работы: <span class="text-left">{{ $item['place'] }}</span>
                    Должность: <span class="text-left">{{ $item['position'] }}</span>
                    Официальный доход: <span class="text-left">{{ $item['legal'] }}</span>
                    Неофициальный доход: <span class="text-left">{{ $item['illegal'] }}</span>
                </p>
            @endforeach
        @else
            <p class="text-left">Нет данных</p>
        @endif

        <p class="text-left">Являетсь ли вы учредителем ООО/ИП?: <span class="text-left">
                    @if($worksheet->isIp === 1)
                    Да
                @else
                    Нет
                @endif
                </span></p>
        <p class="text-left">Комментарий к ООО/ИП: <span class="text-left">{{ $worksheet->oooComment}}</span></p>
        <p class="text-left">Являетесь ли Вы генеральным директором в ООО?: <span class="text-left">@if($worksheet->isDirector === 1)
                    Да
                @else
                    Нет
                @endif</span></p>
    </div>

    <div class="table-wrapper">
        <div class="table-title">
            <h3>Семейное положение</h3>
        </div>

        <p class="text-left">Семейное положение: <span class="text-left">
                    @if($worksheet->isMarried === 1)
                    Женат(Замужем)
                @else
                    Холост
                @endif
                </span></p>
        <p class="text-left">ФИО супруга(и): <span class="text-left">{{ $worksheet->spouse}}</span></p>
    </div>

    <div class="table-wrapper">
        <div class="table-title">
            <h3>Дети</h3>
        </div>
        @if(count($worksheet->children))
            @foreach($worksheet->children as $item)
                <p>
                    ФИО: <span class="text-left">{{ $item['name'] }}</span>
                    Дата рождения ребенка: <span
                        class="text-left">{{ \Carbon\Carbon::parse($item['birthday'])->format('d.m.Y') }}</span>
                    Возраст: <span class="text-left">{{ \Carbon\Carbon::parse($item['birthday'])->age }}</span>

                </p>
            @endforeach
        @else
            <p class="text-left">Нет данных</p>
        @endif
    </div>

    <div class="table-wrapper">
        <div class="table-title">
            <h3>Недвижимое имущество</h3>
        </div>
        @if(count($worksheet->immovable))
            @foreach($worksheet->immovable as $item)
                <p>
                    Вид иимущества (Недвижимое имущество):
                <td class="text-left">{{ $item['type'] }}</td>
                Вид собственности (Недвижимое имущество):
                <td class="text-left">{{ $item['ownership'] }}</td>
                Местонахождение (Недвижимое имущество):
                <td class="text-left">{{ $item['address'] }}</td>
                Площадь (Недвижимое имущество):
                <td class="text-left">{{ $item['area'] }}</td>
                Сведения о залоге (Недвижимое имущество):
                <td class="text-left">{{ $item['pledge'] }}</td>
                Основание приобретения (Недвижимое имущество):
                <td class="text-left">{{ $item['basis'] }}</td>
                Стоимость (Недвижимое имущество):
                <td class="text-left">{{ $item['cost'] }}</td>
                Дата приобретения (Недвижимое имущество):
                <td class="text-left">{{ \Carbon\Carbon::parse($item['date'])->format('d.m.Y') }}</td>

                </p>
            @endforeach
        @else
            <p class="text-left">Нет данных</p>
        @endif
    </div>

    <div class="table-wrapper">
        <div class="table-title">
            <h3>Движимое имущество</h3>
        </div>
        @if(count($worksheet->movable))
            @foreach($worksheet->movable as $item)
                <p>
                    Вид имущества (Движимое имущество): <span class="text-left">{{ $item['type'] }}</span>
                    Вид собственности (Движимое имущество): <span class="text-left">{{ $item['ownership'] }}</span>
                    Местонахождение (Движимое имущество): <span class="text-left">{{ $item['address'] }}</span>
                    Марка и модель (Движимое имущество): <span class="text-left">{{ $item['model'] }}</span>
                    VIN номер (Движимое имущество): <span class="text-left">{{ $item['vin'] }}</span>
                    Сведения о залоге (Движимое имущество): <span class="text-left">{{ $item['pledge'] }}</span>
                    Стоимость (Движимое имущество): <span class="text-left">{{ $item['cost'] }}</span>
                    Дата приобретения (Движимое имущество): <span
                        class="text-left">{{ \Carbon\Carbon::parse($item['date'])->format('d.m.Y') }}</span>

                </p>
            @endforeach
        @else
            <p class="text-left">Нет данных</p>
        @endif
    </div>

    <div class="table-wrapper">
        <div class="table-title">
            <h3>Недвижимое имущество супруга(и)</h3>
        </div>
        @if(count($worksheet->spousesImmovable))
            @foreach($worksheet->spousesImmovable as $item)
                <p>
                    Вид имущества (Недвижимое имущество супруга(и)): <span class="text-left">{{ $item['type'] }}</span>
                    Вид собственности (Недвижимое имущество супруга(и)): <span
                        class="text-left">{{ $item['ownership'] }}</span>
                    Местонахождение (Недвижимое имущество супруга(и)): <span
                        class="text-left">{{ $item['address'] }}</span>
                    Площадь (Недвижимое имущество супруга(и)): <span class="text-left">{{ $item['area'] }}</span>
                    Сведения о залоге (Недвижимое имущество супруга(и)): <span
                        class="text-left">{{ $item['pledge'] }}</span>
                    Основание приобретения (Недвижимое имущество супруга(и)): <span
                        class="text-left">{{ $item['basis'] }}</span>
                    Стоимость (Недвижимое имущество супруга(и)): <span class="text-left">{{ $item['cost'] }}</span>
                    Дата приобретения (Недвижимое имущество супруга(и)): <span
                        class="text-left">{{ \Carbon\Carbon::parse($item['date'])->format('d.m.Y') }}</span>

                </p>
            @endforeach
        @else
            <p class="text-left">Нет данных</p>
        @endif
    </div>

    <div class="table-wrapper">
        <div class="table-title">
            <h3>Движимое имущество супруга(и)</h3>
        </div>
        @if(count($worksheet->spousesMovable))
            @foreach($worksheet->spousesMovable as $item)
                <p>
                    Вид иимущества (Движимое имущество супруга(и)): <span class="text-left">{{ $item['type'] }}</span>
                    Вид собственности (Движимое имущество супруга(и)): <span
                        class="text-left">{{ $item['ownership'] }}</span>
                    Местонахождение (Движимое имущество супруга(и)): <span
                        class="text-left">{{ $item['address'] }}</span>
                    Марка и модель (Движимое имущество супруга(и)): <span class="text-left">{{ $item['model'] }}</span>
                    VIN номер (Движимое имущество супруга(и)): <span class="text-left">{{ $item['vin'] }}</span>
                    Сведения о залоге (Движимое имущество супруга(и)): <span
                        class="text-left">{{ $item['pledge'] }}</span>
                    Стоимость (Движимое имущество супруга(и)): <span class="text-left">{{ $item['cost'] }}</span>
                    Дата приобретения (Движимое имущество супруга(и)): <span
                        class="text-left">{{ \Carbon\Carbon::parse($item['date'])->format('d.m.Y') }}</span>

                </p>
            @endforeach
        @else
            <p class="text-left">Нет данных</p>
        @endif
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

        @if(count((array)$worksheet->voidableMovable))
            @foreach($worksheet->voidableMovable as $item)
                <p>
                    Объект (Оспоримые сделки по движимому имуществу): <span
                        class="text-left">{{ $item['object'] }}</span>
                    Дата сделки (Оспоримые сделки по движимому имуществу): <span
                        class="text-left">{{ \Carbon\Carbon::parse($item['date'])->format('d.m.Y') }}</span>
                    Дата приобретения (Оспоримые сделки по движимому имуществу): <span
                        class="text-left">{{ \Carbon\Carbon::parse($item['buyDate'])->format('d.m.Y') }}</span>
                    На что приобритен (Оспоримые сделки по движимому имуществу): <span
                        class="text-left">{{ $sources[$item['source']] }}</span>
                    Дата регистрации (Оспоримые сделки по движимому имуществу): <span
                        class="text-left">{{ \Carbon\Carbon::parse($item['registrationDate'])->format('d.m.Y') }}</span>
                </p>
            @endforeach
        @else
            <p class="text-left">Нет данных</p>
        @endif
    </div>


    <div class="table-wrapper">
        <div class="table-title">
            <h3>Оспоримые сделки по недвижимому имуществу</h3>
        </div>


        @if(count((array)$worksheet->voidableImmovable))
            @foreach($worksheet->voidableImmovable as $item)
                <p>
                    Объект (Оспоримые сделки по недвижимому имуществу): <span
                        class="text-left">{{ $item['object'] }}</span>
                    Дата сделки (Оспоримые сделки по недвижимому имуществу): <span
                        class="text-left">{{ \Carbon\Carbon::parse($item['date'])->format('d.m.Y') }}</span>
                    Дата приобретения (Оспоримые сделки по недвижимому имуществу): <span
                        class="text-left">{{ \Carbon\Carbon::parse($item['buyDate'])->format('d.m.Y') }}</span>
                    На что приобритен (Оспоримые сделки по недвижимому имуществу): <span
                        class="text-left">{{ $sources[$item['source']] }}</span>
                    Дата регистрации (Оспоримые сделки по недвижимому имуществу): <span
                        class="text-left">{{ \Carbon\Carbon::parse($item['registrationDate'])->format('d.m.Y') }}</span>
                </p>
            @endforeach
        @else
            <p colspan="7" class="text-left">Нет данных</p>
        @endif
    </div>

    <div class="table-wrapper">
        <div class="table-title">
            <h3>Данные по оплате</h3>
        </div>

        @if(count($worksheet->payment))
            @foreach($worksheet->payment as $item)
                <p>
                    Менеджер: <span class="text-left">
                        @foreach($users as $user)
                            @if($user->id == $item['manager'])
                                {{ $user->name }}
                            @endif
                        @endforeach
                    </span>
                    Бюджет: <span class="text-left">{{ $item['budget'] }}</span>
                    Ежемесячный платеж (внутренний): <span class="text-left">{{ $item['monthly'] }}</span>
                    Срок рассрочки (мес): <span class="text-left">{{ $item['installment'] }}</span>
                    Дата платежа рассрочки: <span
                        class="text-left">{{ \Carbon\Carbon::parse($item['paymentDate'])->format('d.m.Y') }}</span>
                    Онлайн продажа: <span class="text-left">
                            @if($item['online'] === 1)
                            Да
                        @else
                            Нет
                        @endif

                        </span>
                </p>
            @endforeach
        @else
            <p class="text-left">Нет данных</p>
        @endif
    </div>
</div>
</body>
</html>
