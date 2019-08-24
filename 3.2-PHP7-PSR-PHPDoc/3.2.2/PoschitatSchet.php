<?php
/**
 * function for payment
 *
 * @param int $amount
 * @return float $send
 */
const NUMBER_OF_DECIMAL_PLACES = 2;
function payment(int $amount) {
    $send = number_format($amount * 0.10, NUMBER_OF_DECIMAL_PLACES);
    return $send;
}
/**
 * function for counting
 *
 * @param array $menu
 * @param array $post
 * @return string $purchase
 */
function poschitatSchet(array $menu, array $post)
{
    $accountNumber = random_int(1000, 9999);
    $purchase = "<div class=\"order322-line order322-title\">
                    Счёт №$accountNumber
              </div>";
    $amount = 0;
    foreach ($menu as $v) {
        $value = $post[$v->id];
        if ($value > 0) {
            $sum = $value * $v->price;
            $sumFormat = number_format($v->price * $value, NUMBER_OF_DECIMAL_PLACES);
            $cost = number_format($v->price, NUMBER_OF_DECIMAL_PLACES);
            $purchase .= "<div class=\"order322-line\">
                            <div>
                                $v->name
                            </div>
                            <div>
                                $value * $cost руб. = $sumFormat руб.
                            </div>
                        </div>";
            $amount += $sum;
        }
    }
    $service = (int)$post['service'];
    if ($amount > 0) {
        if ($service === 2) {
            $send = payment($amount);
            $purchase .= "<div class=\"order322-line\">
                            <div>
                                Скидка 10% (самовывоз)
                            </div>
                            <div>
                                - $send руб.
                            </div>
                        </div>";
            $amount = $amount - (float)$send;
        } elseif ($service === 4) {
            $send = payment($amount);
            $purchase .= "<div class=\"order322-line\">
                            <div>
                                Чаевые 10%
                            </div>
                            <div>
                                $send руб.
                            </div>
                        </div>";
            $amount = $amount + (float)$send;
        } elseif ($service === 1) {
            $send = payment($amount);
            $purchase .= "<div class=\"order322-line\">
                            <div>
                                Доставка
                            </div>
                            <div>
                                200.00 руб.
                            </div>
                        </div>";
            $amount = $amount + 200;
        }
    } else {
        $purchase .= "<div class=\"order322-line\">
                        Ничего не заказано
                    </div>";
    }
    $amount = number_format($amount, NUMBER_OF_DECIMAL_PLACES);
    $purchase .= "<div class=\"order322-total\">
                    <div>
                        Итого: $amount руб.
                    </div>
                </div>";
    return $purchase;
}