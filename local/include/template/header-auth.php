<!--<?
global $OptimalGroup;
if ($OptimalGroup['DOMAIN'] == "vladimir" && $OptimalGroup['SITE']['CODE'] == "home"):?>
<div class="header-auth">
    <a href="http://study.vladcomsys.ru/" class="btn btn-auth block" target="_blank">Личный кабинет</a>
</div>
<? elseif ($OptimalGroup['DOMAIN'] == "vladimir" && $OptimalGroup['SITE']['CODE'] == "business"): ?>
<? elseif ($OptimalGroup['DOMAIN'] == "samara" && $OptimalGroup['SITE']['CODE'] == "home"): ?>
<div class="header-auth">
    <a href="//lk.kvp24.ru/login" class="btn btn-auth block" target="_blank">Личный кабинет</a>
</div>
<? elseif ($OptimalGroup['GROUP'] == "all"): ?>
<div class="header-auth">
    <? if ($USER->IsAuthorized()): ?>
    <a href="?logout=yes" class="btn btn-auth block">Выйти (<?= $USER->GetLogin() ?>)</a>
    <? else:
    $formClass = "is-selected-0";
    $userType = "fiz";
    $isOren = false;
    if ($OptimalGroup['SITE']['CODE'] == "business") {
        $formClass = "is-selected-1";
        $userType = "yur";
    }
    if ($OptimalGroup['DOMAIN'] == "oren") {
        $isOren = true;
        $formClass .= " hide-yr-lk";
    }
    ?>
    <a href="#" class="btn btn-auth block js-AuthForm">Личный кабинет</a>
    <div class="header-auth--hide-btn-shadow"></div>
    <? if ($isOren && false == true): ?>
    <? $APPLICATION->IncludeComponent(
    "optimalgroup:lkk",
    "auth",
    [
        'REDIRECT_URL' => 'https://lk.esplus.ru/Account/Authentication?login=#LOGIN#&password=#PASSWORD#',
        'CLASS' => $formClass,//TEMP UNTILL MAKE THIS COMPONENT FOR ALL BRANCHIES
        'SITE_TYPE' => $OptimalGroup['SITE']['CODE'],
        'BRANCH' => $OptimalGroup['BRANCH'],
        "FORM_NAME" => "headerAuth",
        'AJAX_MODE' => 'Y',
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "AJAX_OPTION_HISTORY" => "N",
    ],
    false
); ?>
    <? else: ?>
    <div class="header-auth--form none <?= $formClass; ?>">
        <form name="" action="" method="POST" data-apiurl="<?= $OptimalGroup['BRANCH']['API_URL'] ?: 'https://lkk-ekb.esplus.ru' ?>" id="authForm" novalidate>
            <input type="hidden" name="AUTH_FORM" value="Y" />
            <input type="hidden" name="TYPE" value="AUTH" />
            <?= bitrix_sessid_post() ?>
            <div class="one-radio js-OneRadio" data-toggle-class=".header-auth--form">
                <label data-value="fiz"<? if ($OptimalGroup['SITE']['CODE'] == "home"): ?> class="is-selected"<? endif; ?>><i></i>Для дома</label>
                <label data-value="yur"<? if ($OptimalGroup['SITE']['CODE'] == "business"): ?> class="is-selected"<? endif; ?>><i></i>Для бизнеса</label>
                <input type="hidden" name="USER_TYPE" value="<?= $userType; ?>">
                <span<? if ($OptimalGroup['SITE']['CODE'] == "business"): ?> class="is-selected-1"<? endif; ?>></span>
            </div>
            <div class="header-auth--fields">
                <div class="form-group text-left is-fiz">
                    <label class="form-label mb-10">Номер лицевого счета или e-mail</label>
                    <input type="text" name="login" placeholder="Лицевой счет или e-mail" class="form-control" required>
                </div>
                <div class="form-group text-left is-yur">
                    <label class="form-label mb-10">Ваш e-mail (логин)</label>
                    <input type="text" name="login-yur" placeholder="Ваш e-mail (логин)" class="form-control" required>
                </div>
                <div class="form-group">
                    <div class="clearfix mb-10">
                        <label class="form-label pull-left">Пароль</label>
                        <div class="pull-right">
                            <a href="<?= $OptimalGroup['BRANCH']['FORGET_PASSWORD']; ?>" class="dashed is-fiz" target="_blank">Забыли пароль ?</a>
                            <a href="<?= $OptimalGroup['BRANCH']['FORGET_PASSWORD_LEGAL']; ?>" class="dashed is-yur" target="_blank">Забыли пароль ?</a>
                        </div>
                    </div>
                    <div class="form-control--container">
                        <a class="password-show fa-eye-slash fa js-PasswordText"></a>
                        <input type="password" name="pass" placeholder="Пароль" class="form-control" required>
                    </div>
                </div>
                <div class="btn-action text-center">
                    <p><button class="btn btn-grey w-170" type="submit" name="Login" value="Y"><span class="fa-angle-btn">Войти</span></button></p>
                    <a href="/registration/" class="dashed  header-auth--home">Зарегистрироваться</a>
                    <a href="/business/service/pc/" class="dashed  header-auth--business">Зарегистрироваться</a>
                </div>
            </div>
        </form>
        <? if ($isOren): ?>
        <div class="none auth-warning text-left">
            Уважаемые клиенты!<br>
            В связи с проведением технических работ Личный кабинет ОАО «ЭнергосбыТ Плюс» для юридических лиц недоступен.<br>
            Приносим извинения за доставленные неудобства.
        </div>        
        <? endif; ?>
    </div>
    <? endif; //IsOren;
    ?>
    <? endif ?>
</div>
<? endif; ?>-->
<?
global $OptimalGroup;
if ($OptimalGroup['DOMAIN'] == "vladimir" && $OptimalGroup['SITE']['CODE'] == "home"):?>
    <div class="header-auth">
        <a href="http://study.vladcomsys.ru/" class="btn btn-auth block" target="_blank">Личный кабинет</a>
    </div>
<? elseif ($OptimalGroup['DOMAIN'] == "vladimir" && $OptimalGroup['SITE']['CODE'] == "business"): ?>
<? elseif ($OptimalGroup['DOMAIN'] == "samara" && $OptimalGroup['SITE']['CODE'] == "home"): ?>
<? elseif ($OptimalGroup['GROUP'] == "all"): ?>
    <div class="header-auth">
        <? if ($USER->IsAuthorized()): ?>
            <a href="?logout=yes" class="btn btn-auth block">Выйти (<?= $USER->GetLogin() ?>)</a>
        <? else:
            $formClass = "is-selected-0";
            $userType = "fiz";
            $isOren = false;


            if ($OptimalGroup['SITE']['CODE'] == "business") {
                $formClass = "is-selected-1";
                $userType = "yur";
            }
            if ($OptimalGroup['DOMAIN'] == "oren") {
                $isOren = true;
                $formClass .= " hide-yr-lk";
            }


            ?>
            <a href="#" class="btn btn-auth block js-AuthForm">Личный кабинет</a>
            <div class="header-auth--hide-btn-shadow"></div>
            <? if ($isOren && false == true): ?>
            <? $APPLICATION->IncludeComponent(
                "optimalgroup:lkk",
                "auth",
                [
                    'REDIRECT_URL' => 'https://lk.esplus.ru/Account/Authentication?login=#LOGIN#&password=#PASSWORD#',
                    'CLASS' => $formClass,//TEMP UNTILL MAKE THIS COMPONENT FOR ALL BRANCHIES
                    'SITE_TYPE' => $OptimalGroup['SITE']['CODE'],
                    'BRANCH' => $OptimalGroup['BRANCH'],
                    "FORM_NAME" => "headerAuth",
                    'AJAX_MODE' => 'Y',
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "N",
                    "AJAX_OPTION_HISTORY" => "N",
                ],
                false
            ); ?>

        <? else: ?>
            <div class="header-auth--form none <?= $formClass; ?>">
                <form name="" action="" method="POST"
                      data-apiurl="<?= $OptimalGroup['BRANCH']['API_URL'] ?: 'https://lkk-ekb.esplus.ru' ?>"
                      id="authForm" novalidate>
                    <input type="hidden" name="AUTH_FORM" value="Y"/>
                    <input type="hidden" name="TYPE" value="AUTH"/>
                    <?= bitrix_sessid_post() ?>
                    <div class="one-radio js-OneRadio" data-toggle-class=".header-auth--form">
                        <label data-value="fiz"<? if ($OptimalGroup['SITE']['CODE'] == "home"): ?> class="is-selected"<? endif; ?>><i></i>Для
                            дома</label>
                        <label data-value="yur"<? if ($OptimalGroup['SITE']['CODE'] == "business"): ?> class="is-selected"<? endif; ?>><i></i>Для
                            бизнеса</label>
                        <input type="hidden" name="USER_TYPE" value="<?= $userType; ?>">
                        <span<? if ($OptimalGroup['SITE']['CODE'] == "business"): ?> class="is-selected-1"<? endif; ?>></span>
                    </div>
                    <div class="header-auth--fields">
                        <div class="form-group text-left is-fiz">
                            <label class="form-label mb-10">Номер лицевого счета или e-mail</label>
                            <input type="text" name="login" placeholder="Лицевой счет или e-mail" class="form-control"
                                   required>
                        </div>
                        <div class="form-group text-left is-yur">
                            <label class="form-label mb-10">Ваш e-mail (логин)</label>
                            <input type="text" name="login-yur" placeholder="Ваш e-mail (логин)" class="form-control"
                                   required>
                        </div>
                        <div class="form-group">
                            <div class="clearfix mb-10">
                                <label class="form-label pull-left">Пароль</label>
                                <div class="pull-right">
                                    <a href="<?= $OptimalGroup['BRANCH']['FORGET_PASSWORD']; ?>" class="dashed is-fiz"
                                       target="_blank">Забыли пароль ?</a>
                                    <a href="<?= $OptimalGroup['BRANCH']['FORGET_PASSWORD_LEGAL']; ?>"
                                       class="dashed is-yur" target="_blank">Забыли пароль ?</a>
                                </div>
                            </div>
                            <div class="form-control--container">
                                <a class="password-show fa-eye-slash fa js-PasswordText"></a>
                                <input type="password" name="pass" placeholder="Пароль" class="form-control" required>
                            </div>
                        </div>
                        <div class="btn-action text-center">
                            <p>
                                <button class="btn btn-grey w-170" type="submit" name="Login" value="Y"><span
                                            class="fa-angle-btn">Войти</span></button>
                            </p>
                            <a href="/registration/" class="dashed  header-auth--home">Зарегистрироваться</a>
                            <a href="/business/service/pc/" class="dashed  header-auth--business">Зарегистрироваться</a>
                        </div>
                    </div>
                </form>
                <? if ($isOren): ?>
                    <div class="none auth-warning text-left">
                        Уважаемые клиенты!<br>
                        Личный кабинет для юридических лиц находится в разработке. Узнать подробнее о других сервисах
                        можно <a href="/business/service/doc/ ">здесь</a>.
                    </div>
                <? endif; ?>
            </div>
        <? endif; //IsOren;
            ?>
        <? endif ?>
    </div>
<? endif; ?>
<? if ($OptimalGroup['DOMAIN'] == 'samara') { ?>
    <script src="/local/media/js/k24-scala-js-opt.js"></script>
<?}?>
<?
global $OptimalGroup;
if (in_array($OptimalGroup['DOMAIN'], array('perm', 'chuvashia', 'saratov', 'samara'))):?>
    <div class="header-auth">
        <? if ($USER->IsAuthorized()): ?>
            <a href="?logout=yes" class="btn btn-auth block">Выйти (<?= $USER->GetLogin() ?>)</a>
        <? else:
            $formClass = "is-selected-0";
            $userType = "fiz";
            $isChuvashia = false;

            if ($OptimalGroup['SITE']['CODE'] == "business") {
                $formClass = "is-selected-1";
                $userType = "yur";
            }
            if ($OptimalGroup['DOMAIN'] == "chuvashia") {
                $isChuvashia = true;
                $formClass .= " hide-yr-lk";
            }
            if ($OptimalGroup['DOMAIN'] == "saratov") {
                $isSaratov = true;
                $formClass .= " hide-yr-lk";
            }
            if ($OptimalGroup['DOMAIN'] == "perm") {
                $isPerm = true;
                $formClass .= " hide-fiz-lk";
            }
            if ($OptimalGroup['DOMAIN'] == "samara") {
                $isSamara = true;
                $formClass .= " hide-yr-lk";
            }

            ?>
            <a href="#" class="btn btn-auth block js-AuthForm">Личный кабинет</a>
            <div class="header-auth--hide-btn-shadow"></div>
            <? if ($isChuvashia && false == true): ?>
            <? $APPLICATION->IncludeComponent(
                "optimalgroup:lkk",
                "auth",
                [
                    'REDIRECT_URL' => 'https://lk.esplus.ru/Account/Authentication?login=#LOGIN#&password=#PASSWORD#',
                    'CLASS' => $formClass,//TEMP UNTILL MAKE THIS COMPONENT FOR ALL BRANCHIES
                    'SITE_TYPE' => $OptimalGroup['SITE']['CODE'],
                    'BRANCH' => $OptimalGroup['BRANCH'],
                    "FORM_NAME" => "headerAuth",
                    'AJAX_MODE' => 'Y',
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "N",
                    "AJAX_OPTION_HISTORY" => "N",
                ],
                false
            ); ?>
        <? else: ?>
            <div class="header-auth--form none <?= $formClass; ?>">
                <form name=""
                      action=""
                      method="POST"
                      data-apiurl="<?= $OptimalGroup['BRANCH']['API_URL'] ?: 'https://lkk-ekb.esplus.ru' ?>"
                      id="<?= ($OptimalGroup['DOMAIN'] == 'samara') ? 'authFormLk': 'authForm'?>"
                      <?= ($OptimalGroup['DOMAIN'] == 'samara') ? 'class="validate-lk"': ''?>
                      novalidate>
                    <input type="hidden" name="AUTH_FORM" value="Y"/>
                    <input type="hidden" name="TYPE" value="AUTH"/>
                    <?= bitrix_sessid_post() ?>
                    <div class="one-radio js-OneRadio" data-toggle-class=".header-auth--form">
                        <label data-value="fiz"<? if ($OptimalGroup['SITE']['CODE'] == "home"): ?> class="is-selected"<? endif; ?>><i></i>Для
                            дома</label>
                        <? if ($OptimalGroup['SITE']['CODE'] == "business" && (in_array($OptimalGroup['DOMAIN'], array('saratov', 'oren', 'chuvashia', 'perm', 'samara')))) { ?>
                            <label data-value="yur" class="is-selected"><i></i>Для бизнеса</label>
                        <? } ?>
                        <? if ($OptimalGroup['SITE']['CODE'] == "home" && (in_array($OptimalGroup['DOMAIN'], array('chuvashia', 'saratov', 'perm', 'samara')))) { ?>
                            <label data-value="yur"><i></i>Для бизнеса</label>
                        <? } ?>
                        <input type="hidden" name="USER_TYPE" value="<?= $userType; ?>">
                        <span<? if ($OptimalGroup['SITE']['CODE'] == "business"): ?> class="is-selected-1"<? endif; ?>></span>
                    </div>
                    <div class="header-auth--fields">
                        <div class="form-group text-left is-fiz">
                            <label class="form-label mb-10">
                                <? if($OptimalGroup['DOMAIN'] == 'samara') { ?>
                                    После проверки номера лицевого счета (указан в квитанции) откроется страница входа в Ваш Личный кабинет
                                <? } else { ?>
                                    Номер лицевого счета или e-mail
                                <? } ?>
                            </label>
                            <input type="text" name="login" placeholder="<?= ($OptimalGroup['DOMAIN'] == 'samara') ? "Лицевой счет" : "Лицевой счет или e-mail" ?>" class="form-control"
                                   required>
                        </div>
                        <div class="form-group text-left is-yur">
                            <label class="form-label mb-10">Ваш e-mail (логин)</label>
                            <input type="text" name="login-yur" placeholder="Ваш e-mail (логин)" class="form-control"
                                   required>
                        </div>
                        <? if ($OptimalGroup['DOMAIN'] != 'samara') { ?>
                        <div class="form-group">
                            <div class="clearfix mb-10">
                                <label class="form-label pull-left">Пароль</label>
                                <div class="pull-right">
                                    <a href="<?= $OptimalGroup['BRANCH']['FORGET_PASSWORD']; ?>" class="dashed is-fiz"
                                       target="_blank">Забыли пароль ?</a>
                                    <a href="<?= ($OptimalGroup['DOMAIN'] == 'perm') ? $OptimalGroup['BRANCH']['FORGET_PASSWORD'] : $OptimalGroup['BRANCH']['FORGET_PASSWORD_LEGAL']; ?>"
                                       class="dashed is-yur" target="_blank">Забыли пароль ?</a>
                                </div>
                            </div>
                            <div class="form-control--container">
                                <a class="password-show fa-eye-slash fa js-PasswordText"></a>
                                <input type="password" name="pass" placeholder="Пароль" class="form-control" required>
                            </div>
                        </div>
                        <?}?>
                        <div class="btn-action text-center">
                            <p>
                                <button class="btn btn-grey w-170" type="submit" name="Login" value="Y"><span
                                            class="fa-angle-btn">Войти</span></button>
                            </p>
                            <? if ($OptimalGroup['DOMAIN'] != 'samara') { ?>
                            <a href="/registration/" class="dashed  header-auth--home">Зарегистрироваться</a>
                            <a href="/business/service/pc/<?=($OptimalGroup['DOMAIN'] =='perm')?'#no-cabinet':''?>" class="dashed  header-auth--business">Зарегистрироваться</a>
                            <?}?>
                        </div>
                    </div>
                </form>
                <? if ($isPerm): ?>
                    <div class="none auth-warning text-left">
                        Уважаемые клиенты!<br>
                        Для исполнения сбытовых функций по работе с физическими лицами на территории Пермского края АО
                        «ЭнергосбыТ Плюс» сотрудничает с ОАО «КРЦ-Прикамье», ПАО «Пермэнергосбыт», АО «ВЦ Инкомус».
                        Подробнее о доступных онлайн сервисах партнеров Вы можете узнать на их официальных сайтах.
                    </div>
                <? endif; ?>
                <? if ($isSaratov || $isChuvashia): ?>
                    <div class="none auth-warning text-left">
                        Уважаемые клиенты!<br>
                        Личный кабинет для юридических лиц находится в разработке. Узнать подробнее о других сервисах
                        можно <a href="/business/service/doc/ ">здесь</a>.
                    </div>
                <? endif; ?>
                <? if ($isSamara): ?>
                    <div class="none auth-warning text-left">
                        Уважаемые клиенты!<br>
                        Личный кабинет для юридических лиц находится в разработке. Узнать подробнее о других сервисах можно
                        <a href="/business/service/doc/ ">здесь</a>.
                    </div>
                <? endif; ?>
            </div>
        <? endif; //IsChuvashia;
            ?>
        <? endif; ?>
    </div>
<? endif; ?>






