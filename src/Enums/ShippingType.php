<?php

namespace Przelewy24\Enums;

enum ShippingType: int
{
    case COURIER = 0;
    case PICKUP_POINT = 1;
    case PARCEL_LOCKER = 2;
    case STORE_DELIVERY = 3;
}
