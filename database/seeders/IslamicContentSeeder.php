<?php

namespace Database\Seeders;

use App\Models\HadithCategory;
use App\Models\Hadith;
use App\Models\AzkarCategory;
use App\Models\Azkar;
use App\Models\QuranTopic;
use App\Models\QuranVerse;
use Illuminate\Database\Seeder;

class IslamicContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Hadith Categories & Collection
        $catZakat = HadithCategory::updateOrCreate(
            ['slug' => 'zakat'],
            ['name' => 'Zakat', 'description' => 'Ahadees related to obligatory charity (Zakat).', 'icon' => '🪙', 'order' => 1]
        );
        $catCharity = HadithCategory::updateOrCreate(
            ['slug' => 'charity'],
            ['name' => 'Charity & Sadaqa', 'description' => 'Ahadees on voluntary charity and its rewards.', 'icon' => '🤝', 'order' => 2]
        );
        $catPrayer = HadithCategory::updateOrCreate(
            ['slug' => 'prayer'],
            ['name' => 'Prayer & Worship', 'description' => 'Ahadees detailing the importance of Salah.', 'icon' => '🕌', 'order' => 3]
        );
        $catPatience = HadithCategory::updateOrCreate(
            ['slug' => 'patience'],
            ['name' => 'Patience & Trials', 'description' => 'Ahadees detailing patience during hardships.', 'icon' => '🌱', 'order' => 4]
        );
        $catGratitude = HadithCategory::updateOrCreate(
            ['slug' => 'gratitude'],
            ['name' => 'Gratitude & Thanks', 'description' => 'Ahadees showing the virtue of thanking Allah and people.', 'icon' => '🤲', 'order' => 5]
        );

        Hadith::updateOrCreate(
            ['arabic_text' => 'إِنَّ اللَّهَ فَرَضَ زَكَاةً فِي أَمْوَالِهِمْ'],
            [
                'category_id' => $catZakat->id,
                'urdu_translation' => 'بیشک اللہ نے ان کے اموال میں زکوٰۃ فرض کی ہے جو ان کے امیروں سے لی جائے اور ان کے غریبوں کو لوٹا دی جائے۔',
                'english_translation' => 'Indeed, Allah has made obligatory upon them the Zakat to be taken from their wealthy and given back to their poor.',
                'source' => 'Sahih Bukhari & Muslim',
                'hadith_number' => '1395',
                'grade' => 'sahih',
                'is_featured' => true,
            ]
        );

        Hadith::updateOrCreate(
            ['arabic_text' => 'الصَّدَقَةُ تُطْفِئُ الْخَطِيئَةَ كَمَا يُطْفِئُ الْمَاءُ النَّارَ'],
            [
                'category_id' => $catCharity->id,
                'urdu_translation' => 'صدقہ گناہ کو اس طرح بجھاتا ہے جیسے پانی آگ کو بجھاتا ہے۔',
                'english_translation' => 'Charity extinguishes sin just as water extinguishes fire.',
                'source' => 'Jami\' at-Tirmidhi',
                'hadith_number' => '614',
                'grade' => 'sahih',
                'is_featured' => true,
            ]
        );

        Hadith::updateOrCreate(
            ['arabic_text' => 'الصَّلَاةُ عِمَادُ الدِّينِ'],
            [
                'category_id' => $catPrayer->id,
                'urdu_translation' => 'نماز دین کا ستون ہے۔',
                'english_translation' => 'Prayer is the pillar of religion.',
                'source' => 'Shu\'ab al-Iman (Al-Bayhaqi)',
                'hadith_number' => '2550',
                'grade' => 'hasan',
                'is_featured' => true,
            ]
        );

        Hadith::updateOrCreate(
            ['arabic_text' => 'مَنْ لَمْ يَشْكُرِ النَّاسَ لَمْ يَشْكُرِ اللَّهَ'],
            [
                'category_id' => $catGratitude->id,
                'urdu_translation' => 'جو لوگوں کا شکر نہیں کرتا وہ اللہ کا بھی شکر نہیں کرتا۔',
                'english_translation' => 'He who does not thank people does not thank Allah.',
                'source' => 'Sunan Abu Dawud',
                'hadith_number' => '4811',
                'grade' => 'sahih',
                'is_featured' => true,
            ]
        );

        // 2. Azkar Categories & Collection
        $azkMorning = AzkarCategory::updateOrCreate(
            ['slug' => 'morning'],
            ['name' => 'Morning Azkar', 'type' => 'morning', 'icon' => '☀️', 'order' => 1]
        );
        $azkEvening = AzkarCategory::updateOrCreate(
            ['slug' => 'evening'],
            ['name' => 'Evening Azkar', 'type' => 'evening', 'icon' => '🌙', 'order' => 2]
        );
        $azkPrayer = AzkarCategory::updateOrCreate(
            ['slug' => 'prayer'],
            ['name' => 'After Prayer Azkar', 'type' => 'prayer', 'icon' => '📿', 'order' => 3]
        );
        $azkGeneral = AzkarCategory::updateOrCreate(
            ['slug' => 'general'],
            ['name' => 'General Remembrance', 'type' => 'general', 'icon' => '🕊️', 'order' => 4]
        );

        Azkar::updateOrCreate(
            ['arabic_text' => 'سُبْحَانَ اللَّهِ وَبِحَمْدِهِ'],
            [
                'category_id' => $azkGeneral->id,
                'urdu_translation' => 'اللہ پاک ہے اور تمام تعریفیں اسی کے لیے ہیں۔',
                'english_translation' => 'Glory is to Allah and praise is to Him.',
                'reference' => 'Sahih Bukhari (6405)',
                'benefits' => 'Whoever says this one hundred times a day will have his sins forgiven, even if they are like the foam of the sea.',
                'repeat_count' => 100,
                'is_featured' => true,
            ]
        );

        Azkar::updateOrCreate(
            ['arabic_text' => 'اللَّهُمَّ أَنْتَ السَّلَامُ وَمِنْكَ السَّلَامُ تَبَارَكْتَ يَا ذَا الْجَلَالِ وَالْإِكْرَامِ'],
            [
                'category_id' => $azkPrayer->id,
                'urdu_translation' => 'اے اللہ تو ہی سلامتی والا ہے اور تیری ہی طرف سے سلامتی ہے، تو برکت والا ہے، اے عظمت اور بزرگی والے۔',
                'english_translation' => 'O Allah, You are peace and from You is peace. Blessed are You, O Owner of majesty and honor.',
                'reference' => 'Sahih Muslim (591)',
                'benefits' => 'Recited immediately after finishing the obligatory prayer.',
                'repeat_count' => 1,
                'is_featured' => true,
            ]
        );

        // 3. Quranic Verse Topics & Verses
        $topicCharity = QuranTopic::updateOrCreate(
            ['slug' => 'charity-in-quran'],
            ['name' => 'Charity & Spending', 'description' => 'Quranic verses urging believers to spend in the cause of Allah.']
        );
        $topicFaith = QuranTopic::updateOrCreate(
            ['slug' => 'faith-and-righteousness'],
            ['name' => 'Faith & Righteousness', 'description' => 'Verses defining true faith, prayer, and zakat.']
        );

        QuranVerse::updateOrCreate(
            ['surah_number' => 2, 'ayah_number' => 261],
            [
                'topic_id' => $topicCharity->id,
                'surah_name' => 'Al-Baqarah',
                'arabic_text' => 'مَّثَلُ الَّذِينَ يُنفِقُونَ أَمْوَالَهُمْ فِي سَبِيلِ اللَّهِ كَمَثَلِ حَبَّةٍ أَنبَتَتْ سَبْعَ سَنَابِلَ فِي كُلِّ سُنبُلَةٍ مِّائَةُ حَبَّةٍ ۗ وَاللَّهُ يُضَاعِفُ لِمَن يَشَاءُ ۗ وَاللَّهُ وَاسِعٌ عَلِيمٌ',
                'urdu_translation' => 'ان لوگوں کی مثال جو اپنے مال اللہ کی راہ میں خرچ کرتے ہیں اس دانے جیسی ہے جس نے سات بالیاں اگائیں، ہر بالی میں سو دانے ہیں، اور اللہ جس کے لیے چاہتا ہے دوگنا کرتا ہے۔',
                'english_translation' => 'The example of those who spend their wealth in the way of Allah is like a seed [of grain] which grows seven spikes; in each spike is a hundred grains. And Allah multiplies [His reward] for whom He wills. And Allah is all-Encompassing and Knowing.',
                'reflection' => 'This verse visually describes the exponential return on sincere charity. True spending in Allah\'s way is an investment that yields infinite blessings.',
                'is_featured' => true,
            ]
        );

        QuranVerse::updateOrCreate(
            ['surah_number' => 2, 'ayah_number' => 110],
            [
                'topic_id' => $topicFaith->id,
                'surah_name' => 'Al-Baqarah',
                'arabic_text' => 'وَأَقِيمُوا الصَّلَاةَ وَآتُوا الزَّكَاةَ ۚ وَمَا تُقَدِّمُوا لِأَنفُسِكُم مِّنْ خَيْرٍ تَجِدُوهُ عِندَ اللَّهِ ۗ إِنَّ اللَّهَ بِمَا تَعْمَلُونَ بَصِيرٌ',
                'urdu_translation' => 'اور نماز قائم کرو اور زکوٰۃ دو، اور جو بھی بھلائی تم اپنے لیے آگے بھیجو گے اسے اللہ کے ہاں پا لوگے، بیشک اللہ تمہارے اعمال کو دیکھنے والا ہے۔',
                'english_translation' => 'And establish prayer and give zakat, and whatever good you send forth for yourselves - you will find it with Allah. Indeed Allah of what you do is Seeing.',
                'reflection' => 'Establishing prayer manages our relationship with our Creator, while giving Zakat manages our relationship with creation. They are twin pillars of Islamic life.',
                'is_featured' => true,
            ]
        );
    }
}
