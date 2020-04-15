<?php
namespace App\Service;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class InstagramTest
 *
 * vendor/bin/phpunit Briefcase/Exchange/CryptopiaTest.php
 */
class BankTest extends TestCase
{
	/**
	 * @throws Exception
	 */
	public function testGetData()
	{
	    /* @var BankServiceMock $bankService */
        $bankService = new BankServiceMock();

		dd($bankService->getData());
	}
}

class BankServiceMock extends BankService
{
    protected function getRawDataFromServer(): string
    {
        return '<?xml version="1.0" encoding="utf-8"?>
<!-- generator="Joomla! - Open Source Content Management" -->
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title>Valūtu kursi</title>
		<description><![CDATA[Eiropas Centrālās bankas publicētie eiro atsauces kursi]]></description>
		<link>https://www.bank.lv/</link>
		<lastBuildDate>Tue, 14 Apr 2020 10:42:01 +0300</lastBuildDate>
		<generator>Joomla! - Open Source Content Management</generator>
		<atom:link rel="self" type="application/rss+xml" href="/component/graph/?format=feed&amp;mode=exc&amp;view=graph&amp;ecb=true&amp;type=rss"/>
		<image>
			<url>https://www.bank.lv/images/latvijas_banka_smalllogo.gif</url>
			<title>Valūtu kursi</title>
			<link>https://www.bank.lv/</link>
			<width>142</width>
			<height>48</height>
		</image>
		<language>lv-LV</language>
		<ttl>5</ttl>
		<item>
			<title>Eiropas Centrālās bankas publicētie eiro atsauces kursi. 9. April_LONG</title>
			<link>https://www.bank.lv/</link>
			<guid isPermaLink="false">https://www.bank.lv/#09.04</guid>
			<description><![CDATA[AUD 1.74440000 BGN 1.95580000 BRL 5.59560000 CAD 1.52650000 CHF 1.05580000 CNY 7.67090000 CZK 26.90900000 DKK 7.46570000 GBP 0.87565000 HKD 8.42590000 HRK 7.61750000 HUF 354.76000000 IDR 17243.21000000 ILS 3.89190000 INR 82.92750000 ISK 155.90000000 JPY 118.33000000 KRW 1322.49000000 MXN 26.03210000 MYR 4.71360000 NOK 11.21430000 NZD 1.81280000 PHP 54.93900000 PLN 4.55860000 RON 4.83300000 RUB 80.69000000 SEK 10.94550000 SGD 1.54790000 THB 35.66500000 TRY 7.32330000 USD 1.08670000 ZAR 19.63830000 ]]></description>
			<pubDate>Thu, 09 Apr 2020 03:00:00 +0300</pubDate>
		</item>
		<item>
			<title>Eiropas Centrālās bankas publicētie eiro atsauces kursi. 8. April_LONG</title>
			<link>https://www.bank.lv/</link>
			<guid isPermaLink="false">https://www.bank.lv/#09.04</guid>
			<description><![CDATA[AUD 1.74440000 BGN 1.95580000 BRL 5.59560000 CAD 1.52650000 CHF 1.05580000 CNY 7.67090000 CZK 26.90900000 DKK 7.46570000 GBP 0.87565000 HKD 8.42590000 HRK 7.61750000 HUF 354.76000000 IDR 17243.21000000 ILS 3.89190000 INR 82.92750000 ISK 155.90000000 JPY 118.33000000 KRW 1322.49000000 MXN 26.03210000 MYR 4.71360000 NOK 11.21430000 NZD 1.81280000 PHP 54.93900000 PLN 4.55860000 RON 4.83300000 RUB 80.69000000 SEK 10.94550000 SGD 1.54790000 THB 35.66500000 TRY 7.32330000 USD 1.08670000 ZAR 19.63830000 ]]></description>
			<pubDate>Thu, 09 Apr 2020 03:00:00 +0300</pubDate>
		</item>
	</channel>
</rss>';
    }
}