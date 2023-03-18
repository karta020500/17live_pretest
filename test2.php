<?php
// 題目: PHP 當中的 interface 和 abstract ，分別適合於什麼時機使用。請描述對於這兩個保留字的看法。

// 在 PHP 中，interface 和 abstract 關鍵字分別用於定義接口和抽象類別，它們都可以用來實現多態性和抽象化，但它們的使用場景和實現方式有所不同。

// 1. interface
// interface可以定義抽象方法讓具體的類別來實作，可以想像是為實體類別加上規則，有實作這個interface的類別一定要實作interface定義的方法，一個類別可以實作很多規則(interface)。
//例如處理金流時，可能需要實作多個不同的付款方式，例如信用卡付款、銀行轉帳、PayPal 等。這時候，我們可以使用 interface 定義出付款方式應該要具備的方法，例如付款、退款等，並且讓每一個付款方式的類別去實作這個interface。

// 例如，我們可以定義一個名為 PaymentInterface 的 interface：
interface PaymentInterface
{
    public function pay($amount);
    public function refund($amount);
}

// 接著，我們可以建立不同的付款方式類別，例如 CreditCardPayment 和 BankTransferPayment，讓它們去實作 PaymentInterface 中的方法。
class CreditCardPayment implements PaymentInterface
{
    public function pay($amount)
    {
        // 實作信用卡付款的邏輯
    }

    public function refund($amount)
    {
        // 實作信用卡退款的邏輯
    }
}

class BankTransferPayment implements PaymentInterface
{
    public function pay($amount)
    {
        // 實作銀行轉帳付款的邏輯
    }

    public function refund($amount)
    {
        // 實作銀行轉帳退款的邏輯
    }
}
// 這樣當系統需要新增其他的付款方式時，只需要再新增一個類別，並且讓它實作 PaymentInterface 的方法即可。


// 2. abstract
// abstract也是可以定義抽象法放讓具體類別實作，不過抽象類別可以實作自己的方法。另外，因為abstract是用繼承(extends)的方式，所以一個類別只能繼承一個父類別，但是可以實作自己的方法這個特性讓我們可以定義一些繼承類別共同的方法實作。
// 當我們要設計一個付款系統時，可能會需要設計不同的付款方式。這些付款方式在某些地方可能有相似的邏輯，例如都需要驗證信用卡號或帳號是否合法，或是需要做付款後的記錄。此時，我們可以使用abstract類別來定義這些相似的邏輯(template pattern)。

// 定義abstract類別讓所有繼承的付款方式都有相同的處理流程(processPayment)，但各自付款方式因為驗證方式不同所以都需要自行實作驗證邏輯(authorizePayment)等。
abstract class Payment
{
    abstract public function authorizePayment();

    public function processPayment()
    {
        $this->authorizePayment();
        $this->sendConfirmation();
    }

    protected function sendConfirmation()
    {
        echo "Payment confirmation sent via email.\n";
    }
}

// 具體類別實作方式
class CreditCardPayment extends Payment
{
    public function authorizePayment()
    {
        echo "Authorizing credit card payment...\n";
    }
}