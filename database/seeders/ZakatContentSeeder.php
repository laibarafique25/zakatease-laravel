<?php

namespace Database\Seeders;

use App\Models\ZakatRule;
use App\Models\NisabValue;
use App\Models\ZakatFaq;
use Illuminate\Database\Seeder;

class ZakatContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Zakat Rules
        $rules = [
            [
                'asset_type' => 'gold',
                'title' => 'Gold Zakat Rules',
                'content' => 'Gold is subject to Zakat if its weight reaches or exceeds the Nisab limit of 87.48 grams (7.5 Tolas). The rate is 2.5% of the total value. Zakat is due on all gold owned, whether in the form of jewelry, coins, bullion, or scrap. Some scholars exempt personal jewelry worn regularly, but out of precaution and according to the Hanafi school, all gold is subject to Zakat.',
                'islamic_references' => 'Hadith: "There is no Zakat on gold until it reaches twenty dinars..." (Abu Dawud). Quran: "And those who hoard gold and silver and spend it not in the way of Allah - give them tidings of a painful punishment." (Surah At-Tawbah: 34)',
                'scholarly_explanations' => 'Hanafi School: Zakat is due on all gold regardless of use. Shafi, Maliki, and Hanbali Schools: Personal jewelry worn regularly is not subject to Zakat, provided it is within reasonable, customary limits.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'asset_type' => 'silver',
                'title' => 'Silver Zakat Rules',
                'content' => 'Silver is subject to Zakat if its weight reaches or exceeds the Nisab limit of 612.36 grams (52.5 Tolas). The rate of Zakat is 2.5% of the current market value of the silver. Just like gold, Zakat is due on all forms of silver, including jewelry, coins, utensils (even though silver utensils are forbidden to use, they still hold value), and bullion.',
                'islamic_references' => 'Hadith: "On silver, a quarter of a tenth (2.5%) is due..." (Sahih Bukhari).',
                'scholarly_explanations' => 'The value of silver is much lower than gold today, meaning the Nisab for silver is reached at a much lower monetary threshold. Many scholars recommend using the silver Nisab for cash calculations to benefit the poor.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'asset_type' => 'cash',
                'title' => 'Cash, Bank Balances & Savings',
                'content' => 'All cash on hand, bank account balances (savings and checking), cash equivalents, and loans you are sure will be repaid must be added together. If the total cash value exceeds the Nisab threshold (usually calculated based on the silver Nisab for the local currency equivalent), Zakat is due at a rate of 2.5%.',
                'islamic_references' => 'General consensus (Ijma) of scholars applies the rule of silver/gold Nisab to cash currencies.',
                'scholarly_explanations' => 'Savings include money set aside for future plans like Hajj, marriage, or buying a house, as long as it has been in your possession for one lunar year.',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'asset_type' => 'property',
                'title' => 'Real Estate and Property Rules',
                'content' => 'The property you live in is exempt from Zakat. However, properties purchased with the intention to resell for profit are subject to Zakat on their total current market value (not purchase price) at 2.5% annually. For rental properties, no Zakat is due on the property value itself, but Zakat is due on the net rental income generated after expenses, when combined with other wealth.',
                'islamic_references' => 'Scholarly consensus on trade goods (Urud at-Tijarah).',
                'scholarly_explanations' => 'If a property is bought for investment (capital appreciation) without a specific resale intention, some scholars say it is not subject to Zakat until sold, while others suggest Zakat on rental yield.',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'asset_type' => 'agricultural',
                'title' => 'Agricultural Produce (Ushr)',
                'content' => 'Ushr is Zakat on crops, fruits, and agricultural produce. Unlike other wealth, there is no one-year holding period; it is due at harvest. The Nisab is 5 Wasqs (approx 653 kg). The rate is 10% for crops watered naturally by rain/rivers, and 5% for crops watered artificially via wells, pumps, or irrigation canals.',
                'islamic_references' => 'Quran: "And give its due [Zakat] on the day of its harvest." (Surah Al-An\'am: 141). Hadith: "On land irrigated by rain, Ushr (10%) is due; on land irrigated by wells, half-Ushr (5%) is due." (Bukhari).',
                'scholarly_explanations' => 'Expenses incurred in farming (seeds, fertilizer, labor) can be deducted before calculating the percentage, according to contemporary scholars.',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'asset_type' => 'livestock',
                'title' => 'Livestock Zakat (Saimah)',
                'content' => 'Zakat on grazing livestock (camels, cows, sheep, goats) is due if they graze on public pastures for most of the year. The Nisab thresholds are: Camels (5 or more), Cows (30 or more), Sheep/Goats (40 or more). Animals kept for personal meat, dairy, transport, or farming labor are exempt. For commercial livestock businesses, Zakat is calculated at 2.5% of the total business value.',
                'islamic_references' => 'Detailed charts of livestock Zakat set by the Prophet (peace be upon him) in the letters of instruction sent to governors (Bukhari).',
                'scholarly_explanations' => 'If animals are fed purchased feed for more than half the year, they are not classed as Saimah and are exempt from livestock rules, though commercial operations treat them as business inventory.',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'asset_type' => 'crypto',
                'title' => 'Cryptocurrency Rules',
                'content' => 'Cryptocurrencies, tokens, NFTs, and stablecoins are treated as financial assets. Since they have tradeable value, they are subject to Zakat at a rate of 2.5% on their market value on the day Zakat is calculated, provided they meet the Nisab threshold when combined with other liquid cash assets.',
                'islamic_references' => 'Contemporary juristic rulings (Fatawa) from organizations like the International Islamic Fiqh Academy.',
                'scholarly_explanations' => 'Assets held for trading (short term) or long term holding (HODL) are both subject to 2.5% Zakat on total current value. Utility tokens are evaluated based on their exchangeable cash value.',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'asset_type' => 'stocks',
                'title' => 'Stocks, Mutual Funds, and Shares',
                'content' => 'If stocks are bought for short-term trading, Zakat is due on the full market value of the shares at 2.5%. If bought as a long-term investment for dividends, Zakat is calculated at 2.5% of the underlying zakatable assets of the company (cash + inventory + receivables), which is typically estimated at 25% to 30% of the share value, or 2.5% of the dividends.',
                'islamic_references' => 'Rulings from AAOIFI (Accounting and Auditing Organization for Islamic Financial Institutions).',
                'scholarly_explanations' => 'For simplicity, if company balance sheets are unavailable, many contemporary scholars advise paying 2.5% on the full market value of the stocks.',
                'order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($rules as $rule) {
            ZakatRule::updateOrCreate(['asset_type' => $rule['asset_type']], $rule);
        }

        // 2. Nisab Values
        NisabValue::updateOrCreate(
            ['type' => 'gold'],
            ['weight_grams' => 87.480, 'value_pkr' => 2400000.00, 'updated_by' => 'System']
        );
        NisabValue::updateOrCreate(
            ['type' => 'silver'],
            ['weight_grams' => 612.360, 'value_pkr' => 195000.00, 'updated_by' => 'System']
        );

        // 3. Zakat FAQs
        $faqs = [
            [
                'question' => 'Who is eligible to pay Zakat?',
                'answer' => 'Zakat is obligatory on every sane, adult Muslim who owns wealth equal to or exceeding the Nisab threshold for a full lunar year (Hawl).',
                'category' => 'General',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'How is Nisab calculated?',
                'answer' => 'Nisab is the minimum amount of wealth a Muslim must possess before they are obligated to pay Zakat. It is equivalent to 87.48 grams of gold or 612.36 grams of silver. Today, the cash equivalent is calculated using the market price of gold or silver.',
                'category' => 'Calculation',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Can Zakat be given to family members?',
                'answer' => 'Zakat cannot be given to immediate ascendants (parents, grandparents) or descendants (children, grandchildren), nor to one\'s spouse. However, giving Zakat to other relatives in need (siblings, aunts, uncles, cousins) is permitted and highly rewarded, as it combines charity with keeping family ties.',
                'category' => 'Distribution',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Is Zakat due on personal items like cars or houses?',
                'answer' => 'No. Zakat is not due on primary residences, personal vehicles, furniture, clothing, or tools used for work, regardless of their value.',
                'category' => 'Exemptions',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            ZakatFaq::updateOrCreate(['question' => $faq['question']], $faq);
        }
    }
}
