<?php

declare(strict_types=1);

namespace App\Model\Recruitis\Enum;

enum ResponseCode: string
{
    case OK = 'api.ok';

    case CREATED = 'api.created';

    case FOUND = 'api.found';

    case NOT_FOUND = 'api.error.not_found';

    case ERROR_UNAUTHORIZED = 'api.error.unauthorized';

    case ERROR_FIELD_VALIDATION = 'api.error.request.property.wrong_value';

    case API_UNAVAILABLE = 'api.error.system.unavailable';
}
