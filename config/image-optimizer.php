<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Optimizers
    |--------------------------------------------------------------------------
    |
    | This option controls the image optimizers used by the package. You can
    | enable or disable specific optimizers and customize their options.
    | By default, a selection of optimizers is provided for your use.
    |
    */

    'optimizers' => [
        \Spatie\ImageOptimizer\Optimizers\Jpegoptim::class => [
            '--all-progressive',
            '--strip-all',
            '--max=80',
        ],
        \Spatie\ImageOptimizer\Optimizers\Pngquant::class => [
            '--force',
        ],
        \Spatie\ImageOptimizer\Optimizers\Svgo::class => [
            '--disable=cleanupIDs',
        ],
        \Spatie\ImageOptimizer\Optimizers\Gifsicle::class => [
            '--optimize',
        ],
        \Spatie\ImageOptimizer\Optimizers\Optipng::class => [
            '-i0',
            '-o2',
            '-quiet',
        ],
        \Spatie\ImageOptimizer\Optimizers\Avif::class => [
            '--speed=3',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Path to Binaries
    |--------------------------------------------------------------------------
    |
    | This option allows you to specify the paths to the various binaries used
    | by the optimizers. If a binary's path is null, the package will try
    | to locate the binary automatically. You can also provide the full
    | path to the binary if it's not located in the system's PATH.
    |
    */

    'path' => [
        'jpegoptim' => null,
        'jpegtran' => null,
        'gifsicle' => null,
        'pngquant' => null,
        'optipng' => null,
        'advpng' => null,
        'svgo' => null,
        'avif' => null,
    ],

];
