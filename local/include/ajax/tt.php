<?php

var_dump(ini_get('safe_mode'));
var_dump(ini_get('max_execution_time'));

set_time_limit (5);
sleep(10);
var_dump(ini_get('max_execution_time'));
