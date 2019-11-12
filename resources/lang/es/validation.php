<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'El campo :attribute debe ser aceptado. Verifique e intente nuevamente.',
    'active_url'           => 'El campo :attribute no es una URL válida. Verifique e intente nuevamente.',
    'after'                => 'El campo :attribute debe ser una fecha posterior a :date. Verifique e intente nuevamente.',
    'after_or_equal'       => 'El campo :attribute debe ser una fecha posterior o igual a :date. Verifique e intente nuevamente.',
    'alpha'                => 'El campo :attribute solo puede contener letras. Verifique e intente nuevamente.',
    'alpha_dash'           => 'El campo :attribute solo puede contener letras, números, guiones y guiones bajos. Verifique e intente nuevamente.',
    'alpha_num'            => 'El campo :attribute solo puede contener letras y números. Verifique e intente nuevamente.',
    'array'                => 'El campo :attribute debe ser un array. Verifique e intente nuevamente.',
    'before'               => 'El campo :attribute debe ser una fecha anterior a :date. Verifique e intente nuevamente.',
    'before_or_equal'      => 'El campo :attribute debe ser una fecha anterior o igual a :date. Verifique e intente nuevamente.',
    'between'              => [
        'numeric' => 'El campo :attribute debe ser un valor entre :min y :max. Verifique e intente nuevamente.',
        'file'    => 'El archivo :attribute debe pesar entre :min y :max kilobytes. Verifique e intente nuevamente.',
        'string'  => 'El campo :attribute debe contener entre :min y :max caracteres. Verifique e intente nuevamente.',
        'array'   => 'El campo :attribute debe contener entre :min y :max elementos . Verifique e intente nuevamente.',
    ],
    'boolean'              => 'El campo :attribute debe ser verdadero o falso. Verifique e intente nuevamente.',
    'confirmed'            => 'El campo confirmación de :attribute no coincide. Verifique e intente nuevamente.',
    'date'                 => 'El campo :attribute no corresponde con una fecha válida. Verifique e intente nuevamente.',
    'date_equals'          => 'El campo :attribute debe ser una fecha igual a :date. Verifique e intente nuevamente.',
    'date_format'          => 'El campo :attribute no corresponde con el formato de fecha :format. Verifique e intente nuevamente.',
    'different'            => 'Los campos :attribute y :other deben ser diferentes. Verifique e intente nuevamente.',
    'digits'               => 'El campo :attribute debe ser un número de :digits dígitos. Verifique e intente nuevamente.',
    'digits_between'       => 'El campo :attribute debe contener entre :min y :max dígitos. Verifique e intente nuevamente.',
    'dimensions'           => 'El campo :attribute tiene dimensiones de imagen inválidas. Verifique e intente nuevamente.',
    'distinct'             => 'El campo :attribute tiene un valor duplicado. Verifique e intente nuevamente.',
    'email'                => 'El campo :attribute debe ser una dirección de correo válida. Verifique e intente nuevamente.',
    'exists'               => 'El campo :attribute seleccionado no existe. Verifique e intente nuevamente.',
    'file'                 => 'El campo :attribute debe ser un archivo. Verifique e intente nuevamente.',
    'filled'               => 'El campo :attribute debe tener un valor. Verifique e intente nuevamente.',
    'gt'                   => [
        'numeric' => 'El campo :attribute debe ser mayor a :value. Verifique e intente nuevamente.',
        'file'    => 'El archivo :attribute debe pesar más de :value kilobytes. Verifique e intente nuevamente.',
        'string'  => 'El campo :attribute debe contener más de :value caracteres. Verifique e intente nuevamente.',
        'array'   => 'El campo :attribute debe contener más de :value elementos. Verifique e intente nuevamente.',
    ],
    'gte'                  => [
        'numeric' => 'El campo :attribute debe ser mayor o igual a :value. Verifique e intente nuevamente.',
        'file'    => 'El archivo :attribute debe pesar :value o más kilobytes. Verifique e intente nuevamente.',
        'string'  => 'El campo :attribute debe contener :value o más caracteres. Verifique e intente nuevamente.',
        'array'   => 'El campo :attribute debe contener :value o más elementos. Verifique e intente nuevamente.',
    ],
    'image'                => 'El campo :attribute debe ser una imagen. Verifique e intente nuevamente.',
    'in'                   => 'El campo :attribute es inválido. Verifique e intente nuevamente.',
    'in_array'             => 'El campo :attribute no existe en :other . Verifique e intente nuevamente.',
    'integer'              => 'El campo :attribute debe ser un número entero. Verifique e intente nuevamente.',
    'ip'                   => 'El campo :attribute debe ser una dirección IP válida. Verifique e intente nuevamente.',
    'ipv4'                 => 'El campo :attribute debe ser una dirección IPv4 válida. Verifique e intente nuevamente.',
    'ipv6'                 => 'El campo :attribute debe ser una dirección IPv6 válida. Verifique e intente nuevamente.',
    'json'                 => 'El campo :attribute debe ser una cadena de texto JSON válida. Verifique e intente nuevamente.',
    'lt'                   => [
        'numeric' => 'El campo :attribute debe ser menor a :value. Verifique e intente nuevamente.',
        'file'    => 'El archivo :attribute debe pesar menos de :value kilobytes. Verifique e intente nuevamente.',
        'string'  => 'El campo :attribute debe contener menos de :value caracteres. Verifique e intente nuevamente.',
        'array'   => 'El campo :attribute debe contener menos de :value elementos. Verifique e intente nuevamente.',
    ],
    'lte'                  => [
        'numeric' => 'El campo :attribute debe ser menor o igual a :value. Verifique e intente nuevamente.',
        'file'    => 'El archivo :attribute debe pesar :value o menos kilobytes. Verifique e intente nuevamente.',
        'string'  => 'El campo :attribute debe contener :value o menos caracteres. Verifique e intente nuevamente.',
        'array'   => 'El campo :attribute debe contener :value o menos elementos. Verifique e intente nuevamente.',
    ],
    'max'                  => [
        'numeric' => 'El campo :attribute no debe ser mayor a :max. Verifique e intente nuevamente.',
        'file'    => 'El archivo :attribute no debe pesar más de :max kilobytes. Verifique e intente nuevamente.',
        'string'  => 'El campo :attribute no debe contener más de :max caracteres. Verifique e intente nuevamente.',
        'array'   => 'El campo :attribute no debe contener más de :max elementos. Verifique e intente nuevamente.',
    ],
    'mimes'                => 'El campo :attribute debe ser un archivo de tipo: :values. Verifique e intente nuevamente.',
    'mimetypes'            => 'El campo :attribute debe ser un archivo de tipo: :values. Verifique e intente nuevamente.',
    'min'                  => [
        'numeric' => 'El campo :attribute debe ser al menos :min. Verifique e intente nuevamente.',
        'file'    => 'El archivo :attribute debe pesar al menos :min kilobytes. Verifique e intente nuevamente.',
        'string'  => 'El campo :attribute debe contener al menos :min caracteres. Verifique e intente nuevamente.',
        'array'   => 'El campo :attribute debe contener al menos :min elementos. Verifique e intente nuevamente.',
    ],
    'not_in'               => 'El campo :attribute seleccionado es inválido. Verifique e intente nuevamente.',
    'not_regex'            => 'El formato del campo :attribute es inválido. Verifique e intente nuevamente.',
	'numeric'              => 'El campo :attribute debe ser un número. Verifique e intente nuevamente.',
    'present'              => 'El campo :attribute debe estar presente. Verifique e intente nuevamente.',
    'regex'                => 'El formato del campo :attribute es inválido. Verifique e intente nuevamente.',
    'required'             => 'El campo :attribute es obligatorio. Verifique e intente nuevamente.',
    'required_if'          => 'El campo :attribute es obligatorio cuando el campo :other es :value. Verifique e intente nuevamente.',
    'required_unless'      => 'El campo :attribute es requerido a menos que :other se encuentre en :values. Verifique e intente nuevamente.',
    'required_with'        => 'El campo :attribute es obligatorio cuando :values está presente. Verifique e intente nuevamente.',
    'required_with_all'    => 'El campo :attribute es obligatorio cuando :values están presentes. Verifique e intente nuevamente.',
    'required_without'     => 'El campo :attribute es obligatorio cuando :values no está presente. Verifique e intente nuevamente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de los campos :values están presentes. Verifique e intente nuevamente.',
    'same'                 => 'Los campos :attribute y :other deben coincidir. Verifique e intente nuevamente.',
    'size'                 => [
        //'numeric' => 'El campo :attribute debe ser :size. Verifique e intente nuevamente.',
        'string'    => 'El archivo :attribute debe pesar :size kilobytes. Verifique e intente nuevamente.',
        //'string'  => 'El campo :attribute debe contener :size caracteres. Verifique e intente nuevamente.',
        //'array'   => 'El campo :attribute debe contener :size elementos. Verifique e intente nuevamente.',
    ],
    'starts_with'          => 'El campo :attribute debe comenzar con uno de los siguientes valores: :values. Verifique e intente nuevamente.',
    'string'               => 'El campo :attribute debe ser una cadena de caracteres. Verifique e intente nuevamente.',
    'timezone'             => 'El campo :attribute debe ser una zona horaria válida. Verifique e intente nuevamente.',
    'unique'               => 'El valor del campo :attribute ya está en uso. Verifique e intente nuevamente.',
    'uploaded'             => 'El campo :attribute no se pudo subir es demaciado grande.Verifique e intente nuevamente.',
    'url'                  => 'El formato del campo :attribute es inválido. Verifique e intente nuevamente.',
    'uuid'                 => 'El campo :attribute debe ser un UUID válido. Verifique e intente nuevamente.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
