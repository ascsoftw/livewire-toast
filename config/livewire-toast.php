<?php

return [
    //You can specify 1 of the following 4 types:
    //success, warning, info, error
    'type' => 'success', //default is success
    //You can specify 1 of the following 4 positions:
    //bottom-right, bottom-left, top-right, top-left
    'position' => 'bottom-right', //default is bottom-right
    //duration in ms for which the Toast is visible. Specify 0 if you do not want to hide it.
    'duration' => 3000, //default is 3000
    //Whether to show icon next to message.
    'show_icon' => true, //default is true
    //Whether to hide message on click.
    'hide_on_click' => true, //default is true
    //Background Color used by TailwindCss for various types.
    'color' => [
        'bg' => [
            'success' => 'green',
            'warning' => 'yellow',
            'info' => 'blue',
            'error' => 'red',
        ]
    ],
    //Text Color used by TailwindCss class. If using color other than white or black, provide full color like red-300.
    'text_color' => 'white', //default is white
    //Whether to use Transition
    'transition' => true,  //default is true
    //Following transitions are supported:
    //appear_from_below, appear_from_above, appear_from_left, appear_from_right, zoom_in, rotate
    'transition_type' => 'appear_from_above' //appear_from_above is default
];
