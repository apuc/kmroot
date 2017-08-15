<?php
namespace Kinomania\System\Data;

/**
 * Class Company
 * @package Kinomania\System\Data
 */
class Company
{
    // ENUM field `type` in `company` table.
    const TYPE = [
        'Кастинг-агентство',
        'Фонд',
        'Производство',
        'Прокат',
        'Телеканал',
        'Сеть кинотеатров',
    ];

    // ENUM field `type` in `film_company_rel` table.
    const CONCERN = [
        'Производство',
        'Прокат',
        'По заказу',
        'При поддержке',
        'При участии',
        'Совместно с',
        'Телеканал',
    ];
}