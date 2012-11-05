<?php
class CurrencyRendererHelper extends AppHelper {
    public function usd($amount) {
        return 'USD ' . number_format($amount, 2, '.', ',');
    }
}
?>
