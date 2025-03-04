<?php

namespace App\Enums;

enum ContributionStatusEnum: string
{
    case PAID = 'pago';
    case PENDING = 'pendente';
    case LATE = 'atrasado';
    case CANCELED = 'cancelada';
}
