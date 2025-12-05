<?php

namespace Przelewy24\Enums;

enum TransactionFindRefundStatus: int
{
    case COMPLETED = 1;
    case PENDING = 2;
    case AWAITING_ACCEPTANCE = 3;
    case REJECTED = 4;
}
