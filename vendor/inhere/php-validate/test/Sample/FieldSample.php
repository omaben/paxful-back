<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2019-01-10
 * Time: 23:59
 */

namespace Inhere\ValidateTest\Sample;

use Inhere\Validate\FieldValidation;

/**
 * Class FieldSample
 *
 * @package Inhere\ValidateTest\Sample
 */
class FieldSample extends FieldValidation
{
    public function rules(): array
    {
        return [
            ['user', 'required|string:1,12'],
            ['pwd', 'required|string:6,16'],
            ['code', 'lengthEq:4'],
        ];
    }

    public function scenarios(): array
    {
        return [
            'create' => ['user', 'pwd', 'code'],
            'update' => ['user', 'pwd'],
        ];
    }
}
