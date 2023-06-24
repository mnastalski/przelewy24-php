<?php

namespace Przelewy24\Enums;

enum TransactionChannel: int
{
    case CARDS = 1;
    case TRANSFERS = 2;
    case TRADITIONAL_TRANSFER = 4;
    case ALL_24_7 = 16;
    case PREPAYMENT = 32;
    case PAY_BY_LINK = 64;
    case INSTALLMENTS = 128;
    case WALLETS = 256;
    case CARDS_ONLY = 4096;
}
